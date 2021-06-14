<?php


class HistoryAdmin
{
    private $db;
    public $data;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function getAllHistory(){
        $this->db->query("SELECT history_event_id,lang,tour_date,starting_time,quantity,tour_guide FROM history_event");
        $result = $this->db->resultSet();
        return $result;
    }

    public function deleteHistory($id){
        $this->db->query("DELETE FROM history_event WHERE history_event_id =:id");
        $this->db->bind(':id',$id);
        $this->db->execute();
    }

    public function getHistoryFromId($id){
        $this->db->query("SELECT * FROM history_event WHERE history_event_id =  :id");
        $this->db->bind(':id',$id);
        $result = $this->db->singleRow();
        return $result;
    }

    public function updateHistory($id,$tourGuide,$startTime,$eventDate,$lang){
        $this->db->query('UPDATE history_event SET tour_guide = :tourGuide, starting_time = :startTime, tour_date = :eventDate, lang = :lang WHERE history_event_id = :id');

        $this->db->bind(':id',$id);
        $this->db->bind(':tourGuide',$tourGuide);
        $this->db->bind(':startTime',$startTime);
        $this->db->bind(':eventDate',$eventDate);
        $this->db->bind(':lang',$lang);
        $this->db->execute();
    }

    public function newHistory($tourGuide,$startTime,$eventDate,$lang){
        $this->db->query('INSERT INTO history_event (lang, tour_guide, location_id, starting_time, tour_date, quantity) VALUES (:lang,:tourGuide,1,:startTime,:eventDate,12)');
        $this->db->bind(':tourGuide',$tourGuide);
        $this->db->bind(':startTime',$startTime);
        $this->db->bind(':eventDate',$eventDate);
        $this->db->bind(':lang',$lang);
        $this->db->execute();
    }
}