
<html>
<?php
echo session_id();
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<body>
<section>
    <form action="<?php echo URLROOT; ?>/admins/editDance" method="post">
        <h2>Dance Festival</h2>
        <label>Event Name</label>
        <input type="text" name="event_name" value='<?php echo $data['event_name']?>'>
        <aside>
            <label>Start time</label>
            <?php
            $start = "00:00"; //you can write here 00:00:00 but not need to it
            $end = "23:30";

            $time = $data['startTime'];

            $tStart = strtotime($time);
            $tAllTime = strtotime($start);
            $tEnd = strtotime($end);
            //$tNow = $tStart;
            $tNow = $tStart;
            echo '<select name="schedule_time">';
            while($tNow <= $tEnd){
                echo '<option value="'.date("H:i",$tNow).'">'.date("H:i",$tNow).'</option>';
                $tNow = strtotime('+30 minutes',$tNow);
            }
            echo '</select>';


            ?>

            <label>End time</label>
            <?php

            $time = $data['endTime'];

            $tStart = strtotime($time);
            $tEnd = strtotime($end);
            //$tNow = $tStart;
            $tNow = $tStart;
            echo '<select name="schedule_time">';
            while($tNow <= $tEnd){
                echo '<option value="'.date("H:i",$tNow).'">'.date("H:i",$tNow).'</option>';
                $tNow = strtotime('+30 minutes',$tNow);
            }
            echo '</select>';


            ?>
        </aside>
        <aside>
            <label>Event Date</label>
            <input type="text" name="event_date" value='<?php echo $data['eventDate']?>'>
        </aside>

        <aside>
            <label>Location</label>
            <input type="text" name="location" value='<?php echo $data['location']?>'>
        </aside>


        <label>Description</label>
        <aside>
            <textarea class="FormElement" name="description" cols="140" rows="10"><?php echo $data['locationDescription']?></textarea>
        </aside>
        <aside>
            <label>Location Capacity</label>
            <input type="text" name="capacity" value='<?php echo $data['capacity']?>' readonly>
        </aside>
        <button id="submit" type="submit" value="submit">Submit</button>
        <span class="invalidFeedback">
                    <?php echo $data['emptyFieldsErrors']; ?>
        </span>
    </form>
</section>
</body>
</html>
