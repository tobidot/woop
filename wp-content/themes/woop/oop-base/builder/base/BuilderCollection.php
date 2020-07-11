<?php

namespace woop;

class BuilderCollection extends Builder
{
    protected array $elements = [];

    public function add_element(?IBuilder $element): self
    {
        if ($element === null) return $this;
        $this->elements[] = $element;
        return $this;
    }

    public function build(): string
    {
        return implode(
            '',
            array_map(function (IBuilder $element) {
                return $element->build();
            }, $this->elements)
        );
    }
}
