<?php


class Users extends Controller
{
    public function __construct()
    {

        $this->userModel = $this->model('User');
    }

    //Customer login with validation
    public function login()
    {
        $data = [
            'title'=> 'Login Page',
            'email'=> '',
            'password' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email'=> trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter Email';
            }
            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter your password';
            }


            if (empty($data['emailError'])  && empty($data['passwordError'])) {
                $LogInUserCheck = $this->userModel->loginCheck($data['email'],$data['password']);

                if($LogInUserCheck){
                    $this->createUserSession($LogInUserCheck);
                } else {
                    $data['passwordError'] = 'Password or email is incorrect. PLease try again';
                    $this->view('users/login', $data);
                }
            }
        }
        $this->view('users/login', $data);
    }

    //Creating a user session
    public function createUserSession($user){
        $_SESSION['userID'] = $user->userID;
        $_SESSION['firstname'] = $user->firstname;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/pages/index');
    }
    // Signing out of the session and unsetting it
    public function logout(){
        unset($_SESSION['userID']);
        unset($_SESSION['firstname']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }
    //get orders from logged in user
    public function orders(){
        $userID = $_SESSION['userID'];
        $result = $this->userModel->getAllOrdersByUserID($userID);
        foreach ($result as $item){
            $data[]=array('orderID'=>$item->orderID,'userID'=>$item->userID,
                'totalPrice'=>$item->totalPrice,'status'=>$item->status);
        }
        $this->view('users/orders',$data);
    }
    //get order items of selected order
    public function orderItems(){
        $id = $_REQUEST['orderID'];
        $result=$this->userModel->searchOrderTicketsByID($id);
        foreach ($result as $item){
            $data[]=array('orderID'=>$item->orderID,'ticketID'=>$item->ticketID,
                'quantity'=>$item->quantity);
        }
        $this->view('users/orderItems',$data);
    }

    public function account(){
        $data = [
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'error' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST'  && $_POST['action']=="update"){
            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'email'=> trim($_POST['email']),
                'password' =>trim($_POST['password']),
                'confirmPassword' =>trim($_POST['confirmPassword']),
                'error' => ''
            ];
            $id = $_SESSION['userID'];
            if(empty($data['firstname']) || empty($data['lastname']) || empty($data['email'])){
                $data['error'] = 'Enter the required fields';
                $this->view('users/account' , $data);
            } else  if (!empty($data['firstname']) && !empty($data['lastname']) && !empty($data['email'])
                && !empty($data['password']) && !empty($data['confirmPassword'])){
                if($data['password'] != $data['confirmPassword']){
                    $data['error'] = 'Passwords do not match. Please try again';
                    $this->view('users/account' , $data);
                } else{
                    try {
                        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                        $check = $this->userModel->findUserByEmail($data['email']);
                        if (!$check){
                            $this->userModel->updateUser($data['firstname'],$data['lastname'],$data['email'],$data['password'],$id);
                            $data['error'] = 'User information has been updated';
                        }
                        else {
                            $data['error'] = 'User information has been updated';
                        }

                        $this->view('users/account' , $data);
                    } catch(Exception $exception){
                        echo $exception;
                    }
                }

            } else {
                try {
                    $check = $this->userModel->findUserByEmail($data['email']);
                    if (!$check){
                        $this->userModel->updateUserWithoutPassword($data['firstname'],$data['lastname'],$data['email'],$id);
                        $data['error'] = 'User information has been updated';
                    }
                    else {
                        $data['error'] = 'User information has been updated';
                    }
                    $this->view('users/account' , $data);
                } catch(Exception $exception){
                    echo $exception;
                }
            }
        }

        if(isset($_GET['email'])) {
            $id = $_GET['email'];
            $result = $this->userModel->GetUserByEmail($id);
            if ($result){
                $data = [
                    'firstname' => $result->firstname,
                    'lastname' => $result->lastname,
                    'email' => $result->email,
                    'error' => '',
                ];
                $this->view('users/account', $data);
            }
        }

        $this->view('users/account', $data);

    }

    public function register()
    {
        $data = [
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];


            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";



            //Check if a username is valid or empty
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter a email address';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter a valid email';
            } else {
                //Check if the email exists in the database
                if ($this->userModel->finduserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken';
                }


                //Validate the length of the password and also if it is empty
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Please enter your password';
                } elseif (strlen($data['password']) < 6) {
                    $data['passwordError'] = 'Password must be at least 6 characters.';
                } /*elseif (!preg_match($passwordValidation, $data['password'])) {
                    $data['passwordError'] = 'Password must have at lest 1 numerical value';
                }*/

                //Confirm password
                if (empty($data['confirmPassword'])){
                    $data['confirmPasswordError'] = 'Please enter your password ';
                } else {
                    if($data['password'] != $data['confirmPassword']){
                        $data['confirmPasswordError'] = 'Passwords do not match. Please try again';
                    }
                }

                if (empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    if ($this->userModel->newCustomer($data)){
                        header('location: ' . URLROOT . '/users/login');
                    } else {
                        die('Something went wrong please try again later');
                    }
                }
            }
        }
        $this->view('users/register', $data);
    }

    public function viewAllUsers(){
        $this->checkAdmin();
        $result = $this->userModel->getUsers();
        foreach ($result as $row){
            $data[] = array('id'=>$row->userID,'firstname'=>$row->firstname,'lastname'=>$row->lastname,'email'=>$row->email);
        }
        $this->view('users/viewAllUsers',$data);
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

    public function deleteUser(){

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->userModel->deleteUser($id);
            $data =  [
                'status' => 'User has been deleted'
            ];
        }
        $this->view('admins/homepage' ,$data);

    }
}