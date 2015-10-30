<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 02.10.15
 * Time: 18:04
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<table class = "table table-bordered text-uppercase clients-list margin-top-50">
    <tr>
        <th>użytkownik</th>
        <th>zamówienie</th>
    </tr>
    <? foreach( $users as $user ): ?>
        <tr>
        <td><u><?=anchor('/admin_panel/user/'.$user->id, $user->name." ".$user->surname);?></u></td>
        <td>
            <ul class="list-unstyled text-left">
            <? foreach( $user->plans as $plan ): ?>
                <li><?=$plan->diet?></li>
            <? endforeach; ?>
            </ul>
        </td>
        </tr>
    <? endforeach; ?>
</table>
<table class = "table">
    <tr>
        <td><? if($prev >= 0):?><a href="#" onclick="loadPage(<?=$prev;?>)"><< WSTECZ</a><? endif;?></td>
        <td><?=$page;?></td>
        <td><? if($next > 0):?><a href="#" onclick="loadPage(<?=$next;?>)">DALEJ >></a><? endif;?></td>
    </tr>
</table>