<?php
namespace App\Controllers\Api;

use GuzzleHttp\Exception\GuzzleException;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use WP_Error;
use GuzzleHttp\Client;
use DusanKasan\Knapsack\Collection;

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
                    'callback'              => [$this, 'create_item'],
                    'permission_callback'   => [$this, 'create_item_permissions_check'],
                    'args'                  => $this->get_collection_params()
                ],
                'schema'    => [$this, 'get_item_schema']
            ]
        );
    }
    
    public function create_item_permissions_check($request)
    {
        return true;
    }
    
    /**
     * Creates a new subscriber in mailchimp
     *
     * @param WP_REST_Request $request Full details about the request.
     *
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     * @throws GuzzleException
     */
    public function create_item($request)
    {
        $key = get_theme_mod('mailchimp_key');
        $split_key = explode('-', $key);
        $list = get_theme_mod('mailchimp_list');
        $dc = $split_key[count($split_key) - 1];
        $fields = new Collection(get_theme_mod('mailchimp_fields'));

        $fields_required = $fields->filter(static function ($value) {
            return $value['required'];
        })
        ->toArray();

        foreach ($fields_required as $field) {
            if (!isset($request[$field['id']])) {
                return new WP_Error(
                    'required_field_not_filled',
                    sprintf('Required field %s not supplied', $field['id']),
                    [
                        'status'    => 400
                    ]
                );
            }
        }

        $client = new Client();

        $client->request(
            'POST',
            "https://$dc.api.mailchimp.com/3.0/lists/$list/members",
            [
                'headers'   => [
                    'Authorization'  => 'Basic ' . base64_encode("anystring:$key"),
                ],
                'json'          => [
                    'email_address' => $request[$fields->filter(static function ($v) {
                        return $v['type'] === 'email';
                    })->first()['id']],
                    'status'        => 'pending',
                    'merge_fields'   => $fields->map(static function ($f) use ($request) {
                        $v = $request[$f['id']];
                        if (!$v || $f['id'] === 'EMAIL') {
                            return [];
                        }
                        
                        return [$f['id'] => $request [$f['id']]];
                    })->flatten()->toArray()
                ]
            ]
        );


        $response = new WP_REST_Response();

        return $response;
    }
    
    public function get_collection_params()
    {
        $query_params =  parent::get_collection_params();
        
        return apply_filters('rest_themes_collection_params', $query_params);
    }
}
