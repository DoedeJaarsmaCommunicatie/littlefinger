<?php
namespace App\Controllers\Filters;

class Cart extends Filter
{
    public function boot()
    {
        $this->add_filter('woocommerce_shipping_estimate_html', [ $this, 'shipping_estimate_html']);
    }
    
    public function shipping_estimate_html($context)
    {
        return __('Op de volgende pagina kunt u avondlevering en andere verzendopties kiezen', 'ltfg');
    }
}
