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
    <section class = "row my-account padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Panel administracyjny</h1>
            <div class = "col-xs-12 col-md-5 margin-top-50 centered">
            	<div class = "col-sm-12 no-padding text-uppercase text-left about-user">
            		<div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Lista klientów</div>
		 				<?=anchor('/admin_panel/users', 'zobacz', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
            	</div>
            	<div class = "col-sm-12 no-padding text-uppercase text-left about-user">
            		<div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Lista dostaw</div>
		 				<?=anchor("/admin_panel/history", 'zobacz', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
            	</div>
            	<div class = "col-sm-12 no-padding text-uppercase text-left about-user">
            		<div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Plany abonamentowe</div>
		 				<?=anchor('/admin_panel/diets', 'edytuj', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
            	</div>
            	<div class = "col-sm-12 no-padding text-uppercase text-left about-user">
            		<div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">wróć</div>
		 				<?=anchor('/', 'panel główny', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
            	</div>
            	<div class = "btn-back fluid-container margin-top-50 centered">
                		<?=anchor('/login/out', 'wyloguj', 'class ="btn btn-lg btn-show text-uppercase"');?>
            	</div>
				<?php $today = ( new DateTime() )->format('Y-m-d'); ?>
			</div>
		</div>
	</section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>