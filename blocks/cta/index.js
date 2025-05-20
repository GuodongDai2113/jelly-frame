(function (blocks, blockEditor, components, element) {
  const { registerBlockType } = blocks;
  const { RichText, MediaUpload, URLInputButton, useBlockProps } = blockEditor;
  const { Button } = components;
  const el = element.createElement;

  registerBlockType("jelly-frame/wp-block-cta", {
    edit: function (props) {
      const { attributes, setAttributes } = props;
      const blockProps = useBlockProps();

      return el(
        "section",
        Object.assign({}, blockProps, {
          style: { backgroundImage: "url(" + attributes.bgImage + ")" },
          className: "wp-block-cta wp-block",
        }),
        el(
          "div",
          { className: "wp-block-cta__caption" },
          el(RichText, {
            tagName: "h3",
            value: attributes.title,
            onChange: (val) => setAttributes({ title: val }),
            placeholder: "输入标题",
            style: { color: "#fff" },
          }),
          el(RichText, {
            tagName: "p",
            value: attributes.description,
            onChange: (val) => setAttributes({ description: val }),
            placeholder: "输入描述",
            style: { color: "#ccc" },
          })
        ),
        el(
          "div",
          { className: "wp-block-cta__button" },
          el(MediaUpload, {
            onSelect: (media) => setAttributes({ bgImage: media.url }),
            render: (obj) =>
              el(
                Button,
                {
                  onClick: obj.open,
                  isSecondary: true,
                  style: { marginBottom: "12px" },
                },
                "选择背景图"
              ),
          }),
          el(RichText, {
            tagName: "span",
            value: attributes.buttonText,
            onChange: (val) => setAttributes({ buttonText: val }),
            placeholder: "按钮文字",
            style: {
              color: "#fff",
              marginBottom: "8px",
              display: "inline-block",
            },
          }),
          el(URLInputButton, {
            url: attributes.buttonLink,
            onChange: (val) => setAttributes({ buttonLink: val }),
          })
        )
      );
    },

    save: function (props) {
      const { attributes } = props;
      const blockProps = useBlockProps.save();

      return el(
        "section",
        Object.assign({}, blockProps, {
          style: { backgroundImage: "url(" + attributes.bgImage + ")" },
          className: "wp-block-cta",
        }),
        el(
          "div",
          { className: "wp-block-cta__caption" },
          el("h3", null, attributes.title),
          el("p", null, attributes.description)
        ),
        el(
          "div",
          { className: "wp-block-cta__button" },
          el(
            "a",
            {
              className: "button elementor-button",
              href: attributes.buttonLink,
            },
            attributes.buttonText
          )
        )
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.blockEditor,
  window.wp.components,
  window.wp.element
);
