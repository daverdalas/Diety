<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <style>
        input {
            display:block;
            width:300px;
        }
        select {
            display:inline;
            width:120px;
        }
        input[type=checkbox] {
            display:inline;
            margin-top:10px;
            width:10px;
        }
        input[type=submit] {
            margin-top:10px;
        }
        label {
            display:block;
            font-size: small;
            width:300px;
        }
        label p {
            padding-left:20px;
            display:inline;
            color:red;
            font-size: smaller;
        }
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
<body>
<?=form_open();?>

<label><input type="text" name="name" value="<?=set_value('name', $user->name );?>"/>imie<?=form_error('name');?></label>
<label><input type="text" name="surname" value="<?=set_value('surname', $user->surname );?>"/>nazwisko<?=form_error('surname');?></label>
<label><input type="text" name="email" value="<?=set_value('email', $user->email );?>"/>email<?=form_error('email');?></label>
<label><input type="text" name="phone" value="<?=set_value('phone', $user->phone );?>"/>telefon<?=form_error('phone');?></label>

<label><input type="text" name="addy" value="<?=set_value('addy', $user->addy );?>"/>adres dostawy<?=form_error('addy');?></label>

<label><input type="checkbox" onchange="$(this).is(':checked') ? $('.nip').show() : $('.nip').hide();"; name="cnip" id="cnip" <?=set_checkbox('cnip', 'on', false);?>/>adres do faktury</label>
<label class="nip"><input type="text" name="company" value="<?=set_value('company', $user->name." ".$user->surname );?>"/>nazwa firmy<?=form_error('company');?></label>
<label class="nip"><input type="text" name="nip" value="<?=set_value('nip', $user->nip );?>"/>nip<?=form_error('nip');?></label>
<label class="nip"><input type="text" name="fvat" value="<?=set_value('fvat', $user->fvat );?>"/>adres fvat<?=form_error('fvat');?></label>

<label><input type="checkbox" onchange="$(this).is(':checked') ? $('.other').show() : $('.other').hide();" name="cother" id="cother" <?=set_checkbox('cother', 'on', false);?>;/>inny adres weekendowy</label>
<label class="other"><input type="text" name="addy2" value="<?=set_value('addy2', $user->addy );?>"/>adres<?=form_error('addy2');?></label>

<label>
    <div>
        Od: <select id="from" name="from" onchange="reindex_to()"></select>
        Do: <select id="to" name="to"></select>
    </div>
    godziny dostawy <?=form_error('from');?> <?=form_error('to');?>
</label>

<label><input type="checkbox" onchange="$(this).is(':checked') ? $('.otherh').show() : $('.otherh').hide();"; name="cotherh" id="cotherh" <?=set_checkbox('cotherh', 'on', false);?>/>inny godziny dostawy w weekend</label>
<label class="otherh">
    <div>
        Od: <select id="from1" name="from1" onchange="reindex_to()"></select>
        Do: <select id="to1" name="to1"></select>
    </div>
    godziny dostawy weekendowej<?=form_error('from1');?> <?=form_error('to1');?>
</label>

<label><input type="checkbox" name="zgoda1" <?=set_checkbox('zgoda1', 'on', false);?>/>zgoda1<?=form_error('zgoda1');?></label>
<label><input type="checkbox" name="zgoda2" <?=set_checkbox('zgoda2', 'on', false);?>/>zgoda2<?=form_error('zgoda2');?></label>

<label><input type="text" name="comment" value="<?=set_value('comment' );?>"/>uwagi<?=form_error('comment');?></label>

<?=form_submit("","kontynuuj");?>
<a href='#' onclick="window.history.back(); return false;">cancel</a>
<?=form_close();?>
</body>
</html>