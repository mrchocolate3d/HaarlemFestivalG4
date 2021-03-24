<?php

require_once "EventModel.php";
require_once "TicketModel.php";

class CartModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        if (!isset($_SESSION['cart'])) 
        {
            $_SESSION['cart'] = [];
        }
    }

    public function getTicketsFromCart()
    {
        $tickets = [];
        foreach ($_SESSION['cart'] as $key => $value) 
        {
            array_push($tickets, unserialize($_SESSION['cart'][$key]));
        }
        return $tickets;
    }

    public function addToCart(int $ticket_id)
    {
        $t = new TicketModel;
        $ticket = $t->getTicketById($ticket_id);

        array_push($_SESSION['cart'], serialize($ticket));
    }

    public function displayTickets()
    {
        $tickets = [];
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $ticket) {
                array_push($tickets, unserialize($ticket));
            }
        }
        return $tickets;
    }

    public function removeFromCart(int $id)
    {
        // Remove
    }

    private function formatTicket(Ticket $t)
    {

    }
}
