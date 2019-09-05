<?php

namespace App\Controllers\Meta\Blocks;

use App\Controllers\Meta\Field;

abstract class Block extends Field
{
    abstract public function render($fields, $attributes, $inner_blocks);
    
    /**
     * The template
     *
     * @var string|array
     */
    protected $template;
    
    /**
     * @var \Carbon_Fields\Block
     */
    protected $block;
    
    public function __construct()
    {
        $this->block = new \Carbon_Fields\Block();
    }
    
    public function block(): \Carbon_Fields\Block
    {
        return $this->block;
    }
}
