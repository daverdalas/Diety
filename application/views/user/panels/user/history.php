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
    <title>COOKING</title>
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href=<?php echo base_url()."/media/css/bootstrap.min.css" ?>>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url()."/media/css/bootstrap-theme.min.css"?>>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url()."/media/css/style.css"?>>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/jquery-1.11.3.min.js"?>></script>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/bootstrap.min.js"?>?>?>></script>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/enscroll.min.js"?>?>></script>
    <script type="text/javascript" src=<?php echo base_url()."/media/js/jquery-ui.js"?>></script>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row history my-account">
        <div class = "col-md-12 margin-top-30 text-center">
            <h1 class = "text-uppercase">Historia zamówień</h1>
            <div class = "col-xs-12 col-sm-11 margin-top-10 margin-bottom-50 centered">
                <div class = "col-xs-12 col-md-7 price-lists centered">
                    <div class = "col-xs-12 no-padding">
                        <table class = "table table-dashed margin-top-50 margin-bottom-50 text-left">
                            <thead class = "text-uppercase">
                                <tr>
                                    <th>zamówienie</th>
                                    <th>dieta</th>
                                    <th>dostawa</th>
                                    <th>dostawa weekend</th>
                                    <th>opcje</th>
                                </tr>
                            </thead>
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
                                            <li class = "paid"><b><?=( $diet->status == 'W' ? anchor("/order/process/".$order->data->id, "opłać", 'class = "non-paid"') : "opłacone" );?></b></li>
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
                                                    if( $order->data->invoice != 0 && $order->data->company != null) echo anchor("/order/invoice/".$order->data->invoice, "pobierz fakturę");
                                                ?>
                                            </li>
                                            <li class = "comment"><i><?=$order->data->comment;?></i></li>
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
                                                        case 'A': echo '<p class = "current"><b>aktualna</b></p>'; break;
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
            </div>
            <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">wróć</div>
                    <?=anchor('/user_panel', 'moje konto', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>