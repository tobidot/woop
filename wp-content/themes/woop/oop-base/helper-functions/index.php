<?php

namespace woop_helper;

function require_once_all_sub_directories(string $dirname)
{
    $files = glob($dirname . '/**/*.php');
    foreach ($files as $file) {
        require_once($file);
    }
}

require_once_all_sub_directories(__DIR__);
