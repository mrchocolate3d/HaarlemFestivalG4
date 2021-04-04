<?php


class Histories extends Controller
{
    /*adding ticket is at the add method; list is called tickets*/
    public function __construct()
    {
        $this->historyModel = $this->model('History');
    }

    public function detail(){
        $this->view('histories/detail');
    }

    public function tickets(){
        $result = $this->historyModel->getHistoryEvents();


        if(isset($_POST['filter-language'])){
            if (!empty($_POST['ticket_dropdown'])){
                $lang = $_POST['ticket_dropdown'];
                $result = $this->historyModel->getHistoryEventByLanguage($lang);

            }
        }
        foreach ($result as $item){
            $data[]=array('history_event_id'=>$item->history_event_id,'lang'=>$item->lang,
                'tour_guide'=>$item->tour_guide, 'location_id'=>$item->location_id,
                'starting_time'=>$item->starting_time,'tour_date'=>$item->tour_date,'quantity'=>$item->quantity);
        }

        $this->view('histories/tickets',$data);
    }
    public function add(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $code = trim($_POST['history_event_id']);
            $idItem = uniqid();
            $data = array(
            $code=>array(
              'tour_date' => trim($_POST['tour_date']),
              'idItem'=> $idItem,
              'starting_time' => trim($_POST['starting_time']),
              'lang' => trim($_POST['lang']),
              'tour_guide' => trim($_POST['tour_guide']),
              'quantity'=>1,
              'price' =>trim($_POST['price']),
              'event_id' => trim($_POST['history_event_id']))
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
            $data += [ 'id' =>trim($_POST['history_event_id']) ];
            $data += [ 'status' =>$status ];

        } else {
            $id = $_REQUEST['event_id'];
            $result = $this->historyModel->getTicketById($id);
            $code = $result->history_event_id;
            $status = '';
            $data = array(
              $code =>array(
                'event_id'=>$result->history_event_id,
                'lang'=>$result->lang,
                'tour_guide'=>$result->tour_guide,
                'location_id'=>$result->location_id,
                'starting_time'=>$result->starting_time,
                'tour_date'=>$result->tour_date,
                'quantity'=>1,
                'price' => $result->ticketPrice,
                'status'=>''),
                'id' =>$result->history_event_id
            );
        }

        $this->view('histories/add',$data);

    }

    public function confirmation(){
        $id = $_REQUEST['ticket'];
        $this->view('histories/confirmation');
    }

}