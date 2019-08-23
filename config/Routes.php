<?php

// Insert all models here
$myModels = ['Account', 'Transaction'];

// Insert all routes here
$myRoutes = [
    'Account' => [
        'getAccount' => 'GET', 
        'addAccount' => 'POST',
        'updateAccount' => 'PUT',
        'removeAccount' => 'DELETE',
        'getDateTransactions' => 'GET'
    ],
    'Transaction' => [
        'getTransaction' => 'GET',
        'addTransaction' => 'POST',
        'updateTransaction' => 'PUT',
        'removeTransaction' => 'DELETE'
    ]
];

?>

