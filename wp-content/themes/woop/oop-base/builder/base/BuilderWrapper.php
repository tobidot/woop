<?php

namespace woop;

class BuilderWrapper extends Builder
{
    protected ?Builder $builder = null;

    public function __construct(?Builder $builder)
    {
        $this->set_inner_builder($builder);
    }

    public function set_inner_builder(?Builder $builder): self
    {
        $this->builder = $builder;
        return $this;
    }

    public function build(): string
    {
        return $this->builder->build();
    }
}
