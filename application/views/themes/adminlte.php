<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

    <?php $this->load->view('elements/head.php'); ?>

    <body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">

            <?php $this->load->view( 'elements/header.php'); ?>
            <?php  $this->load->view('elements/sidebar.php'); ?>

           	<?php echo $content;?>

            <?php  $this->load->view('elements/footer.php'); ?>
    </body>
</html>