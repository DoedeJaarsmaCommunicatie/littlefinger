<?php
namespace App\Enums;

use Exception;

trait FontAwesome {
	public $icons = [
		'phone'     => [
			'title' => 'Phone',
			'icon'  => 'fas fa-phone'
		],
		'user'      => [
			'title' => 'User',
			'icon'  => 'fas fa-user'
		],
		'shopping-cart' => [
			'title' => 'Shopping Cart',
			'icon'  => 'fas fa-shopping-cart'
		],
		'smile'     => [
			'title' => 'Smile',
			'icon'  => 'fas fa-smile'
		],
		'check'     => [
			'title' => 'Checkmark',
			'icon'  => 'fas fa-check'
		],
		'file'      => [
			'title' => 'File',
			'icon'  => 'fas fa-file'
		],
		'clock'     => [
			'title' => 'Clock',
			'icon'  => 'far fa-clock'
		],
		'truck'     => [
			'title' => 'Truck',
			'icon'  => 'fas fa-truck'
		],
		'wineglass' => [
			'title' => 'Wineglass',
			'icon'  => 'fas fa-wine-glass-alt'
		],
		'home'      => [
			'title' => 'Huis',
			'icon'  => 'fas fa-home'
		],
		'trophy'    => [
			'title' => 'Beker',
			'icon'  => 'fas fa-trophy'
		]
	];
	
	/**
	 * Get an icon from the base array
	 *
	 * @param string $key the key to search for
	 * @param null   $type the type to get (title or icon)
	 *
	 * @return string|array
	 * @throws Exception
	 */
	public function getIcon(string $key, $type = null) {
		if (!array_key_exists($key, $this->icons)) {
			throw new Exception('Key does not exist');
		}
		
		if ($type) {
			return $this->icons[$key][$type];
		}
		return $this->icons[$key];
	}
	
	/**
	 * Get the icons as array ready for select options.
	 *
	 * @param bool $escaped Escape the id in the array
	 *
	 * @return array the icons in icon -> title format
	 */
	public function getIconsForSelect($escaped = true): array {
		$data = [];
		foreach ($this->icons as $icon) {
			if ($escaped) {
				$data[str_replace(' ', '_', $icon['icon'])] = $icon['title'];
			} else {
				$data[$icon['icon']] = $icon['title'];
			}
		}
		
		return $data;
	}
	
	/**
	 * @param $params
	 *
	 * @throws Exception
	 */
	public function pushIcon($params): void {
		if (is_array($params)) {
			if (!array_key_exists('title', $params)) {
				throw new Exception('Title not passed');
			}
			if (!array_key_exists('id', $params)) {
				throw new Exception('Identifier not passed');
			}
			if (!array_key_exists('icon', $params)) {
				throw new Exception('Icon not passed');
			}
			
			$this->icons [$params['id']] = [
				'title' => $params['title'],
				'icon' => $params['icon']
			];
		}
	}
}
