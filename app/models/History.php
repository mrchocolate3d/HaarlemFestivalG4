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


        $this->db->query('SELECT history_event_id,lang,tour_guide,location_id,starting_time,tour_date from history_event');
        $result =$this->db->resultSet();
        return $result;


    }


    public function GetHistoryEventByLanguage($lang){
        $this->db->bind(':$lang','lang');
        return$this->db->query('SELECT history_event_id, lang, tour_guide, location_id, starting_time, tour_date from history_event where lang = :lang');
    }

}