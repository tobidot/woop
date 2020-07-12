<?php

namespace woop;

require_once 'HtmlDocumentBuilder.php';

class TemplateBuilder extends HtmlDocumentBuilder
{
    protected function header(?IBuilder $after_header = null): IBuilder
    {
        return new BuilderCallback(function () use ($after_header) {
            $after_header_content = ($after_header !== null) ? $after_header->build() : '';
            return <<< HTML
            <header id="site-header">
                $after_header_content
            </header><!-- #site-header -->
HTML;
        });
    }

    protected function main(?IBuilder $inner = null): IBuilder
    {
        return new BuilderCallback(function () use ($inner) {
            $content = $inner->build();
            return <<< HTML
            <main id="site-content" role="main">
                $content
            </main>
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

    protected function footer(?IBuilder $after_footer = null): IBuilder
    {
        return new BuilderCallback(function () use ($after_footer) {
            $after_footer_content = ($after_footer !== null) ? $after_footer->build() : '';
            return <<< HTML
            <footer id="site-footer" role="contentinfo">
                $after_footer_content
            </footer><!-- #site-footer -->
HTML;
        });
    }
}
