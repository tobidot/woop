<?php

namespace woop;

class HtmlDocumentBuilder implements Builder
{
    protected function head(string $content = ''): string
    {
        ob_start();?>
        <head>
            <?php echo $content ?>
            <?php wp_head(); ?>
        </head>
    <?php
        return ob_get_clean();
    }

    protected function body(string $content = ''): \woop\HtmlBuilder
    {
        return (new class extends BuilderCallback implements HtmlBuilder {
            public function build(string $content = '') {
                ob_start();
                ?>
                    <body>
                        <?php wp_body_open(); ?>
                        <?php echo $content; ?>
                    </body>
                <?php
                return ob_get_clean();
            }
        });
    }

    public function build(): string
    {;
        $head = $this->head());
        $body = (new HtmlStringBuilder)->add_text($this->body());
        return "<!DOCTYPE html>" . (new HtmlTagBuilder())
            ->set_tagname('html')
            ->set_attributes_builder((new HtmlAttributeBuilder)
                ->add_attribute('class', 'woop-theme')
                ->add_attribute(get_language_attributes()))
            ->set_children((new BuilderCollection())
                ->add_element($head)
                ->add_element($body))
            ->build();
    }
}
