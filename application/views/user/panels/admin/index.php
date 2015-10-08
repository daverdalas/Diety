<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        a {
            display:block;
        }
    </style>
</head>
<body>
<? $today = ( new DateTime() )->format('Y-m-d'); ?>
<?=anchor('/', 'home');?>
<?=anchor('/login/out', 'wyloguj');?>
<?=anchor('/admin_panel/users', 'lista klientów');?>
<?=anchor("/admin_panel/history", "listy dostaw");?>
<?=anchor('/admin_panel/diets', 'plany abonamentowe');?>
</body>
</html>