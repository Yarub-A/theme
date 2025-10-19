(function (wp) {
    const { addFilter } = wp.hooks;
    const { createElement: el, Fragment } = wp.element;
    const { PanelBody, RangeControl } = wp.components;
    const { InspectorControls } = wp.blockEditor || wp.editor;

    const withNewsGridControls = (BlockEdit) => {
        return (props) => {
            if (props.name !== 'theme-euss/news-grid') {
                return el(BlockEdit, props);
            }

            const { attributes, setAttributes } = props;
            const postsToShow = attributes.postsToShow || 3;

            return el(
                Fragment,
                null,
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: wp.i18n.__('News Grid Settings', 'theme-euss'), initialOpen: true },
                        el(RangeControl, {
                            label: wp.i18n.__('Number of news items', 'theme-euss'),
                            min: 1,
                            max: 9,
                            value: postsToShow,
                            onChange: (value) => setAttributes({ postsToShow: parseInt(value, 10) || 3 }),
                        })
                    )
                )
            );
        };
    };

    addFilter('editor.BlockEdit', 'theme-euss/news-grid-controls', withNewsGridControls);
})(window.wp);
