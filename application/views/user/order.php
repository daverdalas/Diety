<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <style>
        input {
            display:block;
            width:300px;
        }
        select {
            display:block;
            width:300px;
        }
        input[type=checkbox] {
            display:inline;
            width:10px;
        }
        input[type=submit] {
            margin-top:10px;
        }
        label {
            display:block;
            font-size: small;
            width:300px;
        }
        label p {
            padding-left:20px;
            display:inline;
            color:red;
            font-size: smaller;
        }
        .ui-datepicker {
            background: #fff;
            border: 1px solid #555;
        }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        var diets = [];
        <? foreach( $diets as $n => $d ): ?>
            diets['<?=$n;?>'] = [];
            <? foreach( $d as $diet ): ?>
            diets['<?=$n;?>']['<?=$diet->calories;?>'] = <?=$diet->id;?>;
            <? endforeach; ?>
        <? endforeach; ?>
        var prices = [];
        var price_list = [];
        <? foreach( $prices as $n => $p ): ?>
            prices['<?=$n;?>'] = [];
            <? foreach( $p as $price ): ?>
            prices['<?=$n;?>']['<?=$price->name;?>'] = <?=$price->id;?>;
            price_list[ <?=$price->id;?> ] = <?=$price->price;?>;
            <? endforeach; ?>
        <? endforeach; ?>

        function load_diet( )
        {
            var d = diets[$('#diet').val()];
            $('#calories').html('');
            for( n in d)
                $('#calories')
                    .append(
                        $('<option>', { value : d[n] }).text(n+" KCAL")
                );

            if( defaults.calories != "" )
            {
                $('#calories').val(defaults.calories);
                defaults.calories = "";
            }

            load_calories();
        }

        function load_calories(  )
        {
            var d = prices[$('#calories').val()];

            $('#time').html('');
            for( n in d) {
                $('#time')
                    .append(
                    $('<option>', {value: d[n]}).text(n)
                );
            }
            if( defaults.time != "" )
            {
                $('#time').val(defaults.time);
                defaults.time = "";
            }
            set_price();
        }

        function set_price( )
        {
            $('#id').val( $('#time').val() );
            set_num();
        }
        function set_num( )
        {
            var price = price_list[ $('#time').val() ];
            var n = $('#number').val();
            $('#price').html( n*price/100+" PLN" );
        }

        var defaults = {
            diet: "<?=set_value('diet',null );?>",
            calories: "<?=set_value('calories',null );?>",
            time: "<?=set_value('id',null );?>"
        };

        $(document).ready(
            function(){
                $('#diet').html('');
                for( n in diets )
                    $('#diet')
                        .append(
                        $('<option>', { value : n }).text(n)
                    );
                if( defaults.diet != "" ) $('#diet').val(defaults.diet);
                load_diet();
                var dateToday = new Date();
                $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd', minDate: dateToday });
            } );
    </script>
</head>
<body>

<?=form_open();?>

<label>
    <select id="diet" name="diet" onchange="load_diet();">
    </select>
    rodzaj diety<?=form_error('id');?>
</label>

<label>
    <select id="calories" name="calories" onchange="load_calories();">
    </select>
    kaloryczność<?=form_error('id');?>
</label>

<label>
    <select id="time" name="time" onchange="set_price();">
    </select>
    okres diety<?=form_error('id');?>
</label>

<label>
    <input type="number" id="number" name="number" min="1" onchange="set_num();" value="<?=set_value('number',1 );?>"/>
    <input type="hidden" id="id" name="id" value="<?=set_value('id' );?>"/>
    liczba zestawów<?=form_error('number');?>
</label>

<label>
    <input type="text" name="date" id="date" value="<?=set_value('date', ( new DateTime() )->format("Y-m-d") );?>"/>
    data rozpoczęcia<?=form_error('date');?>
</label>

<label>
    <input type="checkbox" name="weekends" <?=set_checkbox('weekends', 'on', true);?> />
    dieta z weekendami
</label>

<h3 id="price"></h3>

<?=form_submit("","Zamów");?>
<?=anchor('/', 'cancel');?>
<?=form_close();?>
</body>
</html>