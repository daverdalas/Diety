<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style>
        input {
            display:block;
            width:300px;
        }
        select {
            display:inline;
            width:120px;
        }
        input[type=checkbox] {
            display:inline;
            margin-top:10px;
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
        .weekends {
            display:none;
        }
    </style>

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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
<body>
<?=form_open();?>

<input type="hidden" name="id" value="<?=$order->id;?>"/>

<label><input type="text" name="name" value="<?=set_value('name',$order->name);?>"/>imie<?=form_error('name');?></label>
<label><input type="text" name="surname" value="<?=set_value('surname',$order->surname);?>"/>nazwisko<?=form_error('surname');?></label>
<label><input type="text" name="phone" value="<?=set_value('phone',$order->phone);?>"/>telefon<?=form_error('phone');?></label>
<label><input type="text" name="email" value="<?=set_value('email',$order->email);?>"/>email<?=form_error('email');?></label>

<label><input type="text" name="addy" value="<?=set_value('addy',$order->addy);?>"/>adres dostawy<?=form_error('addy');?></label>
<label>
    <div>
        Od: <select id="from" name="from" onchange="reindex_to()"></select>
        Do: <select id="to" name="to"></select>
    </div>
    godziny dostawy <?=form_error('from');?> <?=form_error('to');?>
</label>

<label>
    <input type="checkbox" name="weekends" id="weekends" <?=set_checkbox('weekends', 'on', $order->weekend == 1);?> onchange="toggleWeekend()"/>
    dieta z weekendami
</label>

<label class="weekends"><input type="text" name="addy2" value="<?=set_value('addy2', $order->addy_w );?>"/>adres<?=form_error('addy2');?></label>
<label class="weekends">
    <div>
        Od: <select id="from1" name="from1" onchange="reindex_to()"></select>
        Do: <select id="to1" name="to1"></select>
    </div>
    godziny dostawy weekendowej<?=form_error('from1');?> <?=form_error('to1');?>
</label>

<div id="banned_days"></div>
<div class="date-pick"/></div>

<?=form_submit("","kontynuuj");?>
<a href='#' onclick="window.history.back(); return false;">cancel</a>
<?=form_close();?>

</body>
</html>