const fs = require('fs');
const path = require('path');

const input = process.argv[2];

if (!input) {
    console.error('Usage: npm run make:block -- <block-name>');
    console.error('Example: npm run make:block -- hero-banner');
    process.exit(1);
}

const name = input.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');

if (!name) {
    console.error('Invalid block name.');
    process.exit(1);
}

const title = name
    .split('-')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(' ');

const templateDir = path.join(__dirname, 'block-template');
const targetDir = path.join(__dirname, '..', 'blocks', name);

if (fs.existsSync(targetDir)) {
    console.error(`Block "${name}" already exists at blocks/${name}`);
    process.exit(1);
}

fs.mkdirSync(targetDir, { recursive: true });

fs.readdirSync(templateDir).forEach(file => {
    const content = fs.readFileSync(path.join(templateDir, file), 'utf8')
        .replace(/__NAME__/g, name)
        .replace(/__TITLE__/g, title);

    fs.writeFileSync(path.join(targetDir, file.replace(/\.tpl$/, '')), content);
});

console.log(`Block created: blocks/${name}/`);
console.log('Next steps:');
console.log('  1. Run npm run dev (or build) to compile its assets');
console.log('  2. Add ACF fields to it via the Custom Fields UI if needed (auto-syncs to acf-json)');
