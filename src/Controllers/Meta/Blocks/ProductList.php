<?php
namespace App\Controllers\Meta\Blocks;

use App\Models\Product;
use Carbon_Fields\Field;
use Elderbraum\CasaProductFactory\ProductsFactory;
use Timber\Timber;

class ProductList extends Block
{
    protected $template = 'partials/blocks/products-list.twig';
    
    public function register(): void
    {
        $this->block()::make(__('Producten list'))
             ->add_fields($this->fields())
             ->set_preview_mode(false)
             ->set_description('Een block met producten naast en onder elkaar.')
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
        
        $context ['posts'] = Timber::get_posts($product->boot()->limit((int) ($fields['limit'] ?? 10))->get_args(), Product::class);
        if ($this->isLargeSite()) {
            $context['link'] = $fields['link'] ?? '';
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
                                  '\\Elderbraum\\CasaProductFactory\\Products\\Awarded'      => 'Prijswinnende wijnen',
                                  '\\Elderbraum\\CasaProductFactory\\Products\\Biologisch'   => 'Biologische wijnen',
                                  '\\Elderbraum\\CasaProductFactory\\Products\\Newest'       => 'Nieuwste wijnen',
                                  '\\Elderbraum\\CasaProductFactory\\Products\\Popular'      => 'Populaire wijnen',
                                  '\\Elderbraum\\CasaProductFactory\\Products\\Sale'         => 'Sale wijnen',
                              ]
                          );
        
        $fields [] = Field::make('text', 'limit', __('Limit'))
                          ->set_attribute('type', 'number')
                          ->set_attribute('min', 0)
                          ->set_attribute('max', 20);
        
        return $fields;
    }
}
