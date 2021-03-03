<?php


class Histories extends Controller
{
    public function __construct()
    {
        $this->historyModel = $this->model('History');
    }

    public function detail(){
        $this->view('histories/detail');
    }

}