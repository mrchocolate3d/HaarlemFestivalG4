<?php
  
require APPROOT . '/views/includes/header.php';
require APPROOT . '/views/includes/navigation.php';

?>

<form action="<?php echo URLROOT; ?>/Invoice/generatePdfx">
	<button type="submit">Generate Invoice</button>
</form>