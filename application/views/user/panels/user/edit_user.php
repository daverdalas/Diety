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
<body>
<?=form_open();?>

    <label><input type="text" name="name" value="<?=set_value('name', $user->name);?>"/><?=lang('imie');?><?=form_error('name');?></label>
    <label><input type="text" name="surname" value="<?=set_value('surname', $user->surname);?>"/><?=lang('nazwisko');?><?=form_error('surname');?></label>
    <label><input type="text" name="phone" value="<?=set_value('phone', $user->phone);?>"/><?=lang('telefon');?><?=form_error('phone');?></label>
    <label><input type="text" name="addy" value="<?=set_value('addy', $user->addy);?>"/><?=lang('adres_dostawy');?><?=form_error('addy');?></label>

    <label><input type="checkbox" id="company" name="company" onchange="toggleCompany()" <?=set_checkbox('company', 'on', $user->nip != null);?>/><?=lang('firma');?></label>

    <label class="nip"><input type="text" name="nip" value="<?=set_value('nip', $user->nip);?>"/><?=lang('nip');?><?=form_error('nip');?></label>
    <label class="nip"><input type="text" name="fvat" value="<?=set_value('fvat', $user->fvat);?>"/><?=lang('adres_fvat');?><?=form_error('fvat');?></label>

<?=form_submit("","Zapisz");?>
<?=anchor('/user_panel', 'cancel');?>
<?=form_close();?>
</body>
</html>