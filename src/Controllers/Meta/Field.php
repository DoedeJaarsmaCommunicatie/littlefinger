<?php
namespace App\Controllers\Meta;

abstract class Field {
	/**
	 * Register
	 *
	 * @return void;
	 */
	abstract public function register(): void;
	
	protected function isLargeSite(): bool {
		return get_theme_mod('large_layout');
	}
}
