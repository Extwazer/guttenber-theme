import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { createElement, Fragment } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const TARGET_BLOCKS = ['core/spacer'];

const VISIBILITY_OPTIONS = [
    { label: __('All devices', 'theme'), value: '' },
    { label: __('Desktop only', 'theme'), value: 'desktop-only' },
    { label: __('Mobile only', 'theme'), value: 'mobile-only' },
];

addFilter('blocks.registerBlockType', 'theme/visibility-attribute', (settings, name) => {
    if (!TARGET_BLOCKS.includes(name)) {
        return settings;
    }

    return {
        ...settings,
        attributes: {
            ...settings.attributes,
            visibility: {
                type: 'string',
                default: '',
            },
        },
    };
});

const withVisibilityControl = createHigherOrderComponent((BlockEdit) => (props) => {
    if (!TARGET_BLOCKS.includes(props.name)) {
        return createElement(BlockEdit, props);
    }

    const { attributes, setAttributes } = props;

    return createElement(
        Fragment,
        {},
        createElement(BlockEdit, props),
        createElement(
            InspectorControls,
            {},
            createElement(
                PanelBody,
                { title: __('Visibility', 'theme') },
                createElement(SelectControl, {
                    label: __('Show on', 'theme'),
                    value: attributes.visibility,
                    options: VISIBILITY_OPTIONS,
                    onChange: (visibility) => setAttributes({ visibility }),
                })
            )
        )
    );
}, 'withVisibilityControl');

addFilter('editor.BlockEdit', 'theme/with-visibility-control', withVisibilityControl);

const withVisibilityClassName = createHigherOrderComponent((BlockListBlock) => (props) => {
    const visibility = props.attributes && props.attributes.visibility;

    if (!TARGET_BLOCKS.includes(props.block && props.block.name) || !visibility) {
        return createElement(BlockListBlock, props);
    }

    return createElement(BlockListBlock, {
        ...props,
        className: [props.className, visibility].filter(Boolean).join(' '),
    });
}, 'withVisibilityClassName');

addFilter('editor.BlockListBlock', 'theme/visibility-classname', withVisibilityClassName);
