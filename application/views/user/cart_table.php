<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<table class = "table table-dashed margin-top-50 margin-bottom-50 text-uppercase text-left">
    <tr>
        <th>produkt</th>
        <th>ilość</th>
        <th>początek</th>
        <th>koniec</th>
        <th>cena</th>
        <th>usuń</th>
    </tr>
    <?php foreach( $cart as $order ): ?>
    <tr>
        <td><?=$order->label;?></td>
        <td>
            <p>
                <span id='i<?=$order->id;?>'><?=$order->quantity;?></span>
                <span>
                    <a href="javascript:modify(<?=$order->id;?>,1)">+</a>
                    <a href="javascript:modify(<?=$order->id;?>,-1)">-</a>
                </span>
            </p>
            <a href="javascript:recalc()"><p>przelicz</p></a>
        </td>
        <td><?=$order->begin;?></td>
        <td><?=$order->end;?></td>
        <td><?=$order->cost;?></td>
        <td><a href="javascript:remove(<?=$order->id;?>)">usuń</a></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th><h3>podsumowanie</h3></th>
        <td colspan = "5" class = "text-right"><h3><?=$cost;?> PLN</h3></td>
    </tr>
</table>
