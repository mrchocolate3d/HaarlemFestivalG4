<?php


class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
    {
        $data = [
            'title' => 'Login Page',
            'usernameError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => ''
            ];

            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username';
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter your password';
            }


<<<<<<< HEAD
            if (empty($data['usernameError'])  && empty($data['passwordError'])) {

                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                if ($this->userModel->newUser($data)){
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong please try again later');
                }
            }





=======
>>>>>>> parent of 4112a2a (DetailPage connection fixed)
        }

        $this->view('users/login', $data);
    }

    public function register()
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];


            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";


            //Check if a username is valid or empty
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username';
            } else if (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Please enter valid syntax';
            }

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
                } elseif (!preg_match($passwordValidation, $data['password'])) {
                    $data['passwordError'] = 'Password must have at lest 1 numerical value';
                }

                //Confirm password
                if (empty($data['confirmPassword'])){
                    $data['confirmPasswordError'] = 'Please enter your password ';
                } else {
                    if($data['password'] != $data['confirmPassword']){
                        $data['confirmPasswordError'] = 'Passwords do not match. Please try again';
                    }
                }

                if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    if ($this->userModel->newUser($data)){
                        header('location: ' . URLROOT . '/users/login');
                    } else {
                        die('Something went wrong please try again later');
                    }
                }
            }
        }
        $this->view('users/register', $data);
    }
}