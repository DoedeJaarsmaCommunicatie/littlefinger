<?php
namespace App\Controllers\Meta\Blocks;

use App\Models\Product;
use Elderbraum\CasaProductFactory\ProductsFactory;
use Carbon_Fields\Field;
use Timber\Timber;

class ImageProducts extends Block
{
    protected $template = 'partials/blocks/products-image.html.twig';
    
    private static $options = [
        '\\Elderbraum\\CasaProductFactory\\Products\\Red'          => 'Rode wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\White'        => 'Witte wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Rose'         => 'Rose wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Mousserend'   => 'Mousserende wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Dessert'      => 'Dessert wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Awarded'      => 'Prijswinnende wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Biologisch'   => 'Biologische wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Newest'       => 'Nieuwste wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Popular'      => 'Populaire wijnen',
        '\\Elderbraum\\CasaProductFactory\\Products\\Sale'         => 'Sale wijnen',
    ];
    
    
    
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
        $product = ProductsFactory::create($this->getCategory($fields));
        
        $context ['posts'] = Timber::get_posts($product->boot()->limit()->get_args(), Product::class);
        
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
                 ->set_options(self::$options),
            
            Field::make('text', 'button_text', __('Title Button')),
            
            Field::make('image', 'image', __('Image')),
            
            Field::make('text', 'image_title', __('Overlay text')),
            
            Field::make('text', 'link', __('Link')),
            
            Field::make('checkbox', 'image_right', __('Afbeelding rechts'))
        ];
    }
    
    private function getCategory($fields): string
    {
        if (!isset($fields['category']) || $fields['category'] === '') {
            return self::DEFAULT;
        }
        
        if (!array_key_exists($fields['category'], self::$options)) {
            return self::DEFAULT;
        }
        
        return $fields[ 'category' ];
    }
}
