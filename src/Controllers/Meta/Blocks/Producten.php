<?php

namespace App\Controllers\Meta\Blocks;

use Elderbraum\CasaProductFactory\ProductsFactory;
use Carbon_Fields\Field;
use Timber\Timber;

class Producten extends Block
{
    protected $template = 'partials/blocks/products.twig';
    
    public function register(): void
    {
        $this->block()::make(__('Producten'))
                      ->add_fields($this->fields())
                      ->set_preview_mode(false)
                      ->set_description('Een block met producten naast elkaar.')
                      ->set_render_callback([$this, 'render']);
    }
    
    /**
     * @param $fields
     * @param $attributes
     * @param $inner_blocks
     *
     * @return bool|string
     */
    public function render($fields, $attributes, $inner_blocks)
    {
        $context = Timber::get_context();
    
        /** @var \Elderbraum\CasaProductFactory\Products\Product $product */
        $product = ProductsFactory::create(
            $fields[ 'category' ] ?? '\\Elderbraum\\CasaProductFactory\\Products\\Red'
        );
        
        $context ['posts'] = Timber::get_posts($product->boot()->limit($fields['limit']?? 20)->get_args());
        if ($this->isLargeSite()) {
            $context['link'] = $fields['link'];
        }
        
        $context['attributes'] = $attributes;
        $context['title'] = $fields['title'] ?? false;
        
        Timber::render($this->template, $context);
    }
    
    public function fields(): array
    {
        $fields = [];
        $fields [] = Field::make('select', 'category', __('Category'))
            ->set_options(
                [
                    '\\Elderbraum\\CasaProductFactory\\Products\\Red'          => 'Rode wijnen',
                    '\\Elderbraum\\CasaProductFactory\\Products\\White'        => 'Witte wijnen',
                    '\\Elderbraum\\CasaProductFactory\\Products\\Rose'         => 'Rose wijnen',
                    '\\Elderbraum\\CasaProductFactory\\Products\\Mousserend'   => 'Mousserende wijnen',
                    '\\Elderbraum\\CasaProductFactory\\Products\\Dessert'      => 'Dessert wijnen',
                ]
            );
        
        $fields [] = Field::make('text', 'title', __('Title'));
        
        if ($this->isLargeSite()) {
            $fields [] = Field::make('text', 'link', __('Link'));
        } else {
            $fields [] = Field::make('text', 'limit', __('Limit'))
                            ->set_attribute('type', 'number')
                            ->set_attribute('min', 0)
                            ->set_attribute('max', 20);
        }

        return $fields;
    }
}
