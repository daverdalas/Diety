<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        input {
            display:block;
            width:300px;
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
    </style>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
    <?=form_open();?>

    <label><input type="text" name="email" value="<?=set_value('email');?>"/><?=lang('email');?><?=form_error('email');?></label>
    <label><input type="password" name="pass1" value="<?=set_value('pass1');?>"/><?=lang('haslo');?><?=form_error('pass1');?></label>
    <label><input type="password" name="pass2" value="<?=set_value('pass1');?>"/><?=lang('re_haslo');?><?=form_error('pass1');?></label>
    <label><input type="text" name="name" value="<?=set_value('name');?>"/><?=lang('imie');?><?=form_error('name');?></label>
    <label><input type="text" name="surname" value="<?=set_value('surname');?>"/><?=lang('nazwisko');?><?=form_error('surname');?></label>
    <label><input type="text" name="phone" value="<?=set_value('phone');?>"/><?=lang('telefon');?><?=form_error('phone');?></label>
    <label><input type="text" name="addy" value="<?=set_value('addy');?>"/><?=lang('adres_dostawy');?><?=form_error('addy');?></label>

    <label><input type="checkbox" id="company" name="company" onchange="$('#company').is(':checked') ? $('.nip').show() : $('.nip').hide();";/><?=lang('firma');?></label>

    <label class="nip"><input type="text" name="nip"/><?=lang('nip');?><?=form_error('nip');?></label>
    <label class="nip"><input type="text" name="fvat"/><?=lang('adres_firmy');?><?=form_error('fvat');?></label>

    <?=form_submit("","Zarejestruj");?>
    <?=anchor('/', 'cancel');?>
    <?=form_close();?>
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