<?php

$myModels = ['Account', 'Transaction'];
$myRoutes = [
    'Account' => [
        'getAccount' => 'GET', 
        'addAccount' => 'POST',
        'updateAccount' => 'PUT',
        'removeAccount' => 'DELETE'
    ],
    'Transaction' => [
        'getTransaction' => 'GET',
        'addTransaction' => 'POST',
        'updateTransaction' => 'PUT',
        'removeTransaction' => 'DELETE'
    ]
];

?>

