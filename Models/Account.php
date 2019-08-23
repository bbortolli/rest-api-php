<?php

namespace App\Models\Account;

header('Content-Type: application/json; charset: utf-8');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/config/cfg.php');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function getAccount($id) {

    if (!$id) {
        http_response_code(200);
        $response = array(
            'message' => 'Please inform ID',
            'data' => '');
        return json_encode($response);
    }
    else { 
        $data = find('accounts', $id);
        
        http_response_code(200);
        $response = array(
            'message' => 'Search complete',
            'data' => $data);
        return json_encode($response);
    }
}

function addAccount($params) {
    
    $decodedParams = json_decode($params);
    $res = save('accounts', $decodedParams);

    http_response_code(200);

    $response = array(
        'message' => $res,
        'data' => $decodedParams);
    return json_encode($response);
}

function updateAccount($params) {

    $decodedParams = json_decode($params);
    $res = update('accounts', $decodedParams);

    http_response_code(200);

    $response = array(
        'message' => $res,
        'data' => $decodedParams);
    return json_encode($response);
}

function removeAccount($id) {
    
    if (!$id) {
        http_response_code(200);
        $response = array(
            'message' => 'Please inform ID');
        return json_encode($response);
    }
    else {
        $res = remove('accounts', $id);

        http_response_code(200);
        $response = array(
            'message' => $res);
        return json_encode($response);
    }
}