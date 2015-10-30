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
    <section class = "row my-account padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase margin-bottom-30"><?=$user->name;?> <?=$user->surname;?></h1>
            <h4><?=$user->email;?></h4>
            <h4><?=$user->phone;?></h4>
            <div class = "col-xs-12 col-md-5 centered">
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Dane użytkownika</div>
                        <?=anchor('/user_panel/edit_user/'.$user->id, 'edytuj', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">wróć</div>
                        <?=anchor('/admin_panel', 'panel admina', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user margin-bottom-50">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Powrót</div>
                        <?=anchor('/admin_panel/users', 'lista klientów', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?><br>
                </div>
            </div>
            <div class = "col-sm-12 col-md-6 col-md-offset-3 order-list">
                <h2 class = "text-uppercase margin-bottom-30 col-md-12">historia zamówień</h2>
                <? foreach( $plans as $order ): ?>
                    <ul class = "list-unstyled col-xs-12 col-sm-6 col-md-4 text-center margin-top-20">
                        <li><u><b><?=$order->diet;?></b></u></li>
                        <li>pozostało <?=$order->days_left;?> z <?=$order->days_total;?> dostaw</li>
                        <? if( array_key_exists( $order->id, $calendars ) && count($calendars[$order->id]) ): ?>
                        <li>najbliższa dostawa:<?=$calendars[$order->id][0]->day;?></li>
                        <li>
                            <?=$calendars[$order->id][0]->addy;?>
                            od <?=$calendars[$order->id][0]->from;?>:00
                            do <?=$calendars[$order->id][0]->to;?>:00
                        </li>
                        <? endif; ?>
                        <li>
                            <? if( $order->invoice && $order->order->company != null): ?>
                            <ul class = "list-unstyled">
                                <li><b>dane do faktury:</b></li>
                                <li>nazwa firmy:<?=$order->order->company;?></li>
                                <li>nip:<?=$order->order->nip;?></li>
                                <li>adres faktury:<?=$order->order->fvat;?></li>
                                <li><b><?=anchor("/order/invoice/".$order->invoice->id, "pobierz fakturę");?></b></li>
                            </ul>
                            <? endif; ?>
                        </li>

                        <? if( array_key_exists( $order->id, $calendars ) && count($calendars[$order->id]) ): ?>
                        <li><b>kalendarz dostaw:</b></li>
                        <? foreach( $calendars[$order->id] as $delivery ): ?>
                            <li <? if($delivery->weekend) echo "class='weekend'"; ?>>
                                <?=$delivery->day;?>
                                od <?=$delivery->from;?>:00
                                do <?=$delivery->to;?>:00
                                <?=$delivery->addy;?>
                            </li>
                        <? endforeach; ?>
                        <? endif; ?>
                        <li><u><b><?=anchor("/order/delete/".$order->id, "usuń zamówienie", array('class'=>'delete text-uppercase', 'onclick'=>"return ConfirmDelete();"));?></b></u></li>
                    </ul>
                <? endforeach; ?>
            </div>
            <div class = "col-sm-12 col-md-6 col-md-offset-3 text-uppercase">
                <h2 class = "text-uppercase margin-bottom-30">historia płatności</h2>
                <table class = "table table-payed table-striped">
                <? foreach( $orders as $order ): ?>
                    <? if( $order->payment != null ): ?>
                    <tr>
                        <td class = "text-left"><?=$order->timestamp;?></td>
                        <td><?php if ($order->status === 'COMPLETED') { echo "opłacone" ;} else { echo "nieopłacone"; }  ?></td>
                        <th class = "text-right"><?=anchor("/admin_panel/payment_status/".$order->payment, "szczegóły");?></th>
                    </tr>
                    <? endif; ?>
                <? endforeach; ?>
                </table>
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
    <script type="text/javascript">
        function ConfirmDelete() {
            var x=confirm("Czy na pewno chcesz usunąć zamówienie? Tej operacji nie będziesz mógł cofnąć.")
            if (x) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>
</html>