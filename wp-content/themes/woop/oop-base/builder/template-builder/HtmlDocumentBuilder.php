<?php

namespace woop;

class HtmlDocumentBuilder extends Builder
{
    protected function head(?IBuilder $inner = null): IBuilder
    {
        return new BuilderCallback(function () use ($inner) {
            ob_start(); ?>

            <head>
                <?php wp_head(); ?>
                <?php if ($inner !== null) echo $inner->build(); ?>
            </head>
        <?php
            return ob_get_clean();
        });
    }

    protected function body(?IBuilder $inner = null): IBuilder
    {
        return new BuilderCallback(function () use ($inner) {
            ob_start();
        ?>

            <body>
                <?php wp_body_open(); ?>
                <?php if ($inner !== null) echo $inner->build(); ?>
            </body>
<?php
            return ob_get_clean();
        });
    }

    public function build(): string
    {;
        $head = $this->head();
        $body = $this->body();
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
