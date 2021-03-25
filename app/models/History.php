<?php


class History
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetHistoryEvents(){

        return $this->db->query("SELECT * FROM history_events");
    }

    public function GetHistoryEventByLanguage($language){
        return$this->db->query("SELECT*FROM history_events WHERE languagge :language");
    }

}