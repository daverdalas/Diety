<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 02.10.15
 * Time: 18:04
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        a {
            display:block;
        }
        input {
            display:block;
            width:300px;
        }
        input[type=submit] {
            margin-top:10px;
        }
        label {
            display:block;
            font-size: small;
            width:300px;
        }
    </style>
</head>
<body>
<?=anchor('/', 'home');?>
<?=anchor('/login/out', 'wyloguj');?>
<?=anchor('/admin_panel', 'panel admina');?>
<br><br>
<? foreach( $diets as $diet ): ?>
    <?=anchor('/admin_panel/diet/'.$diet[0]->id, $diet[0]->name);?>
<? endforeach; ?>
<?=anchor('/admin_panel/diet/0', '-- nowa dieta --');?>
</body>
</html>