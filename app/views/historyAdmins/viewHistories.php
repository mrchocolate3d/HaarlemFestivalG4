<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<main role="main">
    <title>Dance View</title>
    <table width="100%" border="1" style="border-collapse: collapse">
        <thead>
        <tr>
            <th><strong>Date</strong></th>
            <th><strong>Start Time</strong></th>
            <th><strong>Tour Guide</strong></th>
            <th><strong>Language</strong></th>
            <th><strong>Quantity</strong></th>
            <th><strong>add</strong></th>
            <th><strong>delete</strong></th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $datum){ ?>
            <tr>
                <td align="center"><?php echo $datum['tour_guide']; ?></td>
                <td align="center"><?php echo $datum['startTime']; ?></td>
                <td align="center"><?php echo $datum['event_date']; ?></td>
                <td align="center"><?php echo $datum['lang']; ?></td>
                <td align="center"><?php echo $datum['capacity']; ?></td>


                <td align="center">
                    <a href="<?php echo URLROOT; ?>/historyAdmins/editHistory?id=<?php echo $datum['event_id']; ?>">Edit</a>
                </td>

                <td align="center">
                    <a href="<?php echo URLROOT; ?>/historyAdmins/deleteHistory?id=<?php echo $datum['event_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>

    <a href="<?php echo URLROOT; ?>/historyAdmins/editHistory">New History Event</a>


</main>