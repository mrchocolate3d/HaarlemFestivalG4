<?php

use Mollie\Api\MollieApiClient;

class Payments extends Controller
{
    public function __construct()
    {
        $this->paymentModel = $this->model('Payment');
     //   $this->userModel =$this->model('User');

    }

    public function index(){
        $data = [
            'name' => 'name'
        ];

        $this->view('payments/index',$data);
    }


    public function payment()
    {
       // $user_email = $_SESSION['email'];
      //  $user = $this->userModel->GetUserByEmail($user_email);
      //  $data[] =  $_SESSION["shopping_cart"];


            $mollie = new MollieApiClient();
            $mollie->setApiKey('test_ajQEAHf8StBWg3dnW9VxWvcz26j5jh');
            //$_SESSION["shopping_cart"];
           // $amount = $_REQUEST["total"];
            $description = 'Continue with payment for' ;

            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "10.00",
                ],
                "description" => "$description",
                "redirectUrl" => "http://localhost/PHP/HaarlemFestivalG4/carts/index.php",
                "webhookUrl" => "",
                "metadata" => "",
            ]);

            header('location: '.$payment->getCheckoutUrl(), true, 303);

    }
}