<?php


class Admins extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');

    }

    public function editDance(){

        $data = [
            'title' => 'Add Dance',
            'id'=> '',
            'event_name'=> '',
            'startTime' =>'',
            'eventDate' =>'',
            'location' => '',
            'locationDescription' => '',
            'capacity' => '',
            'emptyFieldsErrors' => ''

        ];

        $id=$_REQUEST['id'];

        $result = $this->adminModel->getDanceFromId($id);

        if ($result){
            $data = [
                'title' => 'Add Dance',
                'id'=> $result->event_id,
                'event_name'=> $result->event_name,
                'startTime' =>$result->start_time,
                'eventDate' =>$result->event_date,
                'location' => $result->location_name,
                'locationDescription' => $result->description,
                'capacity' => $result->capacity,
                'endTime'=>$result->end_time,
                'emptyFieldsErrors' => ''

            ];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'title' => 'Add Dance',
                'id'=> $_REQUEST['id'],
                'event_name'=> trim($_POST['event_name']),
                'startTime' =>trim($_POST['schedule_time']),
                'eventDate' =>trim($_POST['event_date']),
                'location' => trim($_POST['location']),
                'locationDescription' => trim($_POST['description']),
                'capacity' => trim($_POST['capacity']),
                'emptyFieldsErrors' => ''
            ];

            if(empty($data['id']) || empty($data['event_name']) || empty($data['startTime']) ||
                empty($data['eventDate']) ||empty($data['location']) ||empty($data['locationDescription']) ||empty($data['capacity'])){
                $data['emptyFieldsErrors'] = 'Fill out all fields';
                $this->view('admins/danceAdmin',$data);
            } else {
                $this->adminModel->editDance($data['event_name'],$data['event_name'],$data['event_name'],$data['event_date']);
            }

        }


            $this->view('admins/editDance',$data);

    }

    public function danceAdmin(){
        $result = $this->adminModel->getAllDance();
        foreach ($result as $row){
            $data[] = array('event_id'=>$row->event_id,'event_name'=>$row->event_name,'event_date'=>$row->event_date,
                'start_time'=>$row->start_time ,);
        }
        $this->view('admins/danceAdmin',$data);
    }

    public function loginAdmin(){
        $data = [
            'title'=> 'Admin page',
            'email'=> '',
            'password'=>'',
            'emailError' => '',
            'passwordError' => ''
        ];



        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
              'email' =>  trim($_POST['email']),
              'password' =>trim($_POST['password']),
              'emailError' => '',
              'passwordError' => ''
            ];

            if (empty($data['email'])){
                $data['emailError'] = 'Please enter email';
            }

            if(empty($data['password'])){
                $data['passwordError'] = 'Please enter your password';
            }

            if(empty($data['emailError']) && empty($data['passwordError'])) {
                $LogInUserCheck = $this->adminModel->adminCheck($data['email'],$data['password']);

                if($LogInUserCheck){
                    $this->createAdminSession($LogInUserCheck);
                } else {
                    $data['passwordError'] = 'Password or email for admin is incorrect please try again';
                    $this->view('admins/loginAdmin',$data);
                }
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
            }
        }
        $this->view('admins/loginAdmin' , $data);
    }

    public function homepage(){
        $this->view('admins/homepage');
    }

    public function createAdminSession($user){
        $_SESSION['userID'] = $user->id;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/admins/homepage');
    }


    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}