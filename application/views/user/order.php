<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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

        function toggleWeekend()
        {
            if( $('#weekends').is(':checked') )
            {
                checkWeekend = weekendOn;
            }
            else
            {
                checkWeekend = weekendOff;
            }
            $('.date-pick').datepicker( "refresh" );
        }
        var checkWeekend = function(){};
        function weekendOff(date)
        {
            return date.getDay() == 6 || date.getDay() == 0;
        }
        function weekendOn(date)
        {
            return false;
        }
        var serverDate = new Date(<?=time();?>*1000);
        var deadline = new Date(serverDate);
        deadline.setDate(serverDate.getDate()+( serverDate.getHours() >= 14 ? 2 : 1 ));
        deadline.setHours(0);
        deadline.setMinutes(0);
        deadline.setSeconds(0);
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
                $( "#date" ).datepicker({
                    beforeShowDay: $.datepicker.noWeekends,
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: function(date){
                        if( checkWeekend(date) ) return [false, ""];
                        if( date<deadline ) return [false, ""];
                        return [true, ""];
                    }
                });
            } );
    </script>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row order padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">Zamów</h1>
            <div class = "col-md-6 centered">
                <?=form_open("", "class = 'col-xs-12 margin-top-50 no-padding margin-bottom-100 form-horizontal text-center'");?>
                    <div class = "form-group text-uppercase text-left">
                        <label class = "col-xs-12 col-sm-6 border-top border-bottom">wybierz rodzaj diety</label>
                        <select id="diet" name="diet" onchange="load_diet();" class = "col-xs-12 col-sm-6 text-uppercase">
                        </select><label class = "error"><?=form_error('id');?></label>
                    </div>
                    <div class = "form-group text-uppercase text-left">
                        <label class = "col-xs-12 col-sm-6 border-top border-bottom">Kaloryczność</label>
                        <select id="calories" name="calories" onchange="load_calories();" class = "col-xs-12 col-sm-6 text-uppercase">
                        </select><label class = "error"><?=form_error('id');?></label>
                    </div>
                    <div class = "form-group text-uppercase text-left">
                        <label class = "col-xs-12 col-sm-6 border-top border-bottom">wybierz okres diety</label>
                        <select id="time" name="time" onchange="set_price();" class = "col-xs-12 col-sm-6 text-uppercase">
                        </select><label class = "error"><?=form_error('id');?></label>
                    </div>
                    <div class = "form-group text-uppercase text-left">
                        <label class = "col-xs-12 col-sm-6 border-top border-bottom">data rozpoczęcia diety</label>
                        <?php
                        $now = new DateTime();
                        $hour = $now->format('G');
                        $now->setTime( 0,0 );
                        $now->modify( "+".( $hour > 14 ? 2 : 1 )." day" );
                        $deadline = $now->format("Y-m-d")
                        ?>
                        <input type="text" name="date" id="date" value="<?=set_value('date', $deadline );?>" class = "col-xs-8 col-sm-6 text-uppercase"/><label class = "error"><?=form_error('date');?></label>
                    </div>
                    <div class = "form-group text-uppercase text-left">
                        <label class = "col-xs-12 col-sm-6 border-top border-bottom">ilość zestawów</label>
                        <input type="number" id="number" name="number" min="1" onchange="set_num();" value="<?=set_value('number',1 );?>" class = "col-xs-12 col-sm-6 text-uppercase"/>
                        <input type="hidden" id="id" name="id" value="<?=set_value('id' );?>"/><label class = "error"><?=form_error('number');?></label>
                    </div>
                    <div class = "form-group text-uppercase text-left">
                        <div class = "checkbox centered text-left">
                            <label class = "col-xs-12 col-sm-6 border-top border-bottom">Dieta z weekendami</label>
                            <input type = "checkbox" checked required = "true" name = "rules">
                            <label class = "plusweekends"><span></span> 
                            </label>
                        </div>
                    </div>
                    <div class = "form-group text-uppercase text-left margin-top-20">
                        <label class = "col-xs-12 col-sm-6 border-top border-bottom">cena</label>
                        <h3 id="price" class = "col-xs-12 col-sm-6 text-uppercase"></h3>
                    </div>
                    <div class = "btn-back fluid-container centered margin-top-50">
                        <?=form_submit("","Zamów", "class = 'btn btn-lg btn-show text-uppercase'");?>
                    </div>
                    <h4><?=anchor('/', 'anuluj', "class = 'cancel'");?></h4>
                <?=form_close();?>
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>