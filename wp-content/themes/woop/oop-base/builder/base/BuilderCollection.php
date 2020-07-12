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

    /**
     * Helper function wich automaticly wraps the function with a BuilderCallback
     * @param callable|null $fn
     *  () => string
     */
    public function add_callback(?callable $fn): self
    {
        if ($fn === null) return $this;
        $this->elements[] = new BuilderCallback($fn);
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
