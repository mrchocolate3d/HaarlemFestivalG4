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
        $user = $this->userMode->GetUserByEmail($user_email);
        $data[] =  $_SESSION["shopping_cart"];

        $this->view('payments/payment',$data);
        $mollie = new MollieApiClient();
        $this->view('payments/payment');

        if(isset($_POST['pay'])){

            $mollie->setApiKey('test_ajQEAHf8StBWg3dnW9VxWvcz26j5jh');
            $_SESSION["shopping_cart"];
            $amount = $_REQUEST['total'];
            $description = 'Continue with payment for' ;

            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $amount,
                ],
                "description" => "$description",
                "redirectUrl" => "http://localhost/PHP/HaarlemFestivalG4/payments/info.php",
                "webhookUrl" => "",
                "metadata" => $user,
            ]);
            $payment->getCheckoutUrl();
            $this->paymentModel->placeOrder();

        }
    }
    public function info(){
        $this->view('payments/info');
    }
}