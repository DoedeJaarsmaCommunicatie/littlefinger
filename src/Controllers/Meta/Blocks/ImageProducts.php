<?php


namespace App\Controllers\Meta\Blocks;


use Carbon_Fields\Field;
use Timber\Timber;

class ImageProducts extends Block {
	protected $template = 'partials/blocks/products-image.html.twig';
	
	public function register() : void {
		$this->block()::make(__('Products image'))
			->add_fields($this->getFields())
			->set_render_callback([$this, 'render']);
	}
	
	public function render( $fields, $attributes ) {
		$context = Timber::get_context();
		
		$context['posts'] = Timber::get_posts(
			[
				'post_type'         => 'product',
				'posts_per_page'    => 4,
				'post_status'       => 'publish',
				'tax_query' => [
					[
						'taxonomy'  => 'product_cat',
						'terms'     => $fields['category'],
						'field'     => 'slug'
					]
				]
			]
		);
		
		$context['attributes'] = $attributes;
		$context['button_text'] = $fields['button_text']?? false;
		$context['image_title'] = $fields['image_title']?? false;
		$context['link'] = $fields['link']?? false;
		$context['image_right'] = $fields['image_right']?? false;
		$context['image'] = $fields['image']?? false;
		
		return Timber::render($this->template, $context);
	}
	
	private function getFields(): array {
		return [
			Field::make('select', 'category', __('Category'))
			     ->set_options(
				     [
					     'rood'          => 'Rode wijnen',
					     'wit'           => 'Witte wijnen',
					     'rose'          => 'Rose wijnen',
					     'mousserend'    => 'Mousserende wijnen',
					     'dessert'       => 'Dessert wijnen'
				     ]
			     ),
			
			Field::make('text', 'button_text', __('Title Button')),
			
			Field::make('image', 'image', __('Image')),
			
			Field::make('text', 'image_title', __('Overlay text')),
			
			Field::make('text', 'link', __('Link')),
			
			Field::make( 'checkbox', 'image_right', __( 'Afbeelding rechts' ) )
		];
	}
}
