const path = require('path');
const fs = require('fs');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const IgnoreEmitPlugin = require('ignore-emit-webpack-plugin');

const blocksPath = path.resolve(__dirname, 'blocks');

// ==============================
// AUTO DETECT BLOCKS
// ==============================

const getBlockEntries = () => {
    const entries = {};

    if (!fs.existsSync(blocksPath)) return entries;

    fs.readdirSync(blocksPath).forEach(block => {
        const dir = path.join(blocksPath, block);

        if (!fs.lstatSync(dir).isDirectory()) return;

        const style = path.join(dir, 'style.scss');
        const script = path.join(dir, 'script.js');

        if (fs.existsSync(style)) {
            entries[`blocks/${block}/style`] = style;
        }

        if (fs.existsSync(script)) {
            entries[`blocks/${block}/script`] = script;
        }
    });

    return entries;
};

// ==============================
// BUILD LOGGER (no chalk)
// ==============================

class BuildLoggerPlugin {
    apply(compiler) {
        compiler.hooks.done.tap('BuildLoggerPlugin', (stats) => {

            const time = ((stats.endTime - stats.startTime) / 1000).toFixed(2);
            const assets = stats.toJson({ assets: true }).assets || [];

            const global = [];
            const blocks = {};

            assets.forEach(asset => {
                const name = asset.name;

                if (name.startsWith('global/')) {
                    global.push(name.replace('global/', ''));
                }

                if (name.startsWith('blocks/')) {
                    const parts = name.split('/');
                    const block = parts[1];
                    const file = parts.slice(2).join('/');

                    if (!blocks[block]) {
                        blocks[block] = [];
                    }

                    blocks[block].push(file);
                }
            });

            // ANSI COLORS
            const green = (t) => `\x1b[32m${t}\x1b[0m`;
            const blue = (t) => `\x1b[34m${t}\x1b[0m`;
            const magenta = (t) => `\x1b[35m${t}\x1b[0m`;

            console.log('\n' + green(`✅ Build completed in ${time}s\n`));

            if (global.length) {
                console.log(blue('📦 Global:'));
                global.forEach(f => console.log('  - ' + f));
                console.log('');
            }

            if (Object.keys(blocks).length) {
                console.log(magenta('🧱 Blocks:'));
                Object.entries(blocks).forEach(([block, files]) => {
                    console.log(`  ${block}/`);
                    files.forEach(f => console.log('    - ' + f));
                });
                console.log('');
            }

        });
    }
}

// ==============================
// CONFIG
// ==============================

module.exports = (env, argv) => {

    const isProd = argv.mode === 'production';

    return {

        mode: isProd ? 'production' : 'development',

        entry: {
            'global/main': './assets/src/global/main.js',
            'global/main-style': './assets/src/global/main.scss',
            ...getBlockEntries()
        },

        output: {
            path: path.resolve(__dirname, 'assets/dist'),

            filename: ({ chunk }) => {
                if (!chunk?.name) return '[name].js';
                return `${chunk.name}.js`;
            },

            chunkFilename: '[name].js',

            clean: true
        },

        devtool: isProd ? false : 'source-map',

        stats: 'minimal',
        infrastructureLogging: { level: 'warn' },

        module: {
            rules: [

                // JS
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                ['@babel/preset-env', { targets: 'defaults' }]
                            ]
                        }
                    }
                },

                // SCSS / CSS
                {
                    test: /\.(scss|css)$/i,
                    use: [
                        MiniCssExtractPlugin.loader,
                        {
                            loader: 'css-loader',
                            options: { sourceMap: !isProd }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                implementation: require('sass'),
                                api: 'modern',
                                sourceMap: !isProd,
                                sassOptions: {
                                    quietDeps: true,
                                    silenceDeprecations: ['legacy-js-api', 'import']
                                }
                            }
                        }
                    ]
                }

            ]
        },

        optimization: {
            minimize: isProd,
            minimizer: [
                new TerserPlugin(),
                new CssMinimizerPlugin()
            ],
            splitChunks: false,
            runtimeChunk: false
        },

        plugins: [

            new MiniCssExtractPlugin({
                filename: ({ chunk }) => {

                    if (!chunk?.name) return '[name].css';

                    if (chunk.name === 'global/main-style') {
                        return 'global/main.css';
                    }

                    if (chunk.name.startsWith('blocks/')) {
                        return `${chunk.name}.css`;
                    }

                    return '[name].css';
                }
            }),

            new IgnoreEmitPlugin([
                /\/style\.js$/,
                /main-style\.js$/
            ]),

            new BrowserSyncPlugin(
                {
                    proxy: 'http://localhost:10044',
                    files: [
                        '**/*.php',
                        'assets/dist/**/*.{css,js}'
                    ],
                    injectChanges: true,
                    notify: false
                },
                { reload: false }
            ),

            new BuildLoggerPlugin()
        ]

    };
};