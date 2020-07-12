<?php

use woop\BuilderCallback;
use woop\BuilderCollection;
use woop\IBuilder;
use woop\TemplateBuilder;

namespace woop;

require_once 'TemplateBuilder.php';

class ThemeTemplateBuilder extends TemplateBuilder
{
    public ValueBuilderWithFilter $theme_class_prefix;
    public ValueBuilderWithFilter $page_title;
    public ValueBuilderWithFilter $page_description;

    public function __construct()
    {
        $this->theme_class_prefix = (new ValueBuilderWithFilter('string'))->set('woop');
        $this->page_title = (new ValueBuilderWithFilter('string'))->set(\get_bloginfo('name'));
        $this->page_description = (new ValueBuilderWithFilter('string'))->set(\get_bloginfo('description'));
    }

    protected function head(?IBuilder $after_header = null): IBuilder
    {
        return parent::head((new BuilderCollection)
            ->add_callback(function () {
                $title = $this->page_title->build('');
                $description = $this->page_description->build('');

                return <<< HTML
                <title>$title</title>
                <meta name="description" content="$description"/>
HTML;
            })
            ->add_element($after_header));
    }

    protected function header(?IBuilder $after_header = null): IBuilder
    {
        return parent::header((new BuilderCollection)
            ->add_element(new BuilderCallback((function () {
                $class_prefix = $this->theme_class_prefix->build('');
                $title = $this->page_title->build('');
                $description = $this->page_description->build('');

                return <<< HTML
<h1 class="$class_prefix-page-title">$title</h1>
<span class="$class_prefix-page-title__sub">$description</span>
HTML;
            })))
            ->add_element($after_header));
    }
}
