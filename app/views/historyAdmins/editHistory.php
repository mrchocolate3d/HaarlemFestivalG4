
<html>
<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<body>
<section>
    <form action="<?php echo URLROOT; ?>/historyAdmins/editHistory" method="post">
        <h2>History Event</h2>
        <label>Event Name</label>
        <?php if(isset($_GET['id'])){?>
            <input type="hidden" name="id" value='<?php echo $_REQUEST['id']?>'>
        <?php } ?>
        <input type="text" name="event_date" value='<?php echo $data['event_date']?>'>
        <aside>
            <label>Start time</label>
            <?php
            $start = "00:00:00"; //you can write here 00:00:00 but not need to it
            $end = "23:30:00";

            $time = $data['startTime'];

            $tStart = strtotime($time);
            $tAllTime = strtotime($start);
            $tEnd = strtotime($end);
            //$tNow = $tStart;
            $tNow = $tStart;
            echo '<select name="startTime">';
            while($tNow <= $tEnd){
                echo '<option value="'.date("H:i",$tNow).'">'.date("H:i",$tNow).'</option>';
                $tNow = strtotime('+30 minutes',$tNow);
            }
            echo '</select>';
            ?>

        </aside>
        <aside>
            <label>Location</label>
            <input type="text" name="location" value='<?php echo $data['location']?>'>
            <input type="hidden" name="locationID" value='<?php echo $data['locationID']?>'>
        </aside>

        <label>Description</label>
        <aside>
            <textarea class="FormElement" name="description" cols="140" rows="10"><?php echo $data['locationDescription']?></textarea>
        </aside>
        <aside>
            <label>Location Capacity</label>
            <input type="text" name="capacity" value='<?php echo $data['capacity']?>' readonly>
        </aside>
        <button id="updateDance" name="action" type="submit" value="updateDance">Update Dance</button>
        <button id="insertDance" name="action" type="submit" value="insertDance">Create New Dance</button>
        <span class="invalidFeedback">
                    <?php echo $data['emptyFieldsErrors']; ?>
        </span>
    </form>
</section>
</body>
</html>
