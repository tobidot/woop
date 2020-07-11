<?php

namespace my_theme;

use woop\BuilderCallback;
use woop\BuilderCollection;
use woop\IBuilder;

class GenericTemplateBuilder extends \woop\TemplateBuilder
{
    protected ?IBuilder $content = null;

    public function set_content(?IBuilder $content = null): self
    {
        $this->content = $content;
        return $this;
    }

    public function main(?IBuilder $inner = null): IBuilder
    {
        return new BuilderCallback((function () use ($inner) {
            return parent::main((new BuilderCollection)
                ->add_element($this->content)
                ->add_element($inner))
                ->build();
        })->bindTo($this));
    }
}
