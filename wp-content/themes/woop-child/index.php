<?php

use woop\BuilderCallback;
use woop\HtmlStringBuilder;

global $post;
if (have_posts()) {
    the_post();
}

$template = new my_theme\GenericTemplateBuilder();

echo $template->set_content(
    new BuilderCallback(function () {
        return apply_filters('the_content', get_the_content());
    })
)->build();
