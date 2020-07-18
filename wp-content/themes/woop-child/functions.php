<?php

add_action('after_theme_setup', function () {
    woop_helper\require_once_directory('inc');

    woop_helper\require_once_directory('templates');

    woop_helper\require_once_directory('templates/partials');
});
