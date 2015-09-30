<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<table>
    <tr>
        <th>produkt</th>
        <th>ilość</th>
        <th>początek</th>
        <th>koniec</th>
        <th>cena</th>
        <th>usuń</th>
    </tr>
    <? foreach( $cart as $order ): ?>
    <tr>
        <td><?=$order->label;?></td>
        <td>
            <div id='i<?=$order->id;?>'><?=$order->quantity;?></div>
            <a href="javascript:modify(<?=$order->id;?>,1)">+</a>
            <a href="javascript:modify(<?=$order->id;?>,-1)">-</a>
            <a href="javascript:recalc()">przelicz</a>
        </td>
        <td><?=$order->begin;?></td>
        <td><?=$order->end;?></td>
        <td><?=$order->cost;?></td>
        <td><a href="javascript:remove(<?=$order->id;?>)">usuń</a></td>
    </tr>
    <? endforeach; ?>
</table>

<h2><?=$cost;?></h2>
