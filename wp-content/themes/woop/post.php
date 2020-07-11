<?php

use woop\BuilderCallback;

$template = new my_theme\GenericTemplateBuilder();


echo $template->set_content(
    new BuilderCallback(function () {
        return apply_filters('the_content', get_the_content());
    })
)->build();
