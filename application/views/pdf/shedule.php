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
    <h1>Lista dostaw na <?=$list[0]->date;?></h1>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th style="width:30%;">data</th>
            <th style="width:30%;">dieta</th>
            <th style="width:40%;">osoba</th>
        </tr>
        <?php foreach( $list as $entry ): ?>
        <tr>
            <td>od <?=$entry->from;?>:00 do <?=$entry->to;?>:00</td>
            <td><?=$entry->quantity;?> x <?=$entry->diet;?>:00</td>
            <td>
                <?=$entry->name;?> <?=$entry->surname;?><br>
                <?=$entry->addy;?><br>
                <?=$entry->phone;?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</page>