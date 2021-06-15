<?php


class Payment
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
    //this method creates the order using everything given in the parameters
    public function createOrder($payStatus,$userId,$total){

        $this->db->query('INSERT INTO orders (userID,totalPrice,status) VALUE (:id,:total,:status)');
        $this->db->bind(':id',$userId);
        $this->db->bind(':total',$total);
        $this->db->bind(':status',$payStatus);
        $this->db->execute();

    }
    //this gets the latest orderID from orders
    public function getOrderId(){
        $this->db->query('SELECT MAX(orderID) as orderID FROM orders ');
        return $this->db->singleRow();
    }
    //this adds an orderItem using the parameters
    public function addOrderItem($id,$ticketID,$quantity){

        $this->db->query('INSERT INTO order_ticket(orderID,ticketID,quantity) VALUE (:id,:ticketid,:quantity)');
        $this->db->bind(':id',$id);
        $this->db->bind(':ticketid',$ticketID);
        $this->db->bind(':quantity',$quantity);
        $this->db->execute();
    }
    //search for the dance tickets by event_id
    public function searchDanceTicket($eventID,$price){
        $this->db->query('SELECT ticketID from tickets where ticketPrice =:price and event_id=:id');
        $this->db->bind(':id',$eventID);
        $this->db->bind(':price',$price);
        return $this->db->singleRow();
    }
    //search for the history tickets by history_event_id
    public function searchHistoryTicket($eventID,$price){
        $this->db->query('SELECT ticketID from tickets  where ticketPrice =:price and history_event_id=:id');
        $this->db->bind(':id',$eventID);
        $this->db->bind(':price',$price);
        return $this->db->singleRow();
    }

}