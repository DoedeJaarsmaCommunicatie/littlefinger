<?php
namespace App\Controllers\Http;

use App\Post;
use Timber\Image;

class FrontPage extends Controller
{
    protected function register() : void
    {
        if (!$this->isLargeSite()) {
            $this->addFeaturedProduct();
        }
        
        $this->addTitle();
        
        if ($this->isLargeSite()) {
            $this->addTitle('subtitle');
        }
        
        $this->addHeroImage();
    }
    
    protected function addHeroImage(): void
    {
        if ($hero_image = $this->post->get_field('hero_image')) {
            $img = new Image($hero_image);
            $this->context['hero_image'] = $img->src();
        } elseif ($hero_image = $this->getThemeOption('hero_image')) {
            $img = new Image($hero_image);
            $this->context['hero_image'] = $img->src();
        }
    }
    
    protected function addTitle($type = 'title'): void
    {
        if ($title = $this->post->get_field($type)) {
            $this->context[$type] = $title;
        } elseif ($title = $this->getThemeOption($type)) {
            $this->context[$type] = $title;
        }
    }
    
    protected function addFeaturedProduct(): void
    {
        if ($featured = $this->post->get_field('featured_product')) {
            $this->context ['featured'] = new Post($featured[0]['id']);
        } elseif ($featured = $this->getThemeOption('featured_product')) {
            $this->context ['featured'] = new Post($featured[0]['id']);
        }
    }
}
