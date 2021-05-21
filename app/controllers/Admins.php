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
            'startTime' =>'00:00:00',
            'event_date' =>'',
            'location' => '',
            'locationDescription' => '',
            'capacity' => '',
            'endTime'=>'00:00:00',
            'locationID' =>'',
            'emptyFieldsErrors' => ''

        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action']=="updateDance"){
            $data = [
                'title' => 'Add Dance',
                'id'=> trim($_POST['id']),
                'event_name'=> trim($_POST['event_name']),
                'startTime' =>trim($_POST['startTime']),
                'event_date' =>trim($_POST['event_date']),
                'endTime'=>trim($_POST['endTime']),
                'location' => trim($_POST['location']),
                'locationDescription' => trim($_POST['description']),
                'capacity' => trim($_POST['capacity']),
                'locationID' =>trim($_POST['locationID']),
                'emptyFieldsErrors' => ''
            ];

            if(empty($data['id']) || empty($data['event_name']) || empty($data['startTime']) ||
                empty($data['event_date']) ||empty($data['location']) ||empty($data['locationDescription']) ||empty($data['capacity'])){
                $this->view('admins/homepage');
            } else {
                try {
                    $this->adminModel->updateDance($data['id'],$data['event_name'],$data['startTime'],$data['endTime'],$data['event_date']);
                    $this->adminModel->updateLocation($data['location'],$data['locationDescription'],$data['locationID']);
                    $data =  [
                        'status' => 'Event information has been updated'
                    ];
                    $this->view('admins/homepage' , $data);
                } catch(Exception $exception){
                    echo $exception;
                }
            }
        }

        else if ($_SERVER['REQUEST_METHOD'] == 'POST'  && $_POST['action']=="insertDance"){
            $data = [
                'title' => 'Add Dance',
                'event_name'=> trim($_POST['event_name']),
                'startTime' =>trim($_POST['startTime']),
                'event_date' =>trim($_POST['event_date']),
                'endTime'=>trim($_POST['endTime']),
                'location' => trim($_POST['location']),
                'locationDescription' => trim($_POST['description']),
                'capacity' => trim($_POST['capacity']),
                'emptyFieldsErrors' => ''
            ];
            if(empty($data['id']) || empty($data['event_name']) || empty($data['startTime']) ||
                empty($data['event_date']) ||empty($data['location']) ||empty($data['locationDescription']) ||empty($data['capacity'])){
                $data['emptyFieldsErrors'] = 'Fill out all fields';
                $this->view('admins/danceAdmin',$data);
            } else {
                try {
                    $result = $this->adminModel->getLocationId($data['location']);
                    if($result){
                        $this->adminModel->newDance($data['event_name'],$data['startTime'],$data['endTime'],$data['event_date'],$result->location_id);
                    }
                    else {
                        $this->adminModel->newLocation($data['location'],$data['locationDescription']);
                        $location = $this->adminModel->getLocationId($data['location']);
                        $this->adminModel->newDance($data['event_name'],$data['startTime'],$data['endTime'],$data['event_date'],$location->location_id);
                    }
                    $data =  [
                        'status' => 'New event has been added'
                    ];
                    $this->view('admins/homepage' , $data);

                } catch(Exception $exception){
                    echo $exception;
                }
            }
        }


            if(isset($_GET['id'])) {
            $id=$_GET['id'];
            //$id=$_REQUEST['id'];

            $result = $this->adminModel->getDanceFromId($id);

            if ($result){
                $data = [
                    'title' => 'Add Dance',
                    'id'=> $result->event_id,
                    'event_name'=> $result->event_name,
                    'startTime' =>$result->start_time,
                    'event_date' =>$result->event_date,
                    'location' => $result->location_name,
                    'locationDescription' => $result->description,
                    'capacity' => $result->capacity,
                    'endTime'=>$result->end_time,
                    'locationID' =>$result->location_id,
                    'emptyFieldsErrors' => ''
                ];
                $this->view('admins/editDance',$data);
            }
        }
        $this->view('admins/editDance',$data);

    }



    public function createDance(){
        $result = $this->adminModel->getAllDance();

        $data = [
            'title'=> 'Admin page',
            'email'=> '',
            'password'=>'',
            'emailError' => '',
            'passwordError' => ''
        ];


        $this->view('admins/createDance',$data);
    }


    public function danceAdmin(){
        $result = $this->adminModel->getAllDance();
        foreach ($result as $row){
            $data[] = array('event_id'=>$row->event_id,'event_name'=>$row->event_name,'event_date'=>$row->event_date,
                'start_time'=>$row->start_time);
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


    public function deleteDance(){
        $data =  [
            'status' => ''
            ];

        if (isset($_POST['confirm'])) {
            if ($_POST['confirm'] == 'Yes') {
                $data['status'] = 'Event has been deleted';
                $this->view('admins/homepage' , $data);
            }
            else if ($_POST['confirm'] == 'No') {
                $data['status'] = 'Event could not be deleted please contact the administrator';
                $this->view('admins/homepage' , $data);
            }
        }

    }

    public function adminAccount(){
        $this->view('admins/adminAccount');

    }

    public function allAdminList(){
        $result = $this->adminModel->getAllAdmin();
        foreach ($result as $row){
            $data[] = array('AdminID'=>$row->adminID,'Email'=>$row->email,'role'=>$row->type,
                );
        }
        $this->view('admins/allAdminList',$data);

    }

    public function editAdmin(){
       $data = [
            'title' => 'Add Admin',
            'id'=> '',
            'email' =>'',
            'password' =>''

        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST'  && $_POST['action']=="update"){
            $data = [
                'title' => 'Add Dance',
                'id'=> trim($_POST['id']),
                'email'=> trim($_POST['email']),
                'password' =>trim($_POST['password']),
            ];

            if(empty($data['id']) || empty($data['email']) || empty($data['password'])){
                $data =  [
                    'status' => 'Please fill out all fields for the admin account'
                ];
                $this->view('admins/homepage' , $data);
            } else {
                try {
                    $this->adminModel->updateAdmin($data['id'],$data['email'],$data['password']);
                    $data =  [
                        'status' => 'Admin information has been updated'
                    ];
                    $this->view('admins/homepage' , $data);
                } catch(Exception $exception){
                    echo $exception;
                }
            }
        }


        else if ($_SERVER['REQUEST_METHOD'] == 'POST'  && $_POST['action']=="insert"){
            $data = [
                'title' => 'Add Dance',
                'email'=> trim($_POST['email']),
                'password' =>trim($_POST['password']),
            ];
            if( empty($data['email']) || empty($data['password'])){
                $data =  [
                    'status' => 'Please fill out all fields for the admin account'
                ];
                $this->view('admins/homepage' , $data);
            } else {
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                $this->adminModel->newAdminUsingSuper($data['email'],$data['password']);
            }
        }

        if(isset($_GET['id'])) {
            $id=$_GET['id'];
            //$id=$_REQUEST['id'];
            $result = '';
            $result = $this->adminModel->getAdminFromId($id);

            if ($result){
                $data = [
                    'id'=> $result->adminID,
                    'email'=> $result->email,
                    'password' =>$result->password,
                ];
            } else {
                $data =  [
                    'status' => 'Could not find a user with that Id'
                ];
                $this->view('admins/homepage' , $data);
            }
        }
        $this->view('admins/editAdmin',$data);

        //$this->view('admins/homepage');

    }


    public function deleteAdmin(){

    }


    public function homepage(){
        $data =  [
            'status' => ''
        ];
        $this->view('admins/homepage', $data);
    }

    public function createAdminSession($user){
        $_SESSION['userID'] = $user->adminID;
        $_SESSION['AdminType'] = $user->type;
        $_SESSION['email'] = $user->email;
        $data =  [
            'status' => 'Welcome to admin page ' . $_SESSION['email']
        ];
        $this->view('admins/homepage' , $data);
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}