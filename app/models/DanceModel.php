<?php 
class DanceModel {

    private $db;

    public function __construct() {

        $this->db = new Database;
        $this->dates =  array("Tuesday-27th July", "Wednesday-28th July", "Thursday-29th July");
        $this->venues = array("Lichtfabriek", "Jopenkerk", "XO the Club", "Club Ruis", "Caprera Openluchttheater", "Club Stalker");
        $this->cart = array();
    }
    // add to order is the addToCart and list name is cart.
    public function getTimeTable() {

        $this->db->query("SELECT * FROM event WHERE category='Dance'");
        // inner join on using location_id
        $event_results = $this->db->resultSet();
       if ($this->db->rowCount() > 0) {

           $schedule = array();

           foreach($this->dates as $dt) {
               $schedule[$dt] = array();

               foreach($this->venues as $ven) {
                   $schedule[$dt][$ven] = array();
                   $schedule[$dt][$ven]["id"] = "";
                   $schedule[$dt][$ven]["text"] = "NO EVENTS";
                }
           }

              foreach($event_results as $row) {

               $location_id = $row->location_id;
               $this->db->query("SELECT * FROM location WHERE location_id=$location_id");
               
               $location_row = $this->db->singleRow();
               $location_name = $location_row->location_name;
               
               $event_date = date_format(new DateTime($row->event_date), "l-d\\t\h F");
               $schedule[$event_date][$location_name]["id"] = $row->event_id;

               $schedule[$event_date][$location_name]["text"] = $row->event_name."<br><pre>".date_format(new DateTime($row->start_time), "H:i")." to ".date_format(new DateTime($row->end_time), "H:i")."</pre>";
              }
       } else { 
           echo "0 results";
       }

      return $schedule;
   }

   function getArtist($event_id) {
            $this->db->query("select EV.event_name AS event_name, EV.event_date, EV.start_time, LOC.location_name AS location, TKT.ticketPrice AS price,
            ART.description, ART.facebook_link, ART.instagram_link, ART.twitter_link, ART.youtube_link, ART.image
            FROM event AS EV join location as LOC on LOC.location_id = EV.location_id JOIN tickets AS TKT ON TKT.event_id = EV.event_id
            JOIN dance_event AS DEV ON EV.event_id = DEV.event_id JOIN artist AS ART ON DEV.artist_id = ART.artist_id 
            WHERE EV.event_id = $event_id;");
        $row = $this->db->singleRow();

        $event_details = array();

        if($row) {
        	$event_details["name"] = $row->event_name;
        	$event_details["time_place"] = $row->event_date . " - ".  $row->start_time . " at " . $row->location;
        	$event_details["price"] = $row->price;
                    
        	$event_details["description"] = $row->description;
        	$event_details["facebook"] = $row->facebook_link;
        	$event_details["instagram"] = $row->instagram_link;
        	$event_details["twitter"] = $row->twitter_link;
        	$event_details["youtube"] = $row->youtube_link;
        	$event_details["image"] = $row->image;

        	return $event_details;
        } else {
        	return "Event not found!!";
        }
    
    }

    public function addToCart($eventid, $totalprice, $count, $name, $location) {
        try {
            $key = "".microtime(true)."_"."userid";
            $this->cart[$key] = array(); // get users id and for storing into the cart
            $this->cart[$key]["event_id"] = $eventid;
            $this->cart[$key]["totalprice"] = $totalprice;
            $this->cart[$key]["count"] = $count;
            $this->cart[$key]["name"] = $name;
            $this->cart[$key]["location"] = $location;
            return true;
        }
        catch(Exception $e) {
            return false;
        }

    }
}

?>
