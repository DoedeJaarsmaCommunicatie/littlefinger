<?php
namespace App\Controllers\Meta\Blocks;

use Elderbraum\CasaProductFactory\ProductsFactory;
use Carbon_Fields\Field;
use Timber\Timber;

class ImageProducts extends Block
{
    protected $template = 'partials/blocks/products-image.html.twig';
    
    public function register() : void
    {
        $this->block()::make(__('Products image'))
            ->add_fields($this->getFields())
            ->set_render_callback([$this, 'render']);
    }
    
    public function render($fields, $attributes, $inner_blocks): void
    {
        $context = Timber::get_context();
    
        /** @var \Elderbraum\CasaProductFactory\Products\Product $product */
        $product = ProductsFactory::create(
            $fields[ 'category' ] ?? '\\Elderbraum\\CasaProductFactory\\Products\\Red'
        );
        
        $context ['posts'] = Timber::get_posts($product->boot()->limit()->get_args());
        
        $context['attributes'] = $attributes;
        $context['button_text'] = $fields['button_text'] ?? false;
        $context['image_title'] = $fields['image_title'] ?? false;
        $context['link'] = $fields['link'] ?? false;
        $context['image_right'] = $fields['image_right'] ?? false;
        $context['image'] = $fields['image'] ?? false;
        
        Timber::render($this->template, $context);
    }
    
    public function getFields(): array
    {
        return [
            Field::make('select', 'category', __('Category'))
                 ->set_options(
                     [
                         '\\Elderbraum\\CasaProductFactory\\Products\\Red'          => 'Rode wijnen',
                         '\\Elderbraum\\CasaProductFactory\\Products\\White'        => 'Witte wijnen',
                         '\\Elderbraum\\CasaProductFactory\\Products\\Rose'         => 'Rose wijnen',
                         '\\Elderbraum\\CasaProductFactory\\Products\\Mousserend'   => 'Mousserende wijnen',
                         '\\Elderbraum\\CasaProductFactory\\Products\\Dessert'      => 'Dessert wijnen',
                     ]
                 ),
            
            Field::make('text', 'button_text', __('Title Button')),
            
            Field::make('image', 'image', __('Image')),
            
            Field::make('text', 'image_title', __('Overlay text')),
            
            Field::make('text', 'link', __('Link')),
            
            Field::make('checkbox', 'image_right', __('Afbeelding rechts'))
        ];
    }
}
