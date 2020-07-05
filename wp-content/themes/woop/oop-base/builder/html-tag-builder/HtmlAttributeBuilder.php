<?php

namespace woop;

class HtmlAttributeBuilder
{
    private array $attributes = [];

    /**
     * @param string[] $attributes
     */
    public function set_attributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return string[]
     */
    public function get_attributes(): array
    {
        return $this->attributes;
    }

    public function add_attribute(string $key, ?string $value = null): self
    {
        $this->attributes[] = [$key, $value];
        return $this;
    }

    /**
     * remove
     * 
     * @return bool|string
     *  false => no attribute with such a key has been found
     *  true => the attribute exists without a value
     *  string => the value of the attribute
     */
    public function get_attribute(string $key)
    {
        return array_reduce($this->attributes, function ($value, array $next) use ($key) {
            if ($value !== false) return $value;
            if ($next[0] === $key) return ($key[1] !== null) ? $key[1] : true;
            return false;
        }, false);
    }

    /**
     * Filters all attributes with the key $key from this builder
     */
    public function remove_attribute(string $key): self
    {
        $this->attributes = array_filter($this->attributes, function ($value, array $next) use ($key) {
            if ($value !== false) return $value;
            if ($next[0] === $key) return ($key[1] !== null) ? $key[1] : true;
            return false;
        }, false);
        return $this;
    }

    public function build_attributes(): string
    {
        return implode(
            ' ',
            array_map(function (array $attribute_assignment) {
                [$key, $value] = $attribute_assignment;
                if ($value !== null) {
                    return "$key='$value'";
                } else {
                    return "$key";
                }
            }, $this->attributes)
        );
    }
}
