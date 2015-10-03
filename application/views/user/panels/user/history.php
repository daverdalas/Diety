<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 02.10.15
 * Time: 08:50
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        th{
            padding: 0 10px;
            text-align:left;
            color:white;
            background-color: black;;
        }
        td{
            padding: 0 10px;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            vertical-align: top;
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
        i {
            display:block;
            margin-top:25px;
        }
        .status-W {
            color:red;
        }
        .status-A {
            color:darkgreen;
        }
        .status-S {
            color:darkblue;
        }
        .status-X {
            color:darkgray;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>zamówienie</th>
        <th>dieta</th>
        <th>dostawa</th>
        <th>dostawa weekend</th>
        <th>opcje</th>
    </tr>
<? if( $orders != null ): ?>
<? foreach( $orders as $order ): ?>
    <? $first = true; ?>
    <? foreach( $order->cart as $diet ): ?>
    <tr class="status-<?=$diet->status;?>">
        <? if($first): ?>
        <td rowspan="<?=count($order->cart);?>">
            <ul>
            <li>data: <?=$order->data->timestamp;?></li>
            <li>wartość <?=sprintf("%01.2f",$order->data->price/100 );?> PLN</li>
            <li><?=( $diet->status == 'W' ? anchor("/order/process/".$order->data->id, "opłać") : "opłacone" );?></li>
            <li>
                <?php
                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $order->data->timestamp);
                    $now = new DateTime();
                    if(
                        $diet->status != 'W' &&
                        (
                            $order->data->company != null ||
                            (
                                $date->format('n') == $now->format('n') &&
                                $date->format('Y') == $now->format('Y')
                            )
                        )
                    )
                    if( $order->data->invoice != 0 ) echo anchor("/order/invoice/".$order->data->invoice, "pobierz fakturę");
                ?>
            </li>
            <li><i><?=$order->data->comment;?></i></li>
            </ul>
        </td>
        <? endif; ?>
        <td>
            <ul>
                <li><?=$diet->quantity;?> x <?=$diet->diet;?></li>
                <li>start: <?=$diet->from;?></li>
                <li><?=( $diet->weekend ? '7 dni w tyg.' : 'tylko w dni robocze');?></li>
                <li>
                    <?php
                        switch( $diet->status ){
                            case 'W': echo 'nieopłacona'; break;
                            case 'A': echo 'aktualna '; break;
                            case 'X': echo 'archiwalna'; break;
                        }
                    ?>
                </li>
                <li>pozostało <?=( $diet->days_left." z ".$diet->days_total );?> dni</li>
                <li>cena <?=sprintf("%01.2f",$diet->price*$diet->quantity/100 );?> PLN</li>
            </ul>
        </td>
        <td>
            <ul>
            <li><?=$diet->name;?> <?=$diet->surname;?></li>
            <li><?=$diet->email;?></li>
            <li><?=$diet->phone;?></li>
            <li><?=$diet->addy;?></li>
            <li>
                od <?=$diet->time_from;?>:00
                do <?=$diet->time_to;?>:00
            </li>
            </ul>
        </td>
        <td>
            <ul>
            <? if( $diet->weekend ): ?>
                <li><?=$diet->name;?> <?=$diet->surname;?></li>
                <li><?=$diet->email;?></li>
                <li><?=$diet->phone;?></li>
                <li><?=( $diet->addy_w == null ? $diet->addy : $diet->addy_w );?></li>
                <li>
                    od <?=( $diet->time_from_w == null ? $diet->time_from : $diet->time_from_w );?>:00
                    do <?=( $diet->time_to_w == null ? $diet->time_to : $diet->time_to_w );?>:00
                </li>
            <? else: ?>
                <li>bez dostawy</li>
            <? endif; ?>
            </ul>
        </td>
        <td>
            <ul>
                <li><?php if( $diet->status!='X' ) echo anchor('/user_panel/edit/'.$diet->id, 'edytuj') ?></li>
            </ul>
        </td>
    </tr>
    <? $first = false; ?>
    <? endforeach; ?>
<? endforeach; ?>
<? endif; ?>
</table>
</body>
</html>