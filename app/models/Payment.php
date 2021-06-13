<?php


class Payment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function createOrder($payStatus,$userId,$total,$cart){

        $this->db->query('INSERT INTO orders (userID,totalPrice,status) VALUE (:id,:total,:status); ');
        $this->db->bind(':id',$userId);
        $this->db->bind(':total',$total);
        $this->db->bind(':status',$payStatus);
        $this->db->execute();

    }
    public function getOrderId(){
        $this->db->query('SELECT MAX(orderID) as orderID FROM orders;');
        return $this->db->singleRow();
    }
    public function addOrderItem($id,$ticketID,$quantity){

        $this->db->query('INSERT INTO order_ticket(orderID,ticketID,quantity) VALUE (:id,:ticketid,:quantity)');
        $this->db->bind(':id',$id);
        $this->db->bind(':ticketid',$ticketID);
        $this->db->bind(':quantity',$quantity);
        $this->db->execute();
    }
    public function searchDanceTicket($eventID,$price){
        $this->db->query('SELECT ticketID from tickets where ticketPrice =:price and event_id=:id');
        $this->db->bind(':id',$eventID);
        $this->db->bind(':price',$price);
        return $this->db->singleRow();
    }
    public function searchHistoryTicket($eventID,$price){
        $this->db->query('SELECT ticketID from tickets  where ticketPrice =:price and history_event_id=:id');
        $this->db->bind(':id',$eventID);
        $this->db->bind(':price',$price);
        return $this->db->singleRow();
    }

}