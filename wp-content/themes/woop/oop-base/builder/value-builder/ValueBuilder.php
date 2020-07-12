<?php

namespace woop;

use TypeError;

/**
 * An interface for Value that can be built iteratively.
 */
interface IValueBuilder
{
    public function is_valid_value($value): bool;
    public function set($value): self;
    public function get();
    public function build();
}

abstract class ValueBuilder implements IValueBuilder
{
    private bool $is_cached = false;
    private $cache = null;
    private $value = null;
    protected $type_check = null;

    public function __construct($type_check = null)
    {
        if (is_null($type_check)) return;
        if (is_string($type_check)) return;
        if (is_callable($type_check)) return;
        $type = gettype($type_check);
        throw new TypeError("Expected Argument 1 'type_check' in ValueBuilder::set_type_check to be a null|string|callable found $type.");
    }

    public function is_valid_value($value): bool
    {
        if ($this->type_check === null) return true;
        if (is_string($this->type_check)) return gettype($value) === $this->type_check;
        if (is_callable($this->type_check)) return ($this->type_check)($value);
        return false;
    }

    public function set($value): self
    {
        if (!$this->is_valid_value($value)) {
            $type = \woop_helper\get_type_or_classname($value);
            throw new TypeError("Argument 1 'value' in failed the type check found $type.");
        }
        $this->is_cached = false;
        $this->value = $value;
        return $this;
    }

    public function get()
    {
        return $this->value;
    }

    public function build($default = null)
    {
        if ($this->is_cached) {
            $value = $this->cache;
        } else {
            $value = $this->get();
            $this->cache = $value;
            $this->is_cached = true;
        }
        if ($value === null) return $default;
        return $value;
    }
}
