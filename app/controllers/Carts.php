<?php


class Carts extends Controller
{
    public function __construct()
    {
        $this->cartModel = $this->model('Cart');

    }

    public function cart(){
        $status="";
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

        if (isset($_POST['action']) && $_POST['action']=="change"){
            foreach($_SESSION["shopping_cart"] as &$value){
                if($value['event_id'] === $_POST["event_id"]){
                    $value['quantity'] = $_POST["quantity"];
                    break; // Stop the loop after we've found the product
                }
            }
        }

        $data[] =  $_SESSION["shopping_cart"];
        $this->view('carts/cart',$data);
    }
}