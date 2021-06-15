<html>
<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<body>
<section>
    <form action="<?php echo URLROOT; ?>/historyAdmins/editHistory" method="post">
        <h2>History Event</h2>
        <label>Event Date</label>
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
            <label>Tour Guide</label>
            <input type="text" name="tour_guide" value='<?php echo $data['tour_guide']?>'>
        </aside>
        <aside>
            <label>Language</label>
            <input type="text" name="lang" value='<?php echo $data['lang']?>'>
        </aside>


        <aside>
            <label>Location Capacity</label>
            <input type="text" name="capacity" value='<?php echo $data['capacity']?>'>
        </aside>
        <button id="updateHistory" name="action" type="submit" value="updateHistory">Update History</button>
        <button id="insertHistory" name="action" type="submit" value="insertHistory">Create New History Event</button>
        <span class="invalidFeedback">
                    <?php echo $data['emptyFieldsErrors']; ?>
        </span>
    </form>
</section>
</body>
</html>
