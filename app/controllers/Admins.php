<?php


class Admins extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
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
}