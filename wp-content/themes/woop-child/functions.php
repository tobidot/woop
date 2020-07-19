<?php

add_action('after_setup_theme', function () {
    woop_helper\require_once_directory(__DIR__ . '/inc');

    woop_helper\require_once_directory(__DIR__ . '/templates/partials');

    woop_helper\require_once_directory(__DIR__ . '/templates');
});
