<?php
namespace App\Controllers\Api;

use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Server;

class MailchimpController extends WP_REST_Controller
{
    public function __construct()
    {
        $this->namespace = 'djc/v1';
        $this->rest_base = 'mailchimp';
    }
    
    /**
     * Register the routes for the objects of the controller.
     *
     * @see register_rest_route()
     */
    public function register_routes(): void
    {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods'               => WP_REST_Server::CREATABLE,
                    'callback'              => [$this, 'get_items'],
                    'permission_callback'   => [$this, 'get_items_permissions_check'],
                    'args'                  => $this->get_collection_params()
                ],
                'schema'    => [$this, 'get_item_schema']
            ]
        );
    }
    
    public function get_items_permissions_check($request)
    {
        return true;
    }
    
    /**
     * @param WP_REST_Request $request
     *
     * @return void|\WP_Error|\WP_REST_Response
     */
    public function get_items($request)
    {
    }
    
    public function get_collection_params()
    {
        $query_params =  parent::get_collection_params();
	       
        return apply_filters( 'rest_themes_collection_params', $query_params );
    }
}
