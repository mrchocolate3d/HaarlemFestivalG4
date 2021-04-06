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

    public function newDance($name,$startTime,$endTime,$date,$locationID){

        $this->db->query('INSERT INTO event(event_name,category, start_time, end_time, event_date,location_id)
                        VALUES (:name,:startTime,:endTime,:date,:locationID)');

        $this->db->bind(':name',$name);
        $this->db->bind(':startTime',$startTime);
        $this->db->bind(':date',$date);
        $this->db->bind(':endTime',$endTime);
        $this->db->bind(':category','Dance');
        $this->db->bind(':locationID',$locationID);

        $this->db->execute();

    }

    public function updateDance($id,$name,$startTime,$endTime,$date){

        $this->db->query('UPDATE event SET event_name = :name, start_time = :startTime, end_time = :endTime, event_date = :date WHERE event_id = :id ');

        $this->db->bind(':name',$name);
        $this->db->bind(':startTime',$startTime);
        $this->db->bind(':date',$date);
        $this->db->bind(':endTime',$endTime);
        $this->db->bind(':id',$id);

        $this->db->execute();

    }


    public function newLocation($location,$description){
        $this->db->query('INSERT INTO location(location_name, description)
                        VALUES (:location,:description)');

        $this->db->bind(':location',$location);
        $this->db->bind(':description',$description);

        $this->db->execute();
    }

    public function getLocationId($locationName){
        $this->db->query('SELECT location_id FROM location WHERE location_name = :locationName');
        $this->db->bind(':locationName',$locationName);

        $result = $this->db->singleRow();

        return $result;
    }

    public function updateLocation($location,$description,$locationID){
        $this->db->query('UPDATE location SET location_name = :location, description = :description WHERE location_id = :locationID');

        $this->db->bind(':location',$location);
        $this->db->bind(':locationID',$locationID);
        $this->db->bind(':description',$description);

        $this->db->execute();
    }

    public function getDanceFromId($id){
        $this->db->query('SELECT event_id, event_name, start_time, end_time,
        event_date, location_name, description, capacity, l.location_id  from event
        inner join location l on event.location_id = l.location_id
        WHERE event_id = :id');

        $this->db->bind(':id',$id);

        $result = $this->db->singleRow();

        return $result;

    }

    /*ADMINS*/

    public function passwordGet($password){
        $this->db->query('SELECT * FROM admin WHERE email = :email');

        $this->db->bind(':email','text@outlook.com');

        $result = $this->db->singleRow();

        return $result;

    }


    public function adminCheck($email,$password){
        $this->db->query('SELECT adminID, email, password, type FROM admin inner join roles on admin.roleID = roles.roleID WHERE email = :email');

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

    public function getAllAdmin(){
        $this->db->query('SELECT adminID, email, password , type FROM admin inner join roles r on admin.roleID = r.roleID');

        $result = $this->db->resultSet();

        return $result;
    }

    public function updateAdmin($id,$email,$password){
        $this->db->query('UPDATE admin SET email = :email, password = :password WHERE adminID = :id ');

        $this->db->bind(':id',$id);
        $this->db->bind(':email',$email);
        $this->db->bind(':password',$password);

        $this->db->execute();
    }


    public function newAdminUsingSuper($id,$email,$password,$roleID){
        $this->db->query('INSERT INTO admin (email, password, roleID) VALUES (:email,:password,:roleID,:roleID)');

        $this->db->bind(':id',$id);
        $this->db->bind(':email',$email);
        $this->db->bind(':email',$roleID);
        $this->db->bind(':password',$password);

        $this->db->execute();
    }

    public function deleteAdmin($email){
        $this->db->query('DELETE FROM admin WHERE email = :email');
        $this->db->bind(':email',$email);
        $this->db->execute();


    }



}