<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
    <style>
        .weekends {
            display:none;
        }
    </style>

    <script>

        var dates = new Array();

        function addOrRemoveDate(date) {
            var index = jQuery.inArray(date, dates);
            if (index >= 0)
                dates.splice(index, 1);
            else
            if (jQuery.inArray(date, dates) < 0)
                dates.push(date);

            $('#banned_days').html('');
            for( var i in dates )
            {
                $('#banned_days').append(
                $(
                    '<input>',
                    {
                        value : dates[i],
                        type:'hidden',
                        name:'banned['+i+']'
                    }
                )
                );
            }
        }

        function toggleWeekend()
        {
            if( $('#weekends').is(':checked') )
            {
                $('.weekends').show();
                checkWeekend = weekendOn;
            }
            else
            {
                $('.weekends').hide();
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
            function()
            {
                $('#from').html('');
                for( f=6; f<10; f++ )
                    $('#from').append( $('<option>', { value : f }).text(f+":00") );

                $('#from1').html('');
                for( f=6; f<10; f++ )
                    $('#from1').append( $('<option>', { value : f }).text(f+":00") );

                reindex_to();

                $('#from').val( <?=$order->time_from;?> );
                $('#from1').val( <?=$order->time_from_w;?> );
                $('#to').val( <?=$order->time_to;?> );
                $('#to1').val( <?=$order->time_to_w;?> );

                $('.date-pick').datepicker({
                    beforeShowDay: $.datepicker.noWeekends,
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(dateText, inst){
                        addOrRemoveDate(dateText);
                    },
                    beforeShowDay: function(date){
                        var gotDate = $.inArray(
                            $.datepicker.formatDate($(this).datepicker('option', 'dateFormat'), date),
                            dates
                        );
                        if( checkWeekend(date) ) return [false, ""];
                        if( date<deadline ) return [false, ""];
                        if ( gotDate >= 0 ) {
                            return [true,"ui-state-disabled", "Event Name"];
                        }
                        return [true, ""];
                    }
                });

                <? foreach( $order->banned as $d ): ?>
                var d = new Date('<?=$d->timestamp;?>');
                dates.push( $.datepicker.formatDate($('.date-pick').datepicker('option', 'dateFormat'), d) );
                <? endforeach; ?>

                $('#banned_days').html('');
                for( var i in dates )
                {
                    $('#banned_days').append(
                        $(
                            '<input>',
                            {
                                value : dates[i],
                                type:'hidden',
                                name:'banned['+i+']'
                            }
                        )
                    );
                }

                toggleWeekend();
            }
        );

        function reindex_to( )
        {
            $('#to').html('');
            for( f=parseInt($('#from').val())+1; f<11; f++ )
                $('#to').append( $('<option>', { value : f }).text(f+":00") );

            $('#to1').html('');
            for( f=parseInt($('#from1').val())+1; f<11; f++ )
                $('#to1').append( $('<option>', { value : f }).text(f+":00") );
        }
    </script>
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row order edit-order padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h1 class = "text-uppercase">edycja zamówienia</h1> 
            <div class = "col-md-5 centered"> 
            <?=form_open("", "class = 'col-xs-12 margin-top-50 margin-bottom-100 form-horizontal text-left text-uppercase no-padding'");?>

            <input type="hidden" name="id" value="<?=$order->id;?>"/>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Imię</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="name" value="<?=set_value('name',$order->name);?>"/><label class = "error"><?=form_error('name');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Nazwisko</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="surname" value="<?=set_value('surname',$order->surname);?>"/><label class = "error"><?=form_error('surname');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">numer tel.</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="phone" value="<?=set_value('phone',$order->phone);?>"/><label class = "error"><?=form_error('phone');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Email</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="email" value="<?=set_value('email',$order->email);?>"/><label class = "error"><?=form_error('email');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">adres dostawy</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="addy" value="<?=set_value('addy',$order->addy);?>"/><label class = "error"><?=form_error('addy');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">godziny dostawy</label>
                <div class = "col-xs-12 col-sm-6 text-uppercase hours">Od: <select id="from" name="from" onchange="reindex_to()"></select>Do: <select id="to" name="to"></select><label class = "error"><?=form_error('from');?> <?=form_error('to');?></label></div>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <div class = "checkbox centered text-left no-padding">
                    <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">Dieta z weekendami</label>
                   <input type="checkbox" name="weekends" id="weekends" <?=set_checkbox('weekends', 'on', $order->weekend == 1);?> onchange="toggleWeekend()"/>
                    <label class = "plusweekends"><span></span> 
                    </label>
                </div>
            </div>
            <div class = "col-sm-12 form-group about-user weekends">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">adres weekendowy</label>
                <input type="text" class = "col-xs-12 col-sm-6 text-uppercase" name="addy2" value="<?=set_value('addy2', $order->addy_w );?>"/><label class = "error"><?=form_error('addy2');?></label>
            </div>
            <div class = "col-sm-12 form-group about-user weekends">
                <label class = "col-xs-12 col-sm-6 border-top border-bottom no-padding">godziny dostawy</label>
                <div class = "col-xs-12 col-sm-6 text-uppercase hours">Od: <select id="from1" name="from1" onchange="reindex_to()"></select>Do: <select id="to1" name="to1"></select><label class = "error"><?=form_error('from1');?> <?=form_error('to1');?></label></div>
            </div>
            <div class = "col-sm-12 form-group about-user">
                <h3 class = "col-xs-12 text-uppercase text-center">Zaznacz dni, w których nie chcesz otrzymać dostawy.</h3>
                <p class = "col-xs-12 text-center margin-top-20"><b>Rezygnacja z dnia następnego możliwa jest do godziny 14:00 dnia poprzedzającego dostawę.</b></p>
                <div class = "col-sm-12" id="banned_days"></div>
                <div class = "col-xs-12 margin-top-30 no-padding">
                    <div class="date-pick centered">
                    </div>
                </div>
            </div>
            <div class = "col-xs-12 text-center">
                <div class = "btn-back fluid-container margin-top-50">
                    <?=form_submit("","kontynuuj", "class = 'btn btn-lg btn-show text-uppercase'");?>
                </div>
                <h4><a href="" class = 'cancel text-lowercase' onclick="window.history.back();">anuluj</a></h4>
            </div>
            <?=form_close();?>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>