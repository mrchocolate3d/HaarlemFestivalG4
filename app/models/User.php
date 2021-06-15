<?php


class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUsers(){
        $this->db->query("SELECT * FROM users");

        $result = $this->db->resultSet();

        return $result;

    }

    public function  loginCheck($email,$password){
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Bind
        $this->db->bind(':email',$email);

        $row = $this->db->singleRow();

        $hashPassword = $row->password;

        if (password_verify($password,$hashPassword)){
            return $row;
        } else {
            return false;
        }
    }



    public function newCustomer($data){
        $this->db->query('INSERT INTO users (firstname, lastname, email, password,roleID) VALUES (:firstname,:lastname,:email,:password,3)');

        $this->db->bind(':firstname',$data['firstname']);
        $this->db->bind(':lastname',$data['lastname']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);


        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    //Find user using email and return true
    //
    // if there is a match
    public function findUserByEmail($email){
        //Prepared Statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Bind param with variable
        $this->db->bind(':email',$email);

        if($this->db->rowCount() > 0 ){
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($firstname,$lastname,$email,$password,$userID){
        $this->db->query('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE userID = :userID');
        $this->db->bind(':firstname',$firstname);
        $this->db->bind(':lastname',$lastname);
        $this->db->bind(':email',$email);
        $this->db->bind(':password',$password);
        $this->db->bind(':userID',$userID);

        $this->db->execute();

    }

    public function updateUserWithoutPassword($firstname,$lastname,$email,$userID){
        $this->db->query('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE userID = :userID');
        $this->db->bind(':firstname',$firstname);
        $this->db->bind(':lastname',$lastname);
        $this->db->bind(':email',$email);
        $this->db->bind(':userID',$userID);
        $this->db->execute();

    }



    public function GetUserByEmail($email){
        $this->db->query('SELECT firstname, lastname, email FROM users WHERE email = :email');
        $this->db->bind(':email',$email);
        return $this->db->singleRow();
    }
}