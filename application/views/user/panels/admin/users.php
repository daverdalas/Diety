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
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
<body>
<?=anchor('/', 'home');?>
<?=anchor('/login/out', 'wyloguj');?>
<?=anchor('/admin_panel', 'panel admina');?>
<br><br>

<?=form_open();?>
<input type="text" id="name"/><input type="button" onclick="loadPageFiltered('name')" value="szukaj po imieniu"/><br>
<input type="text" id="diet"/><input type="button" onclick="loadPageFiltered('diet')" value="szukaj po diecie"/><br>
<input class="date-pick" type="text" id="deadline"/><input type="button" onclick="loadPageFiltered('deadline')" value="szukaj po dacie ważności karnetu"/><br>
<input class="date-pick" type="text" id="delivery"/><input type="button" onclick="loadPageFiltered('delivery')" value="szukaj po dacie dostawy"/><br>
<?=form_close();?>


<div id="table"></div>
</body>
</html>