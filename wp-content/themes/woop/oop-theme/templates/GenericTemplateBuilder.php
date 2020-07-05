<?php

namespace my_theme;

class GenericTemplateBuilder extends \woop\TemplateBuilder
{
    protected string $content = '';

    public function set_content(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function main(string $content = ''): string
    {
        $content .= $this->content;
        return parent::main($content);
    }
}
