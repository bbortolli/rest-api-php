<?php

namespace App;

header('Content-Type: application/json; charset: utf-8');

require 'Models/Account.php';
require 'Models/Transaction.php';
use App\Models\Account;
use App\Models\Transaction;

$myRoutes = ['Account', 'Transaction'];

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
    $params = array();
    $params = $route[0];

    if(!in_array($model, $myRoutes, false)) {

        // Verify if model exist
        $response = array(
            'status' => '400',
            'statusMessage' => 'Bad Request');
        echo json_encode($response);
        return;
    }

    // Set expected control
    $controller = 'App\\Models\\' . $model . '\\' . $control;

    // Verify if control exist
    if(!function_exists($controller)) {
        $response = array(
            'status' => '400',
            'statusMessage' => 'Bad Request');
        echo json_encode($response);
        return;
    }

    if ($method === 'GET') {
        $response = call_user_func($controller, $params);
        echo $response;
        return;
    }

    if ($method === 'POST') {
        //$response = call_user_func($controller, $params);
        $body = file_get_contents('php://input');
        $response = call_user_func($controller, $body);
        echo $response;
        return;
    }
}