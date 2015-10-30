<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
    <script>
        $(document).ready(
            function()
            {
                $('.date-pick').datepicker({
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(dateText, inst){
                        window.location= "<?=base_url();?>index.php/admin_panel/shedule/"+dateText;
                    },
                });
            }
        );

    </script>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row order my-account edit-order padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h2 class = "text-uppercase">W wybranym dniu nie ma żadnych zamówień</h2>
            <div class = "margin-top-50 col-md-6 centered">
	            <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
	                <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">wróć</div>
	                    <?=anchor('/admin_panel/history', 'Lista dostaw', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
	            </div>
	            <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
	                <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Panel klienta</div>
	                    <?=anchor('/user_panel', 'moje konto', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
            	</div>
	        </div>
	    </div>
	</section>
	<?php include('application/views/footer.php'); ?>
</body>
</html>