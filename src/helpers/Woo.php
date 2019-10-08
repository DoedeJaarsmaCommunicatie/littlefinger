<?php
namespace App\Helpers;

use App\Exceptions\ProductNotFoundException;

class Woo
{
    /**
     * Returns the WC_Product if it exists
     *
     * @param int $ID
     *
     * @return false|\WC_Product|null
     */
    public static function getProduct(int $ID)
    {
        return wc_get_product($ID);
    }
    
    /**
     * @param int $ID
     *
     * @return \WC_Product
     * @throws ProductNotFoundException
     */
    public static function getProductOrFail(int $ID)
    {
        $product = self::getProduct($ID);
    
        if (false === $product || null === $product) {
            $error = new ProductNotFoundException("Product with $ID id not found");
            $error->throwWPError();
            
            if (Errors::isDebug()) {
                throw $error;
            }
        }
        
        return $product;
    }
}
