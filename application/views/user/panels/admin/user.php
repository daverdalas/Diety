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
        ul
        {
            list-style-type: none;
            padding:0;
            padding-top:24px;
            margin:0;
        }
        li {
            margin:0;
            padding:0;
        }
        .weekend
        {
            color:blue;
        }
    </style>
</head>
<body>
<?=anchor('/user_panel/edit_user/'.$user->id, 'edytuj dane');?><br>
<?=anchor('/admin_panel/users', 'lista klientów');?><br>
<?=anchor('/admin_panel', 'panel administratora');?>

<h2><?=$user->name;?> <?=$user->surname;?></h2>
<h4><?=$user->email;?></h4>
<h4><?=$user->phone;?></h4>

<? foreach( $plans as $order ): ?>
    <ul>
        <li><u><b><?=$order->diet;?></b></u></li>
        <li>pozostało <?=$order->days_left;?> z <?=$order->days_total;?> dostaw</li>

        <? if( array_key_exists( $order->id, $calendars ) && count($calendars[$order->id]) ): ?>
        <li>najbliższa dostawa:<?=$calendars[$order->id][0]->day;?></li>
        <li>
            <?=$calendars[$order->id][0]->addy;?>
            od <?=$calendars[$order->id][0]->from;?>:00
            do <?=$calendars[$order->id][0]->to;?>:00
        </li>
        <? endif; ?>

        <? if( $order->invoice ): ?>
        <li><b>dane do faktury:</b></li>
        <li>nazwa firmy:<?=$order->order->company;?></li>
        <li>nip:<?=$order->order->nip;?></li>
        <li>adres faktury:<?=$order->order->fvat;?></li>
        <li><?=anchor("/order/invoice/".$order->invoice->id, "pobierz fakturę");?></li>
        <? endif; ?>

        <? if( array_key_exists( $order->id, $calendars ) && count($calendars[$order->id]) ): ?>
        <li><b>kalendarz dostaw:</b></li>
        <? foreach( $calendars[$order->id] as $delivery ): ?>
            <li <? if($delivery->weekend) echo "class='weekend'"; ?>>
                <?=$delivery->day;?>
                od <?=$delivery->from;?>:00
                do <?=$delivery->to;?>:00
                <?=$delivery->addy;?>
            </li>
        <? endforeach; ?>
        <? endif; ?>
    </ul>
<? endforeach; ?>

<h2>historia płatności</h2>
<ul>
<? foreach( $orders as $order ): ?>
    <li><?=$order->timestamp;?> <?=$order->status;?> <?=anchor("/admin_panel/payment_status/".$order->payment, "szczegóły");?></li>
<? endforeach; ?>
</ul>
</body>
</html>