<?php


class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}