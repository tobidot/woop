<?php

use woop\ArchiveTemplateBuilder;

$template = new ArchiveTemplateBuilder;
$template->page_title->set('Home');

$template->print();
