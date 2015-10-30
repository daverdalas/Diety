<?php

/**

 * Created by IntelliJ IDEA.

 * User: wizzard

 * Date: 01.10.15

 * Time: 14:33

 */

?>
<div style = "color: #58595b; font-family: Helvetica, sans-serif">
<h2>Plan Twojej diety został zmieniony</h2>
<table class = "user">
	<caption style = "text-align:left;">Dane zamawiającego:</caption>
	<tr>
		<th style = "text-align:left;">Imię i nazwisko:</th>
		<td style = "padding-left: 2em;"><?php echo $plan['name'] ?> <?php echo $plan['surname'] ?></td>
	</tr>
	<tr>
		<th style = "text-align:left;">e-mail:</th>
		<td style = "padding-left: 2em;"><?php echo $plan['email'] ?></td>
	</tr>
	<tr>
		<th style = "text-align:left;">nr tel.:</th>
		<td style = "padding-left: 2em;"><?php echo $plan['phone'] ?></td>
	</tr>
	<tr>
		<th style = "text-align:left;">adres:</th>
		<td style = "padding-left: 2em;"><?php echo $plan['addy'] ?></td>
	</tr>
	<tr>
		<th style = "text-align:left;">godziny dostawy:</th>
		<td style = "padding-left: 2em;">od <?php echo $plan['from'] ?> do <?php echo $plan['to'] ?></td>
	</tr>
	<?php if(array_key_exists('banned', $plan)): ?>
		<th style = "text-align:left;">Pomiń dni:</th>
		<td style = "padding-left: 2em;">
		<?php foreach( $plan['banned'] as $banned ): ?>
				<span><?php echo $banned ?>,</span>
			<?php endforeach ?>
		</td>
	<?php endif; ?>
	<?php if(array_key_exists('addy2', $plan)): ?>
	<tr>
		<th style = "text-align:left;">Adres weekendowy:</th>
		<td style = "padding-left: 2em;"><?php echo $plan['addy2'] ?></td>
	</tr>
	<?php endif; ?>
	<?php if(array_key_exists('from2', $plan)): ?>
		<th style = "text-align:left;">Godziny dostawy w weekend:</th>
		<td style = "padding-left: 2em;">od <?php echo $plan['from2'] ?> do <?php echo $plan['to2'] ?></td>
	<?php endif; ?>
</table>
<p>By edytować zamówienie kliknij e link: <?=anchor("/user_panel/edit/".$plan['id']);?></p>
</div>