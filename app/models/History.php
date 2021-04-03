<?php


class History
{
    private $db;
    public $data;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getHistoryEvents(){


        $this->db->query('SELECT history_event_id,lang,tour_guide,location_id,starting_time,tour_date, quantity from history_event');
        $result =$this->db->resultSet();
        return $result;


    }

    public function getHistoryEventByLanguage($lang){

        $this->db->query('SELECT history_event_id, lang, tour_guide, location_id, starting_time, tour_date, quantity from history_event where lang = :lang');
        $this->db->bind(':lang',$lang);
        $result=$this->db->resultSet();
        return $result;
    }

    public function getTicketById($id){

        $this->db->query('SELECT history_event_id, lang, tour_guide, location_id, starting_time, tour_date, quantity from history_event where history_event_id = :id');
        $this->db->bind(':id',$id);
        $result=$this->db->singleRow();
        return $result;
    }

    public function addHistoryTicket($data,$quantity){
        $this->db->query('');
    }
    public function removeFromQuantity($data,$quantity){

    }

}