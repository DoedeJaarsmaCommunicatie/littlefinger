<?php

namespace App\Controllers\Http;


use Timber\Post;
use Timber\Timber;

abstract class Controller
{
    abstract protected function register(): void;
    
    /**
     * @var Post|\App\Post The current post
     */
    public $post;
    
    /**
     * @var array Timber context
     */
    protected $context;
    
    /**
     * Controller constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->setPost($post);
        $this->context = Timber::get_context();
        
        $this->boot();
        $this->register();
    }
    
    protected function boot(): void
    {
        $this->context['post'] = $this->post;
    }
    
    
    protected function getThemeOption(string $key)
    {
        return carbon_get_theme_option($key);
    }
    
    protected function isLargeSite(): bool
    {
        return get_theme_mod('large_layout');
    }
    
    /**
     * @return Post
     */
    public function getPost() : Post
    {
        return $this->post;
    }
    
    /**
     * @param Post $post
     */
    public function setPost(Post $post) : void
    {
        $this->post = $post;
    }
    
    /**
     * @return array
     */
    public function getContext() : array
    {
        return $this->context;
    }
}
