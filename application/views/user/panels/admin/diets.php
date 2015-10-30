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
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row order my-account edit-order padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Plany dietetyczne</h1>
            <div class = "col-md-6 centered">
                <div class = "col-md-12 padding-bottom-30 border-bottom margin-bottom-10">
                    <div class = "row">
                        <?php foreach( $diets as $diet ): ?>
                        <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                            <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label"><?php echo $diet[0]->name?></div>
                                <?=anchor('/admin_panel/diet/'.$diet[0]->id, 'edytuj', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">nowa dieta</div>
                        <?=anchor('/admin_panel/diet/0', 'utwórz', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Home</div>
                        <?=anchor('/', 'strona główna', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Panel administracyjny</div>
                        <?=anchor('/admin_panel', 'cofnij', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "btn-back fluid-container margin-top-50 centered">
                        <?=anchor('/login/out', 'wyloguj', 'class ="btn btn-lg btn-show text-uppercase"');?>
                </div>
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>