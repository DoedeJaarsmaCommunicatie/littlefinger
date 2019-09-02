<?php

namespace App\Controllers\Meta\Blocks;

use Carbon_Fields\Field;
use Timber\Timber;

class Producten extends Block {
	protected $template = 'partials/blocks/products.twig';
	
	public function register(): void {
		$this->block()::make( __('Producten') )->add_fields($this->fields())->set_render_callback([$this, 'render']);
	}
	
	/**
	 * @param $fields
	 * @param $attributes
	 *
	 * @return bool|string
	 */
	public function render($fields, $attributes) {
		$context = Timber::get_context();
		
		$context['posts'] = Timber::get_posts(
			[
				'post_type'         => 'product',
				'posts_per_page'    => $fields['limit']?? 4,
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
		
		if ($this->isLargeSite()) {
			$context['link'] = $fields['link'];
		}
		
		$context['attributes'] = $attributes;
		$context['title'] = $fields['title']?? false;
		
		return Timber::render($this->template, $context);
	}
	
	public function fields(): array {
		$fields = [];
		$fields []= Field::make('select', 'category', __('Category'))
			->set_options(
				[
					'rood'          => 'Rode wijnen',
					'wit'           => 'Witte wijnen',
					'rose'          => 'Rose wijnen',
					'mousserend'    => 'Mousserende wijnen',
					'dessert'       => 'Dessert wijnen'
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
