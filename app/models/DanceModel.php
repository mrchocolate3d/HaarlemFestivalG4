<?php 
    class DanceModel {

        private $db;
        
        public function __construct() {

            $this->db = new Database();
        }

        public function getTimeTable() {
                        
                global $dates, $venues;

                $dates =  array("Friday-27th July", "Saturday-28th July", "Sunday-29th July");
                $venues = array("Lichtfabriek", "Jopenkerk", "XO the Club", "Club Ruis", "Caprera Openluchttheater", "Club Stalker");
                
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "haarlemfestival";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                
                $event_results = $conn->query("SELECT * FROM event WHERE cateagory='Dance'");

                if ($event_results->num_rows > 0) {
                    
                    $schedule = array();
                    
                    foreach($GLOBALS['dates'] as $dt) {
                        $schedule[$dt] = array();
                        foreach($GLOBALS['venues'] as $ven) {
                            $schedule[$dt][$ven] = array();
                            $schedule[$dt][$ven]["id"] = "";
                            $schedule[$dt][$ven]["text"] = "NO EVENTS";
                        }
                    }
                    while($row = $event_results->fetch_assoc()) {
                        $schedule[$row["date"]][$row["location_id"]]["id"] = $row["event_id"];
                        $schedule[$row["date"]][$row["location_id"]]["text"] = $row["name"]."<br><pre>".$row["start_time"]." to ".$row["end_time"]."</pre>";
                    }
                echo "</table>";
                } else {
                echo "0 results";
                }
                $conn->close();
            return $schedule;
        }

        public function getArtist($event_id) {

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "haarlemfestival";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $event_results = $conn->query("SELECT * FROM dance_event WHERE event_id=$event_id");

                $artist_id = "";

                while($row=$event_results->fetch_assoc()) {
                    $artist_id = $row["artist_id"];
                }

                if($artist_id != "") {
                    $event_results = $conn->query("SELECT * FROM artist WHERE artist_id=$artist_id");
                    
                    if($event_results->num_rows > 0) {
                        $row = $event_results->fetch_assoc();
                        return "id=". $row["artist_id"]. "<br> name=" . $row["name"] . 
                        "<br> description=" . $row["description"] . 
                        "<br> genre=" . $row["genre"] . "<br>  image=". 
                        $row["image"] . "<br> facebook=" . $row["facebook"] . 
                        "<br> twitter=" . $row["twitter"] . "<br> instagram=" . $row["instagram"] 
                        ."<br> youtube=" . $row["youtube"];
                    }
                }

        }
    }
?>