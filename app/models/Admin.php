<?php


class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllAdmins(){
        $this->db->query('SELECT * FROM admin');

        $result = $this->db->resultSet();

        return $result;
    }

    /*DANCE QUERIES*/
    public function getAllDance(){
        $this->db->query('SELECT event_id, event_name, start_time, end_time ,
       event_date from event where category = :dance');

        $this->db->bind(':dance','Dance');

        $result = $this->db->resultSet();

        return $result;
    }

    public function editDance($name,$startTime,$endTime,$date){

        $this->db->query('INSERT INTO event(event_name, start_time, end_time, event_date)
                        VALUES (:name,:startTime,:endTime,:date) ');
        $this->db->bind(':name',$name);
        $this->db->bind(':startTime',$startTime);
        $this->db->bind(':date',$date);
        $this->db->bind(':endTime',$endTime);

        $this->db->execute();
    }

    public function updateLocation($location,$description,$capacity){
        $this->db->query('INSERT INTO location(location_name, description, capacity) VALUES ()');
    }

    public function getDanceFromId($id){
        $this->db->query('SELECT event_id, event_name, start_time, end_time,
       event_date, location_name, description, capacity  from event
        inner join location l on event.location_id = l.location_id
        WHERE event_id = :id');

        $this->db->bind(':id',$id);

        $result = $this->db->singleRow();

        return $result;

    }


    public function adminCheck($email,$password){
        $this->db->query('SELECT * FROM admin WHERE email = :email');

        $this->db->bind(':email',$email);

        $row = $this->db->singleRow();

        $hashPassword = $row->password;

        if (password_verify($password,$hashPassword)){
            return $row;
        } else {
            return false;
        }
    }

    public function newAdmin($data){
        $this->db->query('INSERT INTO admin (email, password, roleID) VALUES (:email,:password,:roleID)');

        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':roleID',$data['roleID']);

        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }



    public function deleteAdmin($email){
        $this->db->query('DELETE FROM admin WHERE email = :email');
    }



}