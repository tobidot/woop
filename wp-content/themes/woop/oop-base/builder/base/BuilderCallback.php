<?php

namespace woop;

use Closure;
use Exception;
use TypeError;

class BuilderCallback extends Builder
{
    protected Closure $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function build(): string
    {
        $result = ($this->callback)();
        if (!is_string($result)) {
            $type_returned = gettype($result);
            if ($type_returned === 'object') $type_returned = get_class($result);
            throw new TypeError("Argument returned by BuilderCallback::\$callback is expected to be 'string', found $type_returned.");
        }
        return $result;
    }
}
