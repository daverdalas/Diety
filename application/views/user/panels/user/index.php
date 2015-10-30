<?php
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
    <section class = "row my-account padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Panel klienta</h1>
            <div class = "col-xs-12 col-md-5 margin-top-50 centered">
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Edycja konta</div>
                        <?=anchor('/user_panel/edit_user', 'edytuj', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Historia zamówień</div>
                        <?=anchor('/user_panel/history', 'zobacz', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Zamów online</div>
                        <?=anchor('/order', 'zamów online', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">wróć</div>
                        <?=anchor('/', 'panel główny', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "btn-back fluid-container margin-top-50 centered">
                        <?=anchor('/login/out', 'wyloguj', 'class ="btn btn-lg btn-show text-uppercase"');?>
                </div>
                <!--<div class = "col-md-12 no-padding">
                    <div class = "col-sm-12 order-list">
                        <h2 class = "text-uppercase margin-bottom-30 col-md-12">historia zamówień</h2>
                        <? foreach( $orders as $order ): ?>
                            <ul class = "list-unstyled col-xs-12 col-sm-6 col-md-4 text-center margin-top-20">
                                <li><u><b><?=$order->diet;?></b></u></li>
                                <li>pozostało <?=$order->days_left;?> z <?=$order->days_total;?> dostaw</li>
                                <li><b>najbliższa dostawa:</b></li>
                                <li><?=$calendars[$order->id][0]->day;?><li>
                                <li>od <?=$calendars[$order->id][0]->from;?>:00
                                    do <?=$calendars[$order->id][0]->to;?>:00
                                </li>
                                <li><b>ostatnia dostawa</b></li>
                                <li><? $c = count($calendars[$order->id])-1; ?></li>
                                <li><?=$calendars[$order->id][$c]->day;?>
                                    od <?=$calendars[$order->id][$c]->from;?>:00
                                    do <?=$calendars[$order->id][$c]->to;?>:00
                                </li>
                                <li><?=$order->name;?> <?=$order->surname;?></li>
                                <li><?=$calendars[$order->id][0]->addy;?></li>
                                <li class = "text-uppercase"><b><u><?=anchor('/user_panel/edit/'.$order->id, 'edytuj');?></u></b></li>
                            </ul>
                        <? endforeach; ?>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?></body>
</html>