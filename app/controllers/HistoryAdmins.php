<?php


class HistoryAdmins extends Controller
{
    public function __construct()
    {
        $this->historyAdminModel = $this->model('HistoryAdmin');
    }
    public function viewHistories(){
        $result = $this->historyAdminModel->getAllHistory();
        $data = [];
        foreach ($result as $row){
            $data = array('event_id'=>$row->history_event_id,'lang'=>$row->lang,'tour_guide'=>$row->tour_guide,'startTime'=>$row->starting_time,
                'event_date'=>$row->tour_date,'quantity'=>$row->quantity);
        }
        $this->view('historyAdmins/viewHistories',$data);
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
        $this->view('admins/deleteHistory' , $data);
    }








}