<?php

namespace my_theme;

use woop\ValueBuilderWithFilter;

class BannerPartialTemplate extends \woop\Builder
{
    public ValueBuilderWithFilter $banner_text;

    public function __construct()
    {
        $this->banner_text = new ValueBuilderWithFilter('string');
        $this->banner_text->set('Demo Text');
    }

    public function build(): string
    {
        $text = $this->banner_text->build('');
        return <<< HTML
        <div class="header-banner">
            <span class="header-banner__text">
                $text
            </span>
        </div>
HTML;
    }
}
