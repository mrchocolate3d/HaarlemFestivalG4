<?php

class JazzModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTimetable()
    {
        $this->db->query("SELECT * FROM jazz_event
        JOIN event on jazz_event.event_id = event.event_id
        JOIN location on event.location_id = location.location_id
        JOIN artist on jazz_event.artist_id = artist.artist_id");
        $this->db->execute();
        return $this->db->resultSet();
    }
}
