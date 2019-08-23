<?php

namespace App\Models\Account;

header('Content-Type: application/json; charset: utf-8');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/config/cfg.php');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function getAccount($id) {

    if (!$id) {
        $response = array(
            'status' => '200 OK',
            'statusMessage' => 'Please inform ID',
            'data' => '');
        return json_encode($response);
    }
    else {
        
        $data = find('accounts', $id);
        var_dump(function_exists('find'));

        $response = array(
            'status' => '200 OK',
            'statusMessage' => 'Search complete',
            'data' => $data);
        return json_encode($response);
    }
}

function addAccount($params) {
    
    $response = array(
        'status' => '200 OK',
        'statusMessage' => 'Account created',
        'data' => json_decode($params));
    return json_encode($response);
}

function updateAccount($params) {
    
}

function removeAccount($id) {
    
}