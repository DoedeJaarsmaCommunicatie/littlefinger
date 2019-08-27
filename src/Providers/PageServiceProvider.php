<?php
namespace App\Providers;

use Carbon\Carbon;
use Pagerange\Markdown\MetaParsedown;

class PageServiceProvider
{
	/** @var array $files */
	protected $files;
	public function __construct()
	{
		$this->fill_files();
		$this->create_pages();
	}
	
	protected function create_pages()
	{
		$mp = new MetaParsedown();
		
		foreach ($this->files as $file) {
			$ct = file_get_contents($file);
			
			$meta = $mp->meta($ct);
			if (!isset($meta['slug'])) {
				throw new \Exception( 'Slug not passed to page' );
			}
			
			if (!isset($meta['created_at'])) {
				throw new \Exception( 'Date not passed to page' );
			}
			$slug = $meta['slug'];
			$date = $meta['created_at'];
			
			/** @var \WP_Post $page */
			$page = $this->getPage($slug);
			if ($page && Carbon::parse($page->post_date)->isBefore($date)) {
				continue;
			}
			
			if ($meta['parent'] !== null) {
				$q = new \WP_Query(['post_type' => 'page', 'pagename' => $meta['parent']]);
			}

			wp_insert_post([
				'post_author'           => $meta['author']?? 1,
				'post_content'          => $mp->text($ct),
				'post_title'            => $meta['title'],
				'post_name'             => $slug,
				'post_status'           => $meta['status']?? 'draft',
				'post_type'             => 'page',
				'post_parent'           => 0,
			]);
		}
	}
	
	protected function fill_files()
	{
		$directory = get_stylesheet_directory() . '/page_templates/';
		
		array_map(function ($file) use ($directory) {
			$this->files []= $directory . $file;
		},
		[
			'about_us.md',
			'terms.md',
			'pros.md'
		]);
	}
	
	private function getPage(string $slug) {
		$args = [
			'post_type' => 'page',
			'pagename'  => $slug
		];
		
		$query = new \WP_Query($args);
		
		if (!$query->have_posts()) {
			return false;
		} elseif ($query->post_count > 1) {
			throw new \Exception('Multiple pages with same slug exist');
		} else {
			return $query->posts[0];
		}
	}
}
