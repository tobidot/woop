<?php

namespace woop;

class TemplateBuilder extends HtmlDocumentBuilder
{
    protected function header(?string $name = null, ?IBuilder $inner = null): IBuilder
    {
        return new BuilderCallback(function () use ($name, $inner) {
            ob_start();
            get_header($name);
            if ($inner !== null) $inner->print();
            return ob_get_clean();
        });
    }

    protected function footer(?string $name = null, ?IBuilder $inner = null): IBuilder
    {
        return new BuilderCallback(function () use ($name, $inner) {
            ob_start();
            get_footer($name);
            if ($inner !== null) $inner->print();
            return ob_get_clean();
        });
    }

    protected function main(?IBuilder $inner = null): IBuilder
    {
        return new BuilderCallback(function () use ($inner) {
            $content = $inner->build();
            return <<< HTML
<main id="site-content" role="main">$content</main>
HTML;
        });
    }

    protected function body(?IBuilder $inner = null): IBuilder
    {
        $header = $this->header();
        $main = $this->main($inner);
        $footer = $this->footer();
        return parent::body((new BuilderCollection())
            ->add_element($header)
            ->add_element($main)
            ->add_element($footer));
    }
}
