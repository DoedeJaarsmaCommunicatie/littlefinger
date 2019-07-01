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
			            ])
		        ]
		      )
			 ->set_render_callback(static function ($fields) {
				 $context = \Timber\Timber::get_context();
				 $context['posts'] = \Timber\Timber::get_posts(
				 	[
				 		'post_type'         => 'product',
					    'posts_per_page'    => 12,
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
				
				 return \Timber\Timber::render('partials/blocks/products.twig', $context);
			 });
	 }
);
