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
            <h1 class = "text-uppercase">rejestracja</h1>
            <?=form_open("", "class = 'form-horizontal col-xs-12 col-md-5 margin-top-50 centered'");?>
            <div class = "form-group border-top centered text-left">
                <label for = "mail" class = "col-xs-12 text-uppercase">email:</label>
                <input class = "col-xs-12 col-xs-12 user_info" type="text" name="email" value="<?=set_value('email');?>"id = "mail"/><label class = "error"><?=form_error('email');?></label>
            </div>
            <div class = "form-group border-top centered text-left">
                <label for = "password1" class = "col-xs-12 text-uppercase ">Hasło:</label>
                <input type = "password" class = "col-xs-12 user_info" name="pass1" id = "password1" value="<?=set_value('pass1');?>"/><label class = "error"><?=form_error('pass1');?></label>
            </div>
            <div class = "form-group border-top centered text-left">
                <label for = "password2" class = "col-xs-12 text-uppercase ">Powtórz hasło:</label>
                <input type = "password" class = "col-xs-12 user_info" name="pass2" id = "password2" value="<?=set_value('pass2');?>"/><label class = "error"><?=form_error('pass2');?></label>
            </div>
            <div class = "form-group border-top centered text-left">
                <label for = "name" class = "col-xs-12 text-uppercase">Imię:</label>
                <input type = "text" class = "col-xs-12 user_info" name="name" id = "name" value="<?=set_value('name');?>"/><label class = "error"><?=form_error('name');?></label>
            </div>
            <div class = "form-group border-top centered text-left">
                <label for = "lastname" class = "col-xs-12 text-uppercase">Nazwisko:</label>
                <input type = "text" class = "col-xs-12 user_info" name="surname" id = "lastname" value="<?=set_value('surname');?>"/><label class = "error"><?=form_error('surname');?></label>
            </div>
            <div class = "form-group border-top centered text-left">
                <label for = "phone-number" class = "col-xs-12 text-uppercase ">Numer telefonu:</label>
                <input type = "tel" class = "col-xs-12 user_info" name="phone" id = "phone-number" value="<?=set_value('phone');?>"/><label class = "error"><?=form_error('phone');?></label>
            </div>
            <div class = "form-group border-top centered text-left border-bottom">
                <label for = "address" class = "col-xs-12 text-uppercase">Adres:</label>
                <input type="text" name="addy" class = "col-xs-12 user_info" value="<?=set_value('addy');?>" id = "address"/><label class = "error"><?=form_error('addy');?></label>
            </div>
            <div class = "col-md-12 form-group centered text-uppercase">
                <div class = "checkbox centered text-left">
                    <input type = "checkbox" id="company" name="company" onchange="$('#company').is(':checked') ? $('.nip').show() : $('.nip').hide();";/>
                    <label><span></span>
                        <p class = "accept">Firma</p> 
                    </label>
                 </div>
            </div>
            <div class = "form-group border-top centered text-left nip">
                <label for = "nip" class = "col-xs-12 text-uppercase">nip:</label>
                <input type = "text" name = "nip" class = "col-xs-12 user_info"  id = "nip"><label class = "error"><?=form_error('nip');?></label>
            </div>
            <div class = "form-group border-top centered text-left nip border-bottom">
                <label for = "vat" class = "col-xs-12 text-uppercase">adres firmy:</label>
                <input type = "text" name = "fvat" class = "col-xs-12 user_info"  id = "vat"><label class = "error"><?=form_error('fvat');?></label>
            </div>
            <div class = "col-md-12 form-group margin-top-50 centered text-uppercase ">
                <div class = "checkbox text-left">
                    <input type = "checkbox">
                    <label><span class = "checkbox-white"></span>
                        <p><em>Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60. XX w. wraz z publikacją</em></p> 
                    </label>
                </div>
            </div>
            <div class = "col-md-12 form-group centered text-uppercase ">
                <div class = "checkbox centered text-left">
                    <input type = "checkbox" required>
                    <label><span></span>
                        <p class = "accept"><em>Akceptuje regulamin</em></p> 
                    </label>
                </div>
            </div>
            <div class = "btn-back fluid-container margin-top-50 centered">
                <?=form_submit("","Wyślij", "class = 'btn btn-lg btn-show text-uppercase'");?>
            </div>
            <!--<?=anchor('/', 'cancel');?>-->
            <?=form_close();?>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
        <script>
        jQuery(document).ready(function($) {
            $(".user_info").focus(function(){;
                $(this).parent().css('background', '#58595b').css('color', '#fff');
                $(this).css('background', '#58595b').css('color', '#fff');
            }).blur(function(){
                $(this).parent().css('background', 'inherit').css('color', 'inherit');
                $(this).css('background', 'inherit').css('color', 'inherit');
  })
        });    
        </script>
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