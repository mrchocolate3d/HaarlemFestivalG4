<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<main role="main">
    <title>Artist View</title>
    <table width="100%" border="1" style="border-collapse: collapse">
        <thead>
        <tr>
            <th><strong>Name</strong></th>
            <th><strong>Genre</strong></th>
            <th><strong>Edit</strong></th>
            <th><strong>Delete</strong></th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($data as $datum){ ?>
            <tr>
                <td align="center"><?php echo $datum['name']; ?></td>
                <td align="center"><?php echo $datum['genre']; ?></td>
                <td align="center">
                    <a href="<?php echo URLROOT; ?>/danceAdmins/editArtist?id=<?php echo $datum['id']; ?>">Edit</a>
                </td>

                <td align="center">
                    <a href="<?php echo URLROOT; ?>/historyAdmins/deleteHistory?id=<?php echo $datum['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>

    <a href="<?php echo URLROOT; ?>/historyAdmins/editHistory">New History Event</a>


</main>