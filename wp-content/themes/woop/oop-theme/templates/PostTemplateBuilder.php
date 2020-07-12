<?php


namespace my_theme;

use woop\BuilderCallback;
use woop\BuilderCollection;
use woop\IBuilder;
use woop\ThemeTemplateBuilder;

class PostTemplateBuilder extends ThemeTemplateBuilder
{
    public BannerPartialTemplate $banner;

    public function __construct()
    {
        parent::__construct();
        $this->page_title->set(\get_the_title());
        $this->banner = new BannerPartialTemplate;
        $this->banner->banner_text->set(\get_the_title());
    }

    public function header(?IBuilder $inner = null): IBuilder
    {
        return parent::header($this->banner);
    }

    public function main(?IBuilder $inner = null): IBuilder
    {
        $post_content_builder = new BuilderCallback(function () {
            return apply_filters('the_content', get_the_content());
        });
        return parent::main((new BuilderCollection)
            ->add_element($post_content_builder)
            ->add_element($inner));
    }
}
