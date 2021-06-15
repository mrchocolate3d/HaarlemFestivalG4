<?php


class DanceAdmin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllArtists(){
        $this->db->query("SELECT artist_id, name, genre FROM artist");
        $result = $this->db->resultSet();
        return $result;
    }

    public function getArtistsById($id){
        $this->db->query("SELECT artist_id, name, description, genre, facebook_link, twitter_link, instagram_link, youtube_link FROM artist WHERE artist_id = :id");
        $this->db->bind(':id',$id);
        $result = $this->db->singleRow();
        return $result;
    }

    public function updateArtist($id,$name,$description,$genre,$facebook,$twitter,$instagram,$youtube){
        $this->db->query('UPDATE artist SET name = :name, description = :description, genre = :genre, facebook_link = :facebook, twitter_link = :twitter,
                                    instagram_link = :instagram, youtube_link = :youtube WHERE artist_id = :id');

        $this->db->bind(':id',$id);
        $this->db->bind(':name',$name);
        $this->db->bind(':description',$description);
        $this->db->bind(':genre',$genre);
        $this->db->bind(':facebook',$facebook);
        $this->db->bind(':twitter',$twitter);
        $this->db->bind(':instagram',$instagram);
        $this->db->bind(':youtube',$youtube);
        $this->db->execute();


    }


}