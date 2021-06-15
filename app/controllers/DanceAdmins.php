<?php


class DanceAdmins extends Controller
{
    public function __construct()
    {
        $this->checkAdmin();
        $this->danceAdmin = $this->model('DanceAdmin');
    }

    public function viewArtist(){
        $result = $this->danceAdmin->getAllArtists();
        foreach ($result as $row){
            $data[] = array('id'=>$row->artist_id,'name'=>$row->name,'genre'=>$row->genre);
        }
        $this->view('danceAdmins/viewArtist',$data);
    }

    public function editArtist(){
        $data = [
            'id'=> '',
            'name'=> '',
            'description' =>'',
            'facebook' =>'',
            'twitter' => '',
            'instagram' => '',
            'youtube' => '',
            'genre' => '',
            'emptyFieldsErrors' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'&& $_POST['action']=="updateArtist"){
            $data = [
                'id'=> trim($_POST['id']),
                'name'=> trim($_POST['name']),
                'description' =>trim($_POST['description']),
                'facebook' =>trim($_POST['facebook']),
                'twitter' => trim($_POST['twitter']),
                'instagram' => trim($_POST['instagram']),
                'youtube' => trim($_POST['youtube']),
                'genre' => trim($_POST['genre']),
                'emptyFieldsErrors' => ''
            ];

            if(empty($data['id']) || empty($data['name']) || empty($data['description']) || empty($data['facebook']) || empty($data['twitter'])
                || empty($data['instagram']) || empty($data['youtube']) || empty($data['genre'])) {
                $data['emptyFieldsErrors'] = 'Fill out all fields';
            } else {
                try{
                    $this->danceAdmin->updateArtist($data['id'],$data['name'],$data['description'],$data['genre'],$data['facebook'],$data['twitter'],$data['instagram'],$data['youtube']);
                    $data =  [
                        'status' => 'Artist information has been updated'
                    ];
                    $this->view('admins/homepage' , $data);
                }catch (Exception $e){
                    echo $e;
                }
            }

        }


        if(isset($_GET['id'])) {
            $id=$_GET['id'];
            $row = $this->danceAdmin->getArtistsById($id);
            if ($row) {
                $data = ['id' => $row->artist_id, 'name' => $row->name, 'description' => $row->description, 'facebook' => $row->facebook_link, 'twitter' => $row->twitter_link,
                    'instagram' => $row->instagram_link, 'youtube' => $row->youtube_link, 'genre' => $row->genre, 'emptyFieldsErrors' => ''];
            }
        }
        $this->view('danceAdmins/editArtist',$data);
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
}