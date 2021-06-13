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
        $this->db->query("SELECT * FROM history_event");
        $result = $this->db->resultSet();
        return $result;
    }

    public function deleteHistory($id){
        $this->db->query("DELETE FROM history_event WHERE location_id =:id");
        $this->db->bind(':id',$id);
        $this->db->execute();
    }
}