<?php

use Mollie\Api\MollieApiClient;

class Payments extends Controller
{
    public function __construct()
    {
        $this->paymentModel = $this->model('Payment');

    }

    public function index(){
        $data = [
            'name' => 'name'
        ];

        $this->view('payments/index',$data);
    }


    public function payment()
    {
        // get total price and set decimal to 2
        $total_price = number_format($_GET['price'],2);
        //get cart from session
        $cart = $_SESSION['shopping_cart'];


        //check if user is logged with userID else user send to log in
        if(isset($_SESSION['userID'])){

            //get userID from session
            $userId = $_SESSION['userID'];
            //API mollie payment setup
            $mollie = new MollieApiClient();
            $mollie->setApiKey('test_ajQEAHf8StBWg3dnW9VxWvcz26j5jh');
            $description = 'Payment for Haarlem Festival order' ;

            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "$total_price",
                ],
                "description" => "$description",
                "redirectUrl" => "http://localhost/PHP/HaarlemFestivalG4/carts/confirmationPage",
                "webhookUrl" => "",
                "metadata" => "",
            ]);




            //set status $payment->status only returns open and api wont continue unless paid is selected
            $statusPay = "paid";
            //sends information to payment model
            $this->paymentModel->createOrder($statusPay,$userId,$total_price);

            //get the orderID from model
            $id= $this->paymentModel->getOrderId();
            //makes ID readable
            $data = $id->orderID;
            //make a session for orderID so it can be fetched from another page
            $_SESSION['orderID']= $data;

            //continue with payment
            header('location: '.$payment->getCheckoutUrl(), true, 303);


            //sends every item in order to orderItems in the db
            foreach ($cart as $item){
                $quantity = $item["quantity"];
                $eventID = $item["event_id"];
                $price = $item["price"];

                //because the database was not created according to the schema we had made 2 different tables had to be created thus the different methods
                //each ticket has a type and the statement underneath checks whether the type is either Dance or otherwise (History)
                if($item["type"]=="Dance"){
                    //get the ticket based on dance
                    $result = $this->paymentModel->searchDanceTicket($eventID,$price);

                }
                else{
                    //get ticket based on history
                    $result = $this->paymentModel->searchHistoryTicket($eventID,$price);
                }
                //sets tickID
                $tickID = $result->ticketID;
                //sends the ticket to orderItem
                $this->paymentModel->addOrderItem($data,$tickID,$quantity);
            }
            //clears shopping cart session after payment
            $data='';
            unset($_SESSION['shopping_cart']);

            $this->view('payments/index',$data);


        }
        else{
            //when the user is directed to the login page when not logged in
            $data = [
                'email'=> '',
                'password' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
            $this->view('/users/login',$data);
        }



    }

}