<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <style>
        .nip {
            display:none;
        }
        .other {
            display:none;
        }
        .otherh {
            display:none;
        }
    </style>
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
                $('#from').html('');
                for( f=6; f<10; f++ )
                    $('#from').append( $('<option>', { value : f }).text(f+":00") );

                $('#from1').html('');
                for( f=6; f<10; f++ )
                    $('#from1').append( $('<option>', { value : f }).text(f+":00") );

                reindex_to();

                if( $('#cother').is(':checked') ) $('.other').show();
                if( $('#cotherh').is(':checked') ) $('.#otherh').show();
                if( $('#cnip').is(':checked') ) $('.nip').show();
            }
        );

        function reindex_to( )
        {
            $('#to').html('');
            for( f=parseInt($('#from').val())+1; f<11; f++ )
                $('#to').append( $('<option>', { value : f }).text(f+":00") );

            $('#to1').html('');
            for( f=parseInt($('#from1').val())+1; f<11; f++ )
                $('#to1').append( $('<option>', { value : f }).text(f+":00") );
        }
    </script>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row my-account edit-user padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h2 class = "text-uppercase">Podsumowanie zamówienia</h2>
            <div class = "col-xs-12 col-md-5 centered">
            <?=form_open("", "class = 'col-sm-12 margin-top-50 margin-bottom-100 form-horizontal text-left text-uppercase'");?>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Imię</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="name" value="<?=set_value('name', $user->name );?>"/><label class = "error"><?=form_error('name');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Nazwisko</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="surname" value="<?=set_value('surname', $user->surname );?>"/><label class = "error"><?=form_error('surname');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Email</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="email" value="<?=set_value('email', $user->email );?>"/><label class = "error"><?=form_error('email');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">numer tel.</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="phone" value="<?=set_value('phone', $user->phone );?>"/><label class = "error"><?=form_error('phone');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">adres dostawy</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="addy" value="<?=set_value('addy', $user->addy );?>"/><label class = "error"><?=form_error('addy');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">godziny dostawy</label>
                <div class = "col-xs-12 col-sm-6 text-uppercase hours">Od: <select id="from" name="from" onchange="reindex_to()"></select>Do: <select id="to" name="to"></select><label class = "error"><?=form_error('from');?> <?=form_error('to');?></label></div>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <div class = "checkbox centered text-left no-padding">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Firma</label>
                    <input type="checkbox" onchange="$(this).is(':checked') ? $('.nip').show() : $('.nip').hide();"; name="cnip" id="cnip" <?=set_checkbox('cnip', 'on', false);?>/>
                    <label class = "plusweekends"><span></span> 
                    </label>
                </div>
            </div>
            <div class = "col-sm-12 form-group about-user nip">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">nazwa firmy</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="company" value="<?=set_value('company', $user->name." ".$user->surname );?>"/><label class = "error"><?=form_error('company');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user nip">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">nip</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="nip" value="<?=set_value('nip', $user->nip );?>"/><label class = "error"><?=form_error('nip');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user nip">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">adres firmy</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="fvat" value="<?=set_value('fvat', $user->fvat );?>"/><label class = "error"><?=form_error('fvat');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <div class = "checkbox centered text-left no-padding">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Inny adres weekendowy</label>
                    <input type="checkbox" onchange="$(this).is(':checked') ? $('.other').show() : $('.other').hide();" name="cother" id="cother" <?=set_checkbox('cother', 'on', false);?>;/>
                    <label class = "plusweekends"><span></span> 
                    </label>
                </div>
            </div>
            <div class = "col-sm-12 form-group about-user other">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">adres weekendowy</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="addy2" value="<?=set_value('addy2', $user->addy );?>"/><label class = "error"><?=form_error('addy2');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <div class = "checkbox centered text-left no-padding">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Inne godziny w weekend</label>
                    <input type="checkbox" onchange="$(this).is(':checked') ? $('.otherh').show() : $('.otherh').hide();"; name="cotherh" id="cotherh" <?=set_checkbox('cotherh', 'on', false);?>/>
                    <label class = "plusweekends"><span></span> 
                    </label>
                </div>
            </div>
            <div class = "col-sm-12 form-group about-user otherh">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">godziny dostawy</label>
                <div class = "col-xs-12 col-sm-6 text-uppercase hours">Od: <select id="from1" name="from1" onchange="reindex_to()"></select>Do: <select id="to1" name="to1"></select><label class = "error"><?=form_error('from1');?> <?=form_error('to1');?></label></div>
            </div>
            <div class = "col-sm-12 form-group about-user text-uppercase agree">
                <div class = "checkbox centered text-left">
                    <input type="checkbox" name="zgoda1" <?=set_checkbox('zgoda1', 'on', false);?>/>
                    <label><span></span>
                        <p class = "accept"><em>zgoda1</em></p> 
                    </label>
                    <label class = "error"><?=form_error('zgoda1');?></label>
                </div>
            </div>
            <div class = "col-sm-12 form-group about-user text-uppercase agree">
                <div class = "checkbox centered text-left">
                    <input type="checkbox" name="zgoda2" <?=set_checkbox('zgoda2', 'on', false);?>/>
                    <label><span></span>
                        <p class = "accept"><em>zgoda2</em></p>

                    </label>
                    <label class = "error"><?=form_error('zgoda2');?></label> 
                </div>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">uwagi</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="comment" value="<?=set_value('comment' );?>"/><label class = "error"><?=form_error('comment');?></label>
            </div>
            <div class = "col-sm-12 text-center">
                <div class = "btn-back fluid-container margin-top-50">
                    <?=form_submit("","kontynuuj", "class = 'btn btn-lg btn-show text-uppercase'");?>
                </div>
                <h4><?=anchor('/order/cart', 'anuluj', "class = 'cancel text-lowercase'");?></h4>
            </div>
            <?=form_close();?>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>