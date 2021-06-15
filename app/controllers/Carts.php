<?php
use Mollie\Api\MollieApiClient;

class Carts extends Controller
{
    public function __construct()
    {
        $this->cartModel = $this->model('Cart');

    }

    //Cart page
    public function cart(){
        $status="";
        //Remove an item from the cart if the remove button is clicked
        if(isset($_POST['action']) && $_POST['action']=="remove"){
            if(!empty($_SESSION["shopping_cart"])) {
                foreach ($_SESSION["shopping_cart"] as $key => $value){
                    if($_POST["idItem"] == $value["idItem"]){
                        unset($_SESSION["shopping_cart"][$key]);
                        $status = "Product has been removed form your cart!";
                    }
                    if(empty($_SESSION["shopping_cart"]))
                        unset($_SESSION["shopping_cart"]);
                }
            }
        }

        //Change the quantity of an item in the cart by searching for the correct one
        if (isset($_POST['action']) && $_POST['action']=="change"){
            foreach($_SESSION["shopping_cart"] as &$value){
                if($value['event_id'] === $_POST["event_id"]){
                    $value['quantity'] = $_POST["quantity"];
                    break; // Stop the loop after we've found the product
                }
            }
        }


        if (isset($_POST['action']) && $_POST['action']=="confirm"){
            $data[] =  $_SESSION["shopping_cart"];
            $this->view('carts/confirmationPage',$data);
        }


        $data[] = '';
        $this->view('carts/cart',$data);
    }

    //Geting the orders for what was just paid and telling the user that it was paid
    public function confirmationPage(){

        //this can be accessed after the payment
        //gets the orderID which was set as a session
        $orderID = $_SESSION["orderID"];
        //get the order items linked to the orderID
        $result = $this->cartModel->searchOrderTicketsByID($orderID);
        //fill the array with the results from the method used above
        foreach ($result as $item){
            $data[]=array('orderID'=>$item->orderID,'ticketID'=>$item->ticketID,
                'quantity'=>$item->quantity);

        }

        $this->view('carts/confirmationPage',$data);
    }


}