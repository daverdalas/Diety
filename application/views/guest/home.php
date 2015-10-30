<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>COOKING</title>
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href=<?php echo base_url()."/media/css/bootstrap.min.css" ?>>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url()."/media/css/bootstrap-theme.min.css"?>>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url()."/media/css/style.css"?>>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/jquery-1.11.3.min.js"?>></script>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/bootstrap.min.js"?>?>?>></script>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/enscroll.min.js"?>?>></script>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/jquery-ui.js"?>></script>
</head>
<body class = "body-app">
	<?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row login registration padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <div class = "col-xs-12 col-md-5 margin-top-50 centered">
            	<div class = "btn-back fluid-container margin-top-50 pull-left">
        			<?=anchor('/login', 'zaloguj', "class = 'btn btn-lg btn-show text-uppercase'");?>
    			</div>
    			<div class = "btn-back fluid-container margin-top-50 pull-right">
        			<?=anchor('/register', 'zarejestruj', "class = 'btn btn-lg btn-show text-uppercase'");?>
    			</div>
    		</div>
    	</div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>