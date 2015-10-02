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
        ul
        {
            list-style-type: none;
            padding:0;
            margin:0;
        }
        li {
            margin:0;
            padding:0;
        }
    </style>
</head>
<body>
<?=anchor('/user_panel/history', 'historia transakcji');?>
<?=anchor('/user_panel', 'aktualne diety');?>
<?=anchor('/user_panel', 'edycja konta');?>
<br><br>
<? foreach( $orders as $order ): ?>
    <ul>
        <li><u><b><?=$order->diet;?></b></u></li>
        <li>najbliższa dostawa <?=$order->next;?> od <?=$order->from;?>:00 do <?=$order->to;?>:00</li>
        <li><?=$order->name;?> <?=$order->surname;?></li>
        <li><?=$order->addy;?></li>
        <li><?=anchor('/user_panel/edit/'.$order->id, 'edytuj');?></li>
    </ul>
<? endforeach; ?>

</body>
</html>