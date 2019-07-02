<?php

use Carbon_Fields\Block;

add_action(
	'carbon_fields_register_fields',
	 function () {
		 Block::make(__('Producten'))
		      ->add_fields(
		      	[
		      		\Carbon_Fields\Field::make('select', 'category', __('Category'))
			            ->set_options([
			            	'rood'  => 'Rode wijnen',
			            	'wit'  => 'Witte wijnen',
			            	'rose'  => 'Rose wijnen',
			            	'mousserend'  => 'Mousserende wijnen',
			            	'dessert'  => 'Dessert wijnen',
			            ]),
			        
			        \Carbon_Fields\Field::make('text', 'limit', __('Limit'))
			            ->set_attribute('type', 'number')
			            ->set_attribute('min', 0)
			            ->set_attribute('max', 8)
		        ]
		      )
			 ->set_render_callback(static function ( $fields, $attributes ) {
				 $context = \Timber\Timber::get_context();
				 $context['posts'] = \Timber\Timber::get_posts(
				 	[
				 		'post_type'         => 'product',
					    'posts_per_page'    => $fields['limit']?? 12,
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
				
				 return \Timber\Timber::render('partials/blocks/products.twig', $context);
			 });
	 }
);
