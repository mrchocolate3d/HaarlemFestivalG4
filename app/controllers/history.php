<?php


class history extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function detail(){
        $this->view('history/detail');
    }

}