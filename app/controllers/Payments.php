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
        $cart = $_SESSION['shopping_cart'];
        $userId = $_SESSION['userID'];

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
                "redirectUrl" => "http://localhost/PHP/HaarlemFestivalG4/carts/cart",
                "webhookUrl" => "",
                "metadata" => "",
            ]);



           $id= $this->paymentModel->getOrderId();
           $data = $id->orderID;

        $this->paymentModel->createOrder($payment->status,$userId,$total_price,$cart);


        header('location: '.$payment->getCheckoutUrl(), true, 303);


        foreach ($cart as $item){
            $quantity = $item["quantity"];
            $eventID = $item["event_id"];
            $price = $item["price"];

            if($item["type"]=="Dance"){
                $result = $this->paymentModel->searchDanceTicket($eventID,$price);

            }
            else{
                $result = $this->paymentModel->searchHistoryTicket($eventID,$price);
            }
            $tickID = $result->ticketID;
            $this->paymentModel->addOrderItem($data,$tickID,$quantity);
        }

    }

}