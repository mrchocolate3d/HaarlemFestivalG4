<?php


class Payment
{
    private $db;
    public $data;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function placeOrder($data){
        $this->db->query('INSERT INTO orders (userID,totalPrice,orderStatus)VALUES (:userID,:total,:status)');

        $this->db->bind(':userID',$data['userID']);
        $this->db->bind(':total',$data['total']);
        $this->db->bind(':status',$data['status']);

        $this->db->execute();
    }
}