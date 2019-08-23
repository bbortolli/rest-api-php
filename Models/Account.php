<?php

namespace App\Models\Account;

header('Content-Type: application/json; charset: utf-8');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/config/cfg.php');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function getAccount($params) {

    $id = $params[0];

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

function removeAccount($params) {

    $id = $params[0];
    
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

function getDateTransactions($params) {

    $id = $params[0];
    $start = $params[1];
    $end = $params[2];
    $found = null;

    $database = open_database();
    $sql = "SELECT * FROM accounts as acc, transactions as t 
        WHERE acc._id = t.acc_id 
        AND acc.id = " . $id .
        " AND t.date >= STR_TO_DATE(" . $start . ", '%Y-%m-%d')" .
        " AND t.date <= " . $end; 

    try {
        $result = $database->query($sql);
	    if ($result->num_rows > 0) {
          $found = $result->fetch_all(MYSQLI_ASSOC);
        }
    }
    catch (Exception $e) {
        return $e->GetMessage();
    }

    close_database($database);
	return $found;
}