<?php
namespace App\Controllers\Meta\Options;

use App\Controllers\Meta\Field;
use Carbon_Fields\Container;
use Carbon_Fields\Field\Field as Meta;

class Theme extends Field {
	public function register() : void {
		Container::make('theme_options', 'Frontpage Data')
			->add_fields(
				[
					Meta::make('text', 'title', __('Title')),
					
					Meta::make('association', 'featred_product', __('Featured'))
						->set_types(
							[
								[
									'type'  => 'post',
									'post_type' => 'product'
								]
							]
						),
					
					Meta::make('image', 'hero_image', __('Image'))
				]
			);
	}
}
