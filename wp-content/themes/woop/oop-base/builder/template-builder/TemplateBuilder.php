<?php

namespace woop;

class TemplateBuilder extends HtmlDocumentBuilder
{
    protected function header(): string
    {
        ob_start();
        get_header();
        return ob_get_clean();
    }

    protected function footer(): string
    {
        ob_start();
        get_footer();
        return ob_get_clean();
    }

    protected function main(string $content = ''): string
    {
        return <<< HTML
<main id="site-content" role="main">$content</main>
HTML;
    }

    protected function body(string $content = ''): string
    {
        $header = (new HtmlStringBuilder)->add_text($this->header());
        $main = (new HtmlStringBuilder)->add_text($this->main($content));
        $footer = (new HtmlStringBuilder)->add_text($this->footer());
        return parent::body((new BuilderCollection())
            ->add_element($header)
            ->add_element($main)
            ->add_element($footer)
            ->build());
    }
}
