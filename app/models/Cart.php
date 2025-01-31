<?php


class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        //query
        //bind var
        //set result or execute
        //return
    }
    //this method is used to get each order_ticket where orderID = argument
    public function searchOrderTicketsByID($id){
        $this->db->query('SELECT * FROM order_ticket WHERE orderID = :id');
        $this->db->bind(':id',$id);
        $result = $this->db->resultSet();
        return $result;
    }
    //this method is used to get each order where orderID = argument
    public function searchOrderByID($id){
        $this->db->query('SELECT * FROM orders WHERE orderID=:id');
        $this->db->bind(':id',$id);
        $order = $this->db->singleRow();
        return $order;
    }

}