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
    <?=anchor('/login/out', 'wyloguj');?>
    <?=anchor('/order', 'zamów');?>
    <? if( $__admin ) echo anchor('/admin_panel', 'panel administratora'); ?>
    <? if( $__user ) echo anchor('/user_panel', 'panel klienta'); ?>
</body>
</html>