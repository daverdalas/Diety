<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <style>
        th{
            padding: 0 10px;
            text-align:left;
            color:white;
            background-color: black;;
        }
        td{
            padding: 0 10px;
            border-right: 1px solid black;
        }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
<body>

<div id="table"></div>
<?=anchor('/order', 'kontynuuj zakupy');?><br/>
<?=anchor('/order/pay', 'realizuj zamówienie');?>
</body>
</html>