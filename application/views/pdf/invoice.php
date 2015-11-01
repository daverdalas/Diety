<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 03.10.15
 * Time: 10:15
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    th{
        padding: 0 10px;
        text-align:left;
        background-color:lightgray;;
        border: 1px solid gray;
    }
    td{
        padding: 0 10px;
        border: 1px solid gray;
        vertical-align: top;
    }
</style>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="15mm" style="font-size: 9pt">
    <b>faktura vat nr: <?=$order->data->invoice;?></b><br>
    data sprzedaży: <?=$order->data->date;?><br>
    data faktury: <?=$order->data->date;?><br>
    <br>
    <b>nabywca:</b><br>
    <?=$order->data->company;?><br>
    <?=$order->data->fvat;?><br>
    nip: <?=$order->data->nip;?><br>
    <br>
    <b>sprzedawca:</b><br>
    nazwa: COOKING<br>
    adres<br>
    nip: ***-***-**-**<br>
    <br>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th style="width:5%;">Lp.</th>
            <th style="width:25%;">Nazwa</th>
            <th style="width:5%;">PKWiU</th>
            <th style="width:5%;">Il.</th>
            <th style="width:5%;">Jm</th>
            <th style="width:10%;">Cena netto</th>
            <th style="width:10%;">Wartość netto</th>
            <th style="width:10%;">Stawka VAT</th>
            <th style="width:10%;">Kwota VAT</th>
            <th style="width:10%;">Wartość brutto</th>
        </tr>
        <?php foreach( $order->cart as $n => $item ): ?>
        <tr>
            <td><?=$n+1;?></td>
            <td><?=$item->diet;?></td>
            <td></td>
            <td><?=$item->quantity;?></td>
            <td>szt.</td>
            <td><?=sprintf("%01.2f", $item->price/123);?></td>
            <td><?=sprintf("%01.2f", $item->price/123);?></td>
            <td>23%</td>
            <td><?=sprintf("%01.2f", $item->price/100-$item->price/123);?></td>
            <td><?=sprintf("%01.2f", $item->price/100);?></td>
        </tr>
        <?php endforeach;?>
        <tr>
            <td colspan="4"></td>
            <th colspan="2">razem</th>
            <td><?=sprintf("%01.2f", $order->data->price/123);?></td>
            <td>X</td>
            <td><?=sprintf("%01.2f", $order->data->price/100-$order->data->price/123);?></td>
            <td><?=sprintf("%01.2f", $order->data->price/100);?></td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <th colspan="2">w tym</th>
            <td><?=sprintf("%01.2f", $order->data->price/123);?></td>
            <td>X</td>
            <td><?=sprintf("%01.2f", $order->data->price/100-$order->data->price/123);?></td>
            <td><?=sprintf("%01.2f", $order->data->price/100);?></td>
        </tr>
    </table>
</page>