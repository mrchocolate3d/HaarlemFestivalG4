<?php

use Mollie\Api\MollieApiClient;
require "../initialize.php";

class Payments extends Controller
{
    public function __construct()
    {
        $this->paymentModel = $this->model('Payment');
        $this->userModel =$this->model('User');

    }
    public function payment()
    {
        $mollie = new MollieApiClient();
        $this->view('payments/payment');
        if(isset($_POST['pay'])){

            $mollie->setApiKey('test_ajQEAHf8StBWg3dnW9VxWvcz26j5jh');
            $amount = $_POST['amount'];

            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "10.00",
                ],
                "description" => "Order #{$orderId}",
                "redirectUrl" => "{$protocol}://{$hostname}{$path}/return.php?order_id={$orderId}",
                "webhookUrl" => "{$protocol}://{$hostname}{$path}/webhook.php",
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);
            $this->paymentModel->placeOrder();
        }
    }
    public function info(){
        $this->view('payments/info');
    }
}