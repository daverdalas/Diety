<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 13:46
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div style = "color: #58595b; font-family: Helvetica, sans-serif;">
	<h2>Dziękujemy za rejestrację!</h2>
	<p>Aby w pełni korzystać ze swojego konta kliknij w link aktywacyjny:</p> <p><b><?=anchor("/register/activate/$user_id/$token");?></b></p>
	</br>
	<h4><b>Udanych zakupów!</b></h4>
	<p>COO<b>KING</b></p>
</div>