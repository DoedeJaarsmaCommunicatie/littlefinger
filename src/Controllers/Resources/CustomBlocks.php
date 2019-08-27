<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;
use Timber\Timber;

add_action(
	'carbon_fields_register_fields',
	 function () {
		 Block::make(__('Producten'))
		      ->add_fields(
		      	[
		      		Field::make('select', 'category', __('Category'))
			            ->set_options([
			            	'rood'  => 'Rode wijnen',
			            	'wit'  => 'Witte wijnen',
			            	'rose'  => 'Rose wijnen',
			            	'mousserend'  => 'Mousserende wijnen',
			            	'dessert'  => 'Dessert wijnen',
			            ]),
			        
			        Field::make('text', 'title', __('Title')),
			        
			        Field::make('text', 'limit', __('Limit'))
			            ->set_attribute('type', 'number')
			            ->set_attribute('min', 0)
			            ->set_attribute('max', 12)
		        ]
		      )
			 ->set_render_callback(static function ( $fields, $attributes ) {
				 $context = Timber::get_context();
				 $context['posts'] = Timber::get_posts(
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
				 $context['title'] = $fields['title']?? false;
				 
				 return Timber::render('partials/blocks/products.twig', $context);
			 });
	 }
);
