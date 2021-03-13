<?php

class CartModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTickets()
    {
        $query = "SELECT * FROM ticket WHERE ticket_id IN (";

        $max = count($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) {
            $query = $query . ":id$i" . ($i < $max - 1 ? ", " : ")");
        }

        $count = 0;
        $this->db->query($query);

        foreach ($_SESSION['cart'] as $key) {
            //echo ":id$count - $key[0]";
            $this->db->bind(":id$count", $key[0]);
            $count++;
        }
        
        $this->db->execute();
        return $this->db->resultSet();
    }
}
