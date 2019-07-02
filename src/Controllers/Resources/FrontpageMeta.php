<?php

use Carbon_Fields\Field;

add_action(
	'carbon_fields_register_fields',
	function () {
		\Carbon_Fields\Container::make('theme_options', 'Frontpage Data')
			->add_fields(
				[
					Field::make('text', 'title', __('Title')),
					Field::make( 'association', 'featured_product', __( 'Featured' ) )
					     ->set_types( [
						     [
							     'type'      => 'post',
							     'post_type' => 'product',
						     ]
					     ] ),
					Field::make( 'image', 'hero_image', __( 'Image' ) )
				]
			);
	}
);
