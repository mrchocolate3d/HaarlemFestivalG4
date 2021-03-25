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
        return "";
    }
}
