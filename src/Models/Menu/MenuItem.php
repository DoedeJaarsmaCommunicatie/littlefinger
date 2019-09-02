<?php
namespace App\Models\Menu;

class MenuItem extends \Timber\MenuItem {
	public function get_field( $field_name ) {
		$value = carbon_get_nav_menu_item_meta($this->id, $field_name);
		return $value;
	}
}
