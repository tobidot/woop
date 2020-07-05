<?php

global $post;
if (have_posts()) {
    the_post();
}

$template = new my_theme\GenericTemplateBuilder();

echo $template->set_content(
    apply_filters('the_content', get_the_content())
)->build();
