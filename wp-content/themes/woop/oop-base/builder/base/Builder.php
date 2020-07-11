<?php

namespace woop;

interface IBuilder
{
    public function build(): string;
    public function print(): void;
}

abstract class Builder implements IBuilder
{
    public function print(): void
    {
        echo $this->build();
    }
}
