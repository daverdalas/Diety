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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
    <?php
        $periods = array(
            'TESTOWA' => 1,
            '1 DZIEN' => 1,
            '1 TYDZIEN' => 7,
            '2 TYGODNIE' => 14,
            '3 TYGODNIE' => 21,
            '4 TYGODNIE' => 28,
        );
   /*     $energy = array(
            '1000',
            '1300',
            '1700',
            '2000',
        );*/
    ?>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row my-account padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Edycja planu</h1>
            <div class = "col-md-6 centered">
                <?=form_open("", "class = 'col-xs-12 margin-top-50 margin-bottom-50 form-horizontal text-left text-uppercase'");?>
                <div class = "col-sm-12 form-group about-user">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Nazwa diety</label>
                    <input type="hidden" class = "col-xs-12 col-sm-6 text-uppercase" name="name" value="<?=set_value('name', isset($name) ? $name : "");?>" <?=( isset($name) ? 'readonly' : '' );?>/>
                    <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="nname" value="<?=set_value('name', isset($name) ? $name : "");?>" /><?=form_error('nname');?>
                </div>
                <table class = "table table-bordered text-uppercase">
                    <tr>
                        <td></td>
                        <?php foreach ( $energy as $id=>$kcal ): ?>
                        <td>
                            <b><input type="text" name="energy[<?= $id; ?>]" value="<?=$kcal;?>"> KCAL</b>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php $p = 0; ?>
                   
                    <?php foreach ($periods as $period => $days ): ?>
                        <input type="hidden" name="period[<?=$p;?>]" value="<?=$period;?>"/>
                        <input type="hidden" name="days[<?=$p;?>]" value="<?=$days;?>"/>
                        <tr class = "border-top">
                            <td><b><?=$period;?></b></td>
                            <?php foreach ( $energy as $kcal ): ?>
                                <td>
                                    <?php
                                        if(
                                            isset($diet) &&
                                            array_key_exists($period,$diet) &&
                                            array_key_exists($kcal,$diet[$period])
                                        )
                                            $price = $diet[$period][$kcal]->price;
                                        else
                                            $price = 0;
                                    ?>
                                    <input <?php if( form_error("price[$p][$kcal]") ) echo 'class="error"';?> type="text" name="price[<?=$p;?>][]" value="<?=set_value("price[$p][$kcal]",$price);?>"/>
                                </td>
                            <?php  endforeach; ?>
                        </tr>
                        <?php $p++; ?>
                    <?php $p++; endforeach; ?>
                </table>
                <div class = "col-md-12 text-center">
                    <div class = "btn-back fluid-container margin-top-50 centered">
                        <?=form_submit("","zapisz dietę", "class = 'btn btn-lg btn-show text-uppercase'");?>
                    </div>
                </div>
                <?=form_close();?>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Home</div>
                        <?=anchor('/', 'strona główna', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Panel administracyjny</div>
                        <?=anchor('/admin_panel/diets', 'wróć', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "btn-back fluid-container margin-top-50 centered">
                        <?=anchor('/login/out', 'wyloguj', 'class = "btn btn-lg btn-show text-uppercase"');?>
                </div>
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>