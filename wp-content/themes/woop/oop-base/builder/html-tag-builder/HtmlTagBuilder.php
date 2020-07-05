<?php

namespace woop;

/**
 * 
 */
class HtmlTagBuilder implements Builder
{
    private BuilderCollection $children;
    private HtmlAttributeBuilder $attributes;
    private string $tagname = 'div';
    private bool $_is_selfclosing = false;

    public function __construct()
    {
        $this->children = new BuilderCollection();
        $this->attributes = new HtmlAttributeBuilder();
    }

    public function set_is_selfclosing(bool $is_selfclosing): self
    {
        $this->_is_selfclosing = $is_selfclosing;
        return $this;
    }

    public function is_selfclosing(): bool
    {
        return $this->_is_selfclosing;
    }

    public function set_attributes_builder(HtmlAttributeBuilder $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function get_attributes_builder(): HtmlAttributeBuilder
    {
        return $this->attributes;
    }

    public function set_children(BuilderCollection $children): self
    {
        $this->children = $children;
        return $this;
    }

    public function get_children(): BuilderCollection
    {
        return $this->children;
    }

    public function set_tagname(string $tagname): self
    {
        $this->tagname = $tagname;
        return $this;
    }

    public function get_tagname(): string
    {
        return $this->tagname;
    }

    /**
     * @return string
     *  the complete Tag as a string
     */
    public function build(): string
    {
        $tagname = $this->get_tagname();
        $attributes = $this->attributes->build_attributes();
        $result = "<$tagname $attributes";
        if ($this->is_selfclosing()) {
            $result .= "/>";
        } else {
            $children = $this->children->build();
            $result .= ">$children</$tagname>";
        }
        return $result;
    }
}
