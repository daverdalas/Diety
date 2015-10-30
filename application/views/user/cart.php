<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
    <script>
        var mods = {};

        function remove(id)
        {
            $.ajax({
                url: "remove_from_cart/"+id
            }).done(function( data ) {
                $('#table').html(data);
                mods = {};
            });
            return false;
        }

        function reload()
        {
            $.ajax({
                url: "get_cart/"
            }).done(function( data ) {
                $('#table').html(data);
                mods = {};
            });
        }

        function modify( id, c )
        {
            var n = parseInt($('#i'+id).html())+c;
            if( n<0 ) n=0;
            $('#i'+id).html( n );
            mods[id]=n;
            return false;
        }

        function recalc( )
        {

            $.ajax({
                type:'POST',
                url: "modify_cart/",
                data:mods
            }).done(function( data ) {
                $('#table').html(data);
            });
            mods = {};
            return false;
        }

        $(document).ready(reload);
    </script>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row history padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Koszyk</h1>
            <div class = "col-xs-12 col-md-5 margin-top-50 centered">
    <div id="table"></div>
    <div class = "btn-back fluid-container margin-top-50 pull-left">
        <?=anchor('/order', 'kontynuuj zakupy', "class = 'btn btn-lg btn-show text-uppercase'");?>
    </div>
    <div class = "btn-back fluid-container margin-top-50 pull-right">
        <?=anchor('/order/addy', 'realizuj zamówienie', "class = 'btn btn-lg btn-show text-uppercase'");?>
    </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>