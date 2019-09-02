<?php
namespace App\Controllers\Meta;

use App\Enums\FontAwesome;
use Carbon_Fields\Field as Meta;
use Carbon_Fields\Container;

class MenuMeta extends Field {
	use FontAwesome;
	
	public function register(): void {
		Container::make('nav_menu_item', __('Menu Settings'))
			->add_fields(
				[
					Meta::make('select', 'menu_icon', __('Choose a menu icon'))
						->set_options($this->getIconsForSelect()),
					Meta::make('checkbox', 'has_shopping_bubble', __('Has shopping-cart bubble'))
				]
			);
	}
}
