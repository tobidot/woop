<?php

namespace my_theme;

use woop\Builder;
use woop\BuilderCallback;
use woop\IBuilder;
use woop\ValueBuilderWithFilter;

trait BannerPartialTemplate
{
    // public ValueBuilderWithFilter $banner_text;

    // public function __construct()
    // {
    //     $this->banner_text = new ValueBuilderWithFilter('string');
    //     $this->banner_text->set('Demo Text');
    // }

    public function header(?IBuilder $builder = null): IBuilder
    {
        // $text = $this->banner_text->build('');
        return parent::header(new BuilderCallback(function () use ($builder) {
            $text = $builder ? $builder->build() : '';
            return <<< HTML
        <div class="header-banner">
            <span class="header-banner__text">
                {$text}
            </span>
        </div>
HTML;
        }));
    }
}
