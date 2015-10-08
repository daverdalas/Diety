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
    <style>
        a {
            display:block;
        }
    </style>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>

        $(document).ready(
            function()
            {
                $('.date-pick').datepicker({
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(dateText, inst){
                        window.location= "<?=base_url();?>/index.php/admin_panel/shedule/"+dateText;
                    },
                });
            }
        );

    </script>
</head>
<body>
<?=anchor('/', 'home');?>
<?=anchor('/login/out', 'wyloguj');?>
<?=anchor('/admin_panel', 'panel admina');?>
<br><br>

<div class="date-pick"/></div>

</body>
</html>