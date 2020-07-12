<?php

the_post();

$template = new my_theme\PostTemplateBuilder();

echo $template->build();
