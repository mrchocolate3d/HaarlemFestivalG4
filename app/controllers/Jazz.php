<?php


class Jazz extends Controller
{
    public function __construct()
    {
        $this->jazzModel = $this->model('JazzModel');
    }

    public function home()
    {
        $timetable = $this->jazzModel->getTimetable();
        $data = [
            'title' => 'Jazz Home',
            'name' => $timetable
        ];
        $this->view('jazz/home', $data, "");
    }
}
