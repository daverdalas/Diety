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
    </style>
</head>
<body>
<?=anchor('/user_panel/edit_user/'.$user->id, 'edytuj dane');?>
<?=anchor('/admin_panel/users', 'lista klientów');?>
<?=anchor('/admin_panel', 'panel administratora');?>
<pre>
    <?=print_r($user);?>
</pre>
</body>
</html>