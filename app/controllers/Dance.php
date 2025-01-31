<?php 

    class Dance extends Controller {

        public function __construct() {

            // storing dates and venues and timetable through dance model
            $this->danceModel = $this->model('DanceModel');
            $this->venues = $this->danceModel->venues;
            $this->dates = $this->danceModel->dates;
            $this->timetable = $this->danceModel->getTimetable();
        }

        public function home() {

            $data = [
                'title' => 'Dance Home',
                'timetable' => $this->timetable,
                'dates' => $this->dates,
                'venues' => $this->venues
            ];
            $this->view('dance/home', $data);
        }

        public function event() {
            $data = [
                    'title' => 'Dance Home',
                    'timetable' => $this->timetable,
                    'dates' => $this->dates,
                    'venues' => $this->venues,
                    'event_id' => '',
                    'artist_data' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => 'Dance Home',
                    'timetable' => $this->timetable,
                    'dates' => $this->dates,
                    'venues' => $this->venues,
                    'event_id' => trim($_POST['event_id']),
                    'artist_data' => $this->danceModel->getArtist($_POST['event_id'])
                ];
                
                $this->view('dance/home', $data);
            }
        }

        public function add_to_cart() {
            $data = [
                'title' => 'Dance Home',
                'timetable' => $this->timetable,
                'dates' => $this->dates,
                'venues' => $this->venues,
                'addtocart' => false,
            ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

           

            $code = trim($_POST['event_id']);
            $idItem = uniqid();
            $data = array(
            $code=>array(
              'type' => 'Dance',
              'event_id' => trim($_POST['event_id']),
              'idItem'=> $idItem,
              'date' => trim($_POST['eventdate']),
              'starting_time' => trim($_POST['starttime']),
              'eventName' => trim($_POST["eventname"]),
              'lang' => 'English',
              'tour_guide' => 'N/A',
              'quantity'=> 1,
              'price' =>trim($_POST['total-price']),
              'location' => trim($_POST['location']))
            );

            if(empty($_SESSION["shopping_cart"])){
               $_SESSION["shopping_cart"] = $data;
                $status = 'Ticket has been added to the cart';
            } else{
                $array_keys = array_keys($_SESSION["shopping_cart"]);
                if(in_array($code,$array_keys)){
                    $status = 'Ticket is already added to the cart';
                } else {
                    $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$data);
                    $status = 'Ticket is added to your cart';
                }

            }
            $data += [ 'event_id' =>trim($_POST['event_id']) ];
            $data += [ 'status' =>$status ];
            $this->view('pages/index', $data);
        }
        }
    }
?>