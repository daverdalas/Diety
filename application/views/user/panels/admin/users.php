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
        a {
            display:block;
        }
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
    </style>
</head>
<body>
<?=anchor('/', 'home');?>
<?=anchor('/login/out', 'wyloguj');?>
<?=anchor('/admin_panel', 'panel admina');?>
<table>
    <tr>
        <th>użytkownik</th>
        <th>karnety</th>
    </tr>
    <? foreach( $users as $user ): ?>
        <td><?=anchor('/admin_panel/user/'.$user->id, $user->name." ".$user->surname);?></td>
        <td>
            <ul>
            <? foreach( $user->plans as $plan ): ?>
                <li><?=$plan->diet?></li>
            <? endforeach; ?>
            </ul>
        </td>
    <? endforeach; ?>
</table>
</body>
</html>