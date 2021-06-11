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
        $total_price = number_format($_GET['price'],2);
       // $user_email = $_SESSION['email'];
      //  $user = $this->userModel->GetUserByEmail($user_email);
      //  $data[] =  $_SESSION["shopping_cart"];
        // $totalPrice = $_REQUEST['$total'];

            $mollie = new MollieApiClient();
            $mollie->setApiKey('test_ajQEAHf8StBWg3dnW9VxWvcz26j5jh');
            //$_SESSION["shopping_cart"];
           // $amount = $_REQUEST["total"];
            $description = 'Payment for Haarlem Festival order' ;

            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "$total_price",
                ],
                "description" => "$description",
                "redirectUrl" => "http://localhost/PHP/HaarlemFestivalG4/carts/index.php",
                "webhookUrl" => "",
                "metadata" => "",
            ]);

            var_dump($total_price);
            header('location: '.$payment->getCheckoutUrl(), true, 303);

    }
}