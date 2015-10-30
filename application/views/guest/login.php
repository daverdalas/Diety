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
    <p><?=$msg;?></p>
    <?=form_open();?>

    <label><input type="text" name="email" value="<?=set_value('email');?>"/><?=lang('email');?><?=form_error('email');?></label>
    <label><input type="password" name="pass" value="<?=set_value('pass1');?>"/><?=lang('haslo');?><?=form_error('pass1');?></label>

    <?=form_submit("","Zaloguj");?>
    <?=anchor('/register', 'zarejestrujh');?>
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