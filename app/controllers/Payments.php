<?php

use Mollie\Api\MollieApiClient;

class Payments extends Controller
{
    public function __construct()
    {
        $this->paymentModel = $this->model('Payment');
        $this->userModel =$this->model('User');

    }
    public function payment()
    {
        $user_email = $_SESSION['email'];
        $user = $this->userModel->GetUserByEmail($user_email);
        $data[] =  $_SESSION["shopping_cart"];


        if(isset($_POST['pay'])){

            $mollie = new MollieApiClient();
            $mollie->setApiKey('test_ajQEAHf8StBWg3dnW9VxWvcz26j5jh');
            $_SESSION["shopping_cart"];
            $amount = $_REQUEST["total"];
            $description = 'Continue with payment for' ;

            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $amount,
                ],
                "description" => "$description",
                "redirectUrl" => "http://localhost/PHP/HaarlemFestivalG4/carts/confirmationPage",
                "webhookUrl" => "",
                "metadata" => "",
            ]);

            header("Location: " . $payment->getCheckoutUrl(), \true, 303);

        }
    }
}