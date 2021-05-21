<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<main role="main">
    <title>Dance View</title>
    <table width="100%" border="1" style="border-collapse: collapse">
        <thead>
        <tr>
            <th><strong>AdminID</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>role</strong></th>
            <th><strong>edit</strong></th>
            <th><strong>delete</strong></th>
        </tr>
        </thead>
        <tbody>
        <?php

        //var_dump($data);
        foreach ($data as $datum){ ?>
            <tr>
                <td align="center"><?php echo $datum['AdminID']; ?></td>
                <td align="center"><?php echo $datum['Email']; ?></td>
                <td align="center"><?php echo $datum['role']; ?></td>

                <td align="center">
                    <a href="<?php echo URLROOT; ?>/admins/editAdmin?id=<?php echo $datum['AdminID']; ?>">Edit</a>
                </td>

                <td align="center">
                    <a href="<?php echo URLROOT; ?>/admins/deleteDance?id=<?php echo $datum['AdminID']; ?>">Delete</a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>

    <a href="<?php echo URLROOT; ?>/admins/editAdmin">New Admin Account</a>


</main>
