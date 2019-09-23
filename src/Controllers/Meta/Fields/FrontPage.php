<?php
namespace App\Controllers\Meta\Fields;

use App\Controllers\Meta\Field;
use Carbon_Fields\Container;
use Carbon_Fields\Field as Meta;

class FrontPage extends Field
{
    public function register(): void
    {
        Container::make('post_meta', __('Page settings'))
            ->where('post_type', '=', 'page')
            ->where('post_id', '=', get_option('page_on_front'))
            ->add_fields($this->getFields());
    }
    
    private function getFields(): array
    {
        $fields = [];
        $fields [] = Meta::make('text', 'title', __('Title'));
        if (!$this->isLargeSite()) {
            $fields [] = Meta::make('association', 'featured_product', __('Featured'))
                             ->set_types([
                                 [
                                     'type'  => 'post',
                                     'post_type' => 'product'
                                 ]
                             ]);
        }
        $fields [] = Meta::make('image', 'hero_image', __('Image'));
        
        if ($this->isLargeSite()) {
            $fields [] = Meta::make('text', 'subtitle', __('Subtitle'));
        }
        
        return $fields;
    }
}
