<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 03.10.15
 * Time: 08:37
 */

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
        <script>
            function toggleCompany()
            {
                $('#company').is(':checked') ? $('.nip').show() : $('.nip').hide();
            }
            $(document).ready( function(){
                toggleCompany();
            })
        </script>
    </head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row my-account edit-user">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase margin-bottom-30">Zmień dane</h1>
            <div class = "col-xs-12 col-md-5 centered">
                <?=form_open("", "class = 'col-sm-12 no-padding margin-top-50 margin-bottom-100 form-horizontal text-left text-uppercase'");?>
                <div class = "col-xs-12 form-group about-user">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Imię</label>
                    <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="name" value="<?=set_value('name', $user->name);?>"/><label class = "error"><?=form_error('name');?></lbel>
                </div>
                <div class = "col-xs-12 form-group about-user">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Nazwisko</label>
                    <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="surname" value="<?=set_value('surname', $user->surname);?>"/><label class = "error"><?=form_error('surname');?></label>
                </div>
                <div class = "col-xs-12 form-group about-user">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">numer tel.</label>
                    <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="phone" value="<?=set_value('phone', $user->phone);?>"/><label class = "error"><?=form_error('phone');?></label>
                </div>
                <div class = "col-xs-12 form-group about-user">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Adres</label>
                    <input type="text" name="addy" class = "col-xs-12 col-sm-6 text-uppercase" value="<?=set_value('addy', $user->addy);?>"/><label class = "error"><?=form_error('addy');?></label>
                </div>
                <div class = "col-xs-12 form-group about-user">
                    <div class = "checkbox centered text-left no-padding">
                        <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Firma</label>
                        <input type="checkbox" id="company" name="company" onchange="toggleCompany()" <?=set_checkbox('company', 'on', $user->nip != null);?>/>
                        <label class = "plusweekends"><span></span> 
                        </label>
                    </div>
                </div>
                <div class = "col-xs-12 form-group about-user nip">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">nip</label>
                    <input type="text" name="nip" value="<?=set_value('nip', $user->nip);?>" class = "col-xs-12 col-sm-6 text-uppercase"/><label class = "error"><?=form_error('nip');?></label>
                </div>
                <div class = "col-xs-12 form-group about-user nip">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">adres firmy</label>
                    <input type="text" name="fvat" value="<?=set_value('fvat', $user->fvat);?>" class = "col-xs-12 col-sm-6 text-uppercase"/><label class = "error"><?=form_error('fvat');?></label>
                </div>
                <div class = "col-xs-12 text-center">
                    <div class = "btn-back fluid-container margin-top-50">
                        <?=form_submit("","Zapisz", "class = 'btn btn-lg btn-show text-uppercase'");?>
                    </div>
                    <h4><?=anchor('/user_panel', 'anuluj', "class = 'cancel text-lowercase'");?></h4>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>