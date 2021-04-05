<?php

$mollie->setApiKey('test_ajQEAHf8StBWg3dnW9VxWvcz26j5jh');
$amount = $_POST['amount'];

$payment = $mollie->payments->create([
    "amount"=>[
        "currency"=>"EUR",
        "value"=>$amount
    ],
]);
