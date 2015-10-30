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
    <section class = "row login padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Zaloguj się</h1>
            <div class = "col-xs-12 col-md-5 margin-top-50 centered">
                <p><?=$msg;?></p>
                <?=form_open();?>
                <div class = "form-group border-top centered text-center">
                    <input type="text" name="email" value="<?=set_value('email');?>" placeholder = "EMAIL"/><label class = "error"><?=form_error('email');?></label>
                </div>
                <div class = "form-group border-top border-bottom centered text-center">
                    <input type="password" name="pass" value="<?=set_value('pass1');?>" placeholder = "HASŁO"/><label class = "error"><?=form_error('pass1');?></label>
                </div>
                <div class = "btn-back fluid-container margin-top-50 centered">
                    <?=form_submit("","Zaloguj", "class = 'btn btn-lg btn-show text-uppercase'");?>
                </div>
                <legend class = "text-center text-small"><small><?=anchor('/register', 'lub załóż nowe konto');?></small></legend>
                <?=form_close();?>
            </div>
        </div>
</section>
    <?php include('application/views/footer.php'); ?>
    <!--<p><?=$msg;?></p>
    <?=form_open();?>

    <label><input type="text" name="email" value="<?=set_value('email');?>"/>email<?=form_error('email');?></label>
    <label><input type="password" name="pass" value="<?=set_value('pass1');?>"/>hasło<?=form_error('pass1');?></label>

    <?=form_submit("","Zaloguj", "class = 'btn btn-lg btn-show text-uppercase'");?>
    <?=anchor('/register', 'lub załóż nowe konto');?>
    <?=anchor('/', 'cancel');?>
    <?=form_close();?>-->
</body>
</html>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 28.09.15
 * Time: 11:24
 */
?>