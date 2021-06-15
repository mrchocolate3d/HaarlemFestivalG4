<?php


class Admins extends Controller
{
    public function __construct()
    {
        $this->checkAdmin();
        $this->adminModel = $this->model('Admin');
    }

    //Edit dance page
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
        //Update dance information
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

        //Insert new dance information
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
            if(empty($data['event_name']) || empty($data['startTime']) ||
                empty($data['event_date']) ||empty($data['location']) ||empty($data['locationDescription']) ||empty($data['capacity'])){
                $data['emptyFieldsErrors'] = 'Fill out all fields';
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

            //Get the specific dance using the id in the url and display it on the page
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

    // Get all the dance events and pu them in a list
    public function danceAdmin(){
        $result = $this->adminModel->getAllDance();
        foreach ($result as $row){
            $data[] = array('event_id'=>$row->event_id,'event_name'=>$row->event_name,'event_date'=>$row->event_date,
                'start_time'=>$row->start_time);
        }
        $this->view('admins/danceAdmin',$data);
    }

    //Check the credentails that are being used to log in and if they are correnct then create a new session for the user
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

            //Validations
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

    //Delete a dance event based on the id that is being sent
    public function deleteDance(){
        $data = [
            'status' => ''
        ];
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            if (isset($_POST['confirm'])) {
                if ($_POST['confirm'] == 'Yes') {
                    $this->adminModel->deleteDance($id);
                    $data['status'] = 'Event has been deleted';
                    $this->view('admins/homepage', $data);
                } else if ($_POST['confirm'] == 'No') {
                    $data['status'] = 'Event could not be deleted please contact the administrator';
                    $this->view('admins/homepage', $data);
                }
            }
        }
        $this->view('admins/deleteDance' , $data);

    }

    //Update the current admin account information
    public function adminAccount(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $password = password_hash(trim($_POST['password']),PASSWORD_DEFAULT);
            $this->adminModel->updateAdmin($_SESSION['adminID'],trim($_POST['email']),$password);
            unset($_SESSION['adminEmail']);
            $_SESSION['adminEmail'] = trim($_POST['email']);
            $this->view('admins/adminAccount');
        }

        $this->view('admins/adminAccount');

    }

    //Get the list of all admins
    public function allAdminList(){
        $result = $this->adminModel->getAllAdmin();
        foreach ($result as $row){
            $data[] = array('AdminID'=>$row->adminID,'Email'=>$row->email,'role'=>$row->type,
                );
        }
        $this->view('admins/allAdminList',$data);

    }

    //Edit the admin according the id provided
    public function editAdmin(){
       $data = [
            'title' => 'Add Admin',
            'id'=> '',
            'email' =>'',
            'password' =>''

        ];

       //Update the admin information
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

        //Create a new admin
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

        //Show the admin information on a page according to the id that was used
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


    public function homepage(){
        $data =  [
            'status' => ''
        ];
        $this->view('admins/homepage', $data);
    }

    //Creating admin sessions
    public function createAdminSession($user){
        $_SESSION['adminID'] = $user->adminID;
        $_SESSION['AdminType'] = $user->type;
        $_SESSION['adminEmail'] = $user->email;
        $data =  [
            'status' => 'Welcome to admin page ' . $_SESSION['adminEmail']
        ];
        $this->view('admins/homepage' , $data);
    }

    //Logging out of the admin sessions
    public function adminLogout(){
        unset($_SESSION['adminID']);
        unset($_SESSION['AdminType']);
        unset($_SESSION['adminEmail']);
        header('location:' . URLROOT . '/admins/loginAdmin');
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
    //Check if an admin is logged in and if not then send them to the login page
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