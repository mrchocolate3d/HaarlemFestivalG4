<?php

class Cart extends Controller
{
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
    }

    public function display()
    {
        $data['tickets'] = $this->cartModel->getTickets();
        $this->view("cart/display", $data);
    }

    public function checkout()
    {
        $this->view("cart/checkout");
    }

    public function add(int $ticket_id, int $quantity)
    {
        $t = $this->cartModel->GetTicketById($ticket_id);
        header('location: ' . URLROOT . '/cart/display');
    }
}
