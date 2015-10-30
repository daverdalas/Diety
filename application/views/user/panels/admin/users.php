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
    <script>
        var page = 0;
        var filter = null;
        var value = null;
        var c = [ 'name','diet','deadline','delivery'];

        function loadPage(p)
        {
            page = p;
            reload();
            return false;
        }
        function loadPageFiltered(f)
        {
            page = 0;
            filter = f;
            value = $('#'+f).val();
            for( n in c ) if( c[n] != f ) $('#'+c[n]).val('');
            reload();
            return false;
        }
        function reload()
        {
            $.ajax({
                type:'POST',
                data:{
                    filter:filter,
                    value:value
                },
                url: "users_table/"+page
            }).done(function( data ) {
                $('#table').html(data);
                mods = {};
            });

            $('.date-pick').datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function(dateText, inst){
                    loadPageFiltered(inst.id);
                }
            });
        }
        $(document).ready(reload);
    </script>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row my-account padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Lista klientów</h1>
            <div class = "col-xs-12 col-md-8 col-md-offset-2 search margin-top-50 margin-bottom-50">
                <?=form_open();?>
                <div class = "form-group col-md-3 col-xs-12">
                    <input type="text" id="name" placeholder = "nazwisko:" class = "text-uppercase"/>
                    <input type="button" onclick="loadPageFiltered('name')" value="filtruj" class = "btn btn-search"/><br>
                </div>
                <div class = "form-group col-md-3 col-xs-12">
                    <input type="text" id="diet" placeholder = "Nazwa diety:" class = "text-uppercase"/>
                    <input type="button" onclick="loadPageFiltered('diet')" value="filtruj" class = "btn btn-search"/><br>
                </div>
                <div class = "form-group col-md-3 col-xs-12">
                    <input class="date-pick text-uppercase" type="text" id="deadline" placeholder="ważność karnetu:"/>
                    <input type="button" onclick="loadPageFiltered('deadline')" value="filtruj" class = "btn btn-search"/><br>
                </div>
                <div class = "form-group col-md-3 col-xs-12">
                    <input class="date-pick text-uppercase" type="text" id="delivery" placeholder = "data dostawy:"/>
                    <input type="button" onclick="loadPageFiltered('delivery')" value="filtruj" class = "btn btn-search"/><br>
                </div>
                <?=form_close();?>
            </div>    
            <div class = "col-xs-12 col-md-6 col-md-offset-3">
                <div id="table"></div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">Home</div>
                        <?=anchor('/', 'panel główny', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
                </div>
                <div class = "col-sm-12 no-padding text-uppercase text-left about-user">
                    <div class = "col-xs-12 col-sm-6 border-top border-bottom no-padding about-user-label">wróć</div>
                        <?=anchor('/admin_panel', 'panel admina', 'class = "btn-account col-xs-12 col-sm-6 text-uppercase text-left"');?>
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