<?php

namespace woop;

class BuilderCollection implements Builder
{
    protected array $elements = [];

    public function add_element(Builder $element): self
    {
        $this->elements[] = $element;
        return $this;
    }

    public function build(): string
    {
        return implode(
            '',
            array_map(function (Builder $element) {
                return $element->build();
            }, $this->elements)
        );
    }
}
