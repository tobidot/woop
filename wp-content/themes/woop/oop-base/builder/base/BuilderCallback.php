<?php

namespace woop;

use Closure;

class BuilderCallback implements Builder
{
    protected Closure $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function build(): string
    {
        return $this->callback->call($this);
    }
}
