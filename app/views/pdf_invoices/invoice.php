<?php
    include APPROOT . '/views/includes/header.php';
?>

<!DOCTYPE html>
<head>

</head>
<body>
    <form action="<?php echo URLROOT. 'pdf_invoice/send_mail';?>" method="POST">
            <button type="submit">SendMail</button>
    </form>
</body>