<?php

namespace App;

header('Content-Type: application/json; charset: utf-8');

require 'config/Routes.php';
require 'Models/Account.php';
require 'Models/Transaction.php';
use App\Models\Account;
use App\Models\Transaction;

if (isset($_REQUEST)) {

    $method = $_SERVER[REQUEST_METHOD];
    $route = explode('/', $_REQUEST['url']);

    // Get model
    $model = ucfirst($route[0]);
    array_shift($route);

    // Get controller
    $control = $route[0];
    array_shift($route);

    // Get params
    $param = array();
    $param = $route[0];

    // Verify param
    if( !filter_var($param, FILTER_VALIDATE_INT) ) {

        http_response_code(400);

        $response = array(
            'statusMessage' => "Wrong params");
        echo json_encode($response);
        return;
    }

    // Verify if model NO exist
    if(!in_array($model, $myModels, false)) {

        http_response_code(400);

        $response = array(
            'statusMessage' => "Target don't exist");
        echo json_encode($response);
        return;
    }

    // Set expected control
    $controller = 'App\\Models\\' . $model . '\\' . $control;

    // Verify if control NO exist
    if(!function_exists($controller)) {

        http_response_code(400);

        $response = array(
            'statusMessage' => "Target don't exist");
        echo json_encode($response);
        return;
    }

    // Validate if  HTTP Request Method is valid for the route
    if ($myRoutes[$model][$control] !== $method) {

        http_response_code(405);

        $response = array(
            'statusMessage' => 'Method Not Allowed');
        echo json_encode($response);
        return;
    }


    // GET and DELETE calls a function sending the param received from the URL
    if ($method === 'GET' || $method === 'DELETE') {
        $response = call_user_func($controller, $param);
        echo $response;
        return;
    }
    // POST and PUT receive params from php input and calls a function sending those params
    else if ($method === 'POST' || $method === 'PUT') {
        $body = file_get_contents('php://input');
        $response = call_user_func($controller, $body);
        echo $response;
        return;
    }
    else {
        http_response_code(405);
        $response = array(
            'statusMessage' => 'Method Not Allowed');
        echo json_encode($response);
        return;
    }
}