<?php


class HistoryAdmins extends Controller
{
    public function __construct()
    {
        $this->checkAdmin();
        $this->historyAdminModel = $this->model('HistoryAdmin');
        $this->history = $this->model('History');

    }
    public function viewHistories(){
        $result = $this->history->getHistoryEvents();
        foreach ($result as $row){
            $data[] = array('event_id'=>$row->history_event_id,'lang'=>$row->lang,'tour_guide'=>$row->tour_guide,'startTime'=>$row->starting_time,
                'event_date'=>$row->tour_date,'capacity'=>$row->quantity);
        }
        $this->view('historyAdmins/viewHistories',$data);
    }

    public function editHistory(){
        $data = [
            'title' => 'Add Dance',
            'id'=> '',
            'tour_guide'=> '',
            'startTime' =>'00:00:00',
            'event_date' =>'',
            'capacity' => '',
            'lang' => '',
            'emptyFieldsErrors' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'&& $_POST['action']=="updateHistory"){
            $data = [
                'title' => 'Add Dance',
                'id'=> trim($_POST['id']),
                'tour_guide'=> trim($_POST['tour_guide']),
                'startTime' =>trim($_POST['startTime']),
                'event_date' =>trim($_POST['event_date']),
                'capacity' => trim($_POST['capacity']),
                'lang' => trim($_POST['lang']),
                'emptyFieldsErrors' => ''
            ];

            if(empty($data['id']) || empty($data['tour_guide']) || empty($data['startTime']) || empty($data['event_date']) || empty($data['capacity'])
                || empty($data['lang'])) {
                $data['emptyFieldsErrors'] = 'Fill out all fields';
            } else {
                try{
                    $this->historyAdminModel->updateHistory($data['id'],$data['tour_guide'],$data['startTime'],$data['event_date'],$data['lang']);
                    $data =  [
                        'status' => 'Event information has been updated'
                    ];
                    $this->view('admins/homepage' , $data);
                }catch (Exception $e){
                    echo $e;
                }
            }

        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'&& $_POST['action']=="insertHistory"){
            $data = [
                'title' => 'Add Dance',
                'tour_guide'=> trim($_POST['tour_guide']),
                'startTime' =>trim($_POST['startTime']),
                'event_date' =>trim($_POST['event_date']),
                'capacity' => trim($_POST['capacity']),
                'lang' => trim($_POST['lang']),
                'emptyFieldsErrors' => ''
            ];

            if( empty($data['tour_guide']) || empty($data['startTime']) || empty($data['event_date']) || empty($data['capacity'])
                || empty($data['lang'])) {
                $data['emptyFieldsErrors'] = 'Fill out all fields';
            } else {
                try {
                    $this->historyAdminModel->newHistory($data['tour_guide'],$data['startTime'],$data['event_date'],$data['lang']);
                    $data =  [
                        'status' => 'New History Event has been added'
                    ];
                    $this->view('admins/homepage' , $data);

                } catch (Exception $e){
                    echo $e;
                }
            }
        }

            if(isset($_GET['id'])) {
            $id=$_GET['id'];

            $result = $this->historyAdminModel->getHistoryFromId($id);

            if ($result){
                $data = [
                    'title' => 'Add Dance',
                    'id'=> $result->history_event_id,
                    'tour_guide'=> $result->tour_guide,
                    'startTime' =>$result->starting_time,
                    'event_date' =>$result->tour_date,
                    'capacity' => $result->quantity,
                    'lang' =>$result->lang,
                    'emptyFieldsErrors' => ''
                ];
                $this->view('historyAdmins/editHistory',$data);
            }
        }
        $this->view('historyAdmins/editHistory',$data);


    }


    public function deleteHistory(){
        $data = [
            'status' => ''
        ];
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            if (isset($_POST['confirm'])) {
                if ($_POST['confirm'] == 'Yes') {
                    $this->historyAdminModel->deleteHistory($id);
                    $data['status'] = 'History Event has been deleted';
                    $this->view('admins/homepage', $data);
                } else if ($_POST['confirm'] == 'No') {
                    $data['status'] = 'History Event could not be deleted please contact the administrator';
                    $this->view('admins/homepage', $data);
                }
            }
        }
        $this->view('historyAdmins/deleteHistory' , $data);
    }



    public function checkAdmin(){
        $data = [
            'emailError' => '',
            'passwordError' => ''
        ];
        if(!isset($_SESSION['adminID'])){
            $this->view('admins/loginAdmin',$data);
        }
    }




}