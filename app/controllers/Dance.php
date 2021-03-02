<?php 

    class Dance extends Controller {

        public function __construct() {

            $this->danceModel = $this->model('DanceModel');
        }

        public function home() {

            $timetable = $this->danceModel->getTimetable();

            $data = [
                'title' => 'Dance Home',
                'name' => $timetable
            ];
            $this->view('dance/home', $data, "");
        }
    }
?>