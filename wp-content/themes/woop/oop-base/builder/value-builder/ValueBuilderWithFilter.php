<?php

namespace woop;

use Closure;
use TypeError;

use function woop_helper\get_type_or_classname;

class ValueBuilderWithFilter extends ValueBuilder
{
    private array $filters = [];

    public function build($default = null)
    {
        $original_value = $this->get();
        $result = array_reduce($this->filters, function ($value, callable $next) use ($original_value) {
            $result = $next($value, $original_value);
            if (!$this->is_valid_value($result)) {
                $type = get_type_or_classname($result);
                throw new TypeError("Result of filter in ValueBuilderWithFilter::build is not a valid type, found $type");
            }
            return $result;
        }, $original_value);
        if ($result === null) return $default;
        return $result;
    }

    /**
     * Add a filter to change the result of this Value
     * 
     * @param Closure $filter 
     *  ($current_value, $original_value) => new_value
     */
    public function add_filter(Closure $filter): self
    {
        $this->filters[] = $filter;
        return $this;
    }
}
