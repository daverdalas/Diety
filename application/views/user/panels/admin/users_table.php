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
    <?php foreach( $users as $user ): ?>
        <tr>
        <td><u><?=anchor('/admin_panel/user/'.$user->id, $user->name." ".$user->surname);?></u></td>
        <td>
            <ul class="list-unstyled text-left">
            <?php foreach( $user->plans as $plan ): ?>
                <li><?=$plan->diet?></li>
            <?php endforeach; ?>
            </ul>
        </td>
        </tr>
    <?php endforeach; ?>
</table>
<table class = "table">
    <tr>
        <td><?php if($prev >= 0):?><a href="#" onclick="loadPage(<?=$prev;?>)"><< WSTECZ</a><?php endif;?></td>
        <td><?=$page;?></td>
        <td><?php if($next > 0):?><a href="#" onclick="loadPage(<?=$next;?>)">DALEJ >></a><?php endif;?></td>
    </tr>
</table>