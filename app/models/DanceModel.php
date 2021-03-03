<?php 
    class DanceModel {

        private $db;
        
        public function __construct() {

            $this->db = new Database();
        }

        public function getTimeTable() {
                         //$schedule = array("Friday-27th July"=>
                //array("LichtFabriek"=> array("artists"=>
                //array("Nicky Romero ID", "Afrojack ID"), "start"=>"20.00", 
                //"end"=>"02.00"), "Jopen Kerk"=>...), "Saturday-28th July"=>array
                //("LichtFabriek"=>..), "Sunday, 29th July"=>array("LichtFabriek"=>...);

                global $dates, $venues;

                $dates =  array("Friday-27th July", "Saturday-28th July", "Sunday-29th July");
                $venues = array("LichtFabriek", "Jopen Kerk", "XO the Club", "Club Ruis", "Caprera openluchtheather", "Club Stalker");
                
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
                            // if(array_key_exists($ven, $schedule[$dt])){
                            // }
                            $schedule[$dt][$ven] = "NO EVENTS";
                        }
                    }
                    while($row = $event_results->fetch_assoc()) {
                        $schedule[$row["date"]][$row["location_id"]] = $row["name"]."<br><pre>".$row["start_time"]." to ".$row["end_time"]."</pre>";
                    }
                echo "</table>";
                } else {
                echo "0 results";
                }
                $conn->close();
            return $schedule;
        }
    }
?>