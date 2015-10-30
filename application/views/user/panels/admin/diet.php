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
        input {
            display:block;
            width:50px;
        }
        input.error {
            border: 1px solid red;
        }
        label input {
            width:300px;
        }
        input[type=submit] {
            margin-top:10px;
            width:300px;
        }
        td {
            padding: 2px 10px;
        }
    </style>
    <?
        $periods = array(
            'TESTOWA' => 1,
            '1 DZIEN' => 1,
            '1 TYDZIEN' => 7,
            '2 TYGODNIE' => 14,
            '3 TYGODNIE' => 21,
            '4 TYGODNIE' => 28,
        );
        $energy = array(
            '500',
            '1000',
            '1500',
            '2000',
            '2500',
        );
    ?>
</head>
<body>
<?=anchor('/', 'home');?>
<?=anchor('/login/out', 'wyloguj');?>
<?=anchor('/admin_panel', 'panel admina');?>
<br><br>

<?=form_open();?>

<label>
    <input type="text" name="name" value="<?=set_value('name', isset($name) ? $name : "");?>" <?=( isset($name) ? 'readonly' : '' );?>/>
    <?=lang('diet_name');?><?=form_error('name');?>
</label>

<table>
    <tr>
        <td></td>
        <? foreach ( $energy as $kcal ): ?>
        <td>
            <?=$kcal;?> KCAL
        </td>
        <? endforeach; ?>
    </tr>
    <? $p = 0; ?>
    <? foreach ($periods as $period => $days ): ?>
        <input type="hidden" name="period[<?=$p;?>]" value="<?=$period;?>"/>
        <input type="hidden" name="days[<?=$p;?>]" value="<?=$days;?>"/>

        <tr>
            <td><?=$period;?></td>
            <? foreach ( $energy as $kcal ): ?>
                <td>
                    <?
                        if(
                            isset($diet) &&
                            array_key_exists($period,$diet) &&
                            array_key_exists($kcal,$diet[$period])
                        )
                            $price = $diet[$period][$kcal]->price;
                        else
                            $price = 0;
                    ?>
                    <input <? if( form_error("price[$p][$kcal]") ) echo 'class="error"';?> type="text" name="price[<?=$p;?>][<?=$kcal;?>]" value="<?=set_value("price[$p][$kcal]",$price);?>"/>
                </td>
            <? endforeach; ?>
        </tr>
        <? $p++; ?>
    <? endforeach; ?>
</table>
<?=form_submit("","dodaj dietę");?>

<?=form_close();?>
</body>
</html>