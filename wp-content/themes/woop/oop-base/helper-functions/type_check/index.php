<?php

namespace woop_helper;

function get_type_or_classname($value): string
{
    $basic_type = gettype($value);
    if ($basic_type !== 'object') return $value;
    return get_class($value);
}
