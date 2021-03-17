<?php

require_once APPROOT.'\classes\Artist.php';
require_once APPROOT.'\classes\JazzEvent.php';
require_once APPROOT.'\classes\Location.php';
require_once APPROOT.'\classes\Ticket.php';
require_once APPROOT.'\classes\Ticket.php';


class CartModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTickets()
    {
        // $query = "SELECT * FROM ticket WHERE ticket_id IN (";

        // $max = count($_SESSION['cart']);
        // for ($i = 0; $i < $max; $i++) // Add placeholders to add to in clause
        // {
        //     $query = $query . ":id$i" . ($i < $max - 1 ? ", " : ")");
        // }

        // $count = 0;
        // $this->db->query($query);

        // foreach ($_SESSION['cart'] as $key) // fill placeholders with keys
        // {
        //     //echo ":id$count - $key[0]";
        //     $this->db->bind(":id$count", $key[0]);
        //     $count++;
        // }

        // $this->db->execute();
        // return $this->db->resultSetToObj("Ticket");

        $tickets = [];
        if (isset($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $ticket) {
                array_push($ticket, unserialize($ticket));
            }
        }
        return $tickets;
    }

    public function getTicketTest()
    {
        $artist = new Artist(1, "Gare Du Nord", "Very cool jazz mans", "Classic Jazz");
        $location = new Location(1, "Patronaat", "Main Hall", 500);
        $event = new JazzEvent(101, $artist, $location, new DateTime('now'), new DateTime('now'));
        $this->addToCart(new Ticket(0, $event, 15));
    }

    public function addToCart(Ticket $ticket)
    {
        $_SESSION['cart'] = serialize($ticket);
    }
}
