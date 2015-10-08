<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 02.10.15
 * Time: 18:04
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<table>
    <tr>
        <td><? if($prev >= 0):?><a href="#" onclick="loadPage(<?=$prev;?>)"><< WSTECZ</a><? endif;?></td>
        <td><?=$page;?></td>
        <td><? if($next > 0):?><a href="#" onclick="loadPage(<?=$next;?>)">DALEJ >></a><? endif;?></td>
    </tr>
</table>

<table>
    <tr>
        <th>użytkownik</th>
        <th>karnety</th>
    </tr>
    <? foreach( $users as $user ): ?>
        <tr>
        <td><?=anchor('/admin_panel/user/'.$user->id, $user->name." ".$user->surname);?></td>
        <td>
            <ul>
            <? foreach( $user->plans as $plan ): ?>
                <li><?=$plan->diet?></li>
            <? endforeach; ?>
            </ul>
        </td>
        </tr>
    <? endforeach; ?>
</table>