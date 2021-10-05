<?php

    namespace Src\App\Routes;

    use Src\Core\Router;

    //(providers) = String 'providers'
    //${provider_id} = Int
    Router::get('', 'StaticPagesController@serveLogin');
    Router::get('providers/${provider_id}', 'ProvidersController@edit');
    Router::get('users/${user_id}/books/${book_id}', 'StaticPagesController@serveHome');
    Router::get('providers', 'ProvidersController@index');
    //Router::get('(customers)\/\d+', 'StaticPagesController@serveHome');
    //Router::get('(products)\/\d+', 'StaticPagesController@index');

