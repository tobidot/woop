<?php

namespace woop;

class HtmlStringBuilder extends Builder
{
    protected string $text = '';

    public function add_text(string $text): self
    {
        $this->text .= $text;
        return $this;
    }

    public function build(): string
    {
        return $this->text;
    }
}
