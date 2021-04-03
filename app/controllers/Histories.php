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

        foreach ($result as $item){
            $data[]=array('history_event_id'=>$item->history_event_id,'language'=>$item->language,
                'tour_guide'=>$item->tour_guide, 'location_id'=>$item->location_id,
                'starting_time'=>$item->starting_time,'tour_date'=>$item->tour_date);
        }
        
        $this->view('history/tickets',$data);
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
        $id = $_REQUEST['event_id'];
        $result = $this->historyModel->getTicketById($id);

        $data=[
            'history_event_id'=>$result->history_event_id,
            'lang'=>$result->lang,
            'tour_guide'=>$result->tour_guide,
            'location_id'=>$result->location_id,
            'starting_time'=>$result->starting_time,
            'tour_date'=>$result->tour_date,
            'quantity'=>$result->quantity
        ];

        $this->view('histories/add',$data);

        $tickets = array();

        if(isset($_POST['add-history-ticket'])){

            $quantity = $_POST['ticket-quantity'];
            while ($quantity!=0){
                array_push($tickets,$id);
            }

            $ticketstest[] = array('history_event_id'=>$tickets);
            /*$this->historyModel->addHistoryTicket($data,$quantity);*/
            //$this->historyModel->removeFromQuantity($data,$quantity);

        }


        if(isset($_POST['add-test'])){
            $this->view('histories/add',$ticketstest);
        }
    }

    public function confirmation(){
        $id = $_REQUEST['ticket'];
        $this->view('histories/confirmation');
    }

}