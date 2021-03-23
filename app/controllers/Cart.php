<?php

class Cart extends Controller
{
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
    }

    public function display()
    {
        $data['tickets'] = $this->cartModel->getTicketTest();
        $this->view("cart/display", $data);
    }

    public function checkout()
    {
        $this->view("cart/checkout");
    }

    public function add(int $ticket_id, int $quantity)
    {
        $t = $this->cartModel->getTicketTest();
        // $t = $this->cartModel->getTicketById($ticket_id);
        // $this->cartModel->addToCart($t, $quantity);
        header('location: ' . URLROOT . '/cart/display');
    }
}
