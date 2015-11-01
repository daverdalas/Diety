<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 14:33
 */
/*
print_r($data);
print_r( $cart );
var_dump($data);
var_dump($cart);
*/
?>
<div style = "color: #58595b; font-family: Helvetica, sans-serif">
	<h2>Dziękujemy za Twoje zamówienie</h2>
	<p>Poniżej znajdują się jego szczegóły:</p>
	<table style = "color: #58595b;" class = "user">
		<caption style = "text-align: left; color: #58595b;">Dane zamawiającego:</caption>
		<tr>
			<th style = "text-align: left">Imię i nazwisko:</th>
			<td style = "padding-left: 2em"><?php echo $data->name ?> <?php echo $data->surname ?></td>
		</tr>
		<tr>
			<th style = "text-align: left">e-mail:</th>
			<td style = "padding-left: 2em"><?php echo $data->email ?></td>
		</tr>
		<tr>
			<th style = "text-align: left">nr tel.:</th>
			<td style = "padding-left: 2em"><?php echo $data->phone ?></td>
		</tr>
		<tr>
			<th style = "text-align: left">adres:</th>
			<td style = "padding-left: 2em"><?php echo $data->addy ?></td>
		</tr>
		<tr>
			<th style = "text-align: left">godziny dostawy:</th>
			<td style = "padding-left: 2em">od <?php echo $data->from ?> do <?php echo $data->to ?></td>
		</tr>
		<?php if(array_key_exists('company', $data)): ?>
			<th>Nazwa firmy:</th>
			<td><?php echo $data->company ?></td>
			<th>Adres firmy:</th>
			<td><?php echo $data->fvat ?></td>
			<th>NIP:</th>
			<td><?php echo $data->nip ?></td>
		<?php endif; ?>
		<?php if(array_key_exists('addy_w', $data)): ?>
		<tr>
			<th>adres weekendowy:</th>
			<td><?php echo $data->addy_w ?></td>
		</tr>
		<?php endif; ?>
		<?php if(array_key_exists('from_w', $data)): ?>
			<th>godziny dostawy w weekend:</th>
			<td>od <?php echo $data->from_w ?> do <?php echo $data->to_w ?></td>
		<?php endif; ?>
	</table>
	</br>
	<table style = "color: #58595b; margin-top: 30px;" class = "order">
		<thead>
			<tr style = "background-color: #58595b; color: #fff; line-height:2em;">
				<th style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;">Nazwa zamówienia</th>
				<th style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;">Ilość</th>
				<th style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;">Początek diety</th>
				<th style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;">Koniec diety</th>
				<th style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;">Cena jednostkowa</th>
				<th style = "border-bottom: dashed 1px #58595b; padding-left: 1em; padding-right: 1em; text-align:right">Koszt</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $cart['cart'] as $order ): ?>
			<tr style = "line-height:2em;">
				<td style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;"><?php echo $order->label;?></td>
				<td style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;"><?php echo $order->quantity; ?></td>
				<td style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;"><?php echo $order->begin; ?></td>
				<td style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;"><?php echo $order->end; ?></td>
				<td style = "border-bottom: dashed 1px #58595b; text-align: left; padding-left: 1em; padding-right: 1em;"><?php echo $order->unitprice; ?></td>
				<td style = "border-bottom: dashed 1px #58595b; padding-left: 1em; padding-right: 1em; text-align:right"><?php echo $order->cost ?></td>
			</tr>
			<?php endforeach; ?>
			<tr class = "all" style = "line-height:2em;">
				<th style = "text-align: left" colspan = '4'>Całkowity koszt zamówienia</th>
				<td colspan = '2' style = "text-align: right;"><h2 style = "margin: 0;"><?php echo $cart['cost'] ?> PLN</h2></td> 
			</tr>
		</tbody>
	</table>
	</br>
	<table class = "user">
		<?php if(array_key_exists('comment', $data)): ?>
			<th style = "text-align: left">Dodatkowe uwagi:</th>
			<td style = "padding-left: 2em"><?php echo $data->comment;?><td>
		<?php endif ?>
	</table>
	<p style = "margin-top:20px;">Jeśli jeszcze nie opłaciłeś swojego zamówienia, możesz to zrobić teraz klikając w link: <?=anchor("/order/process/$order_id");?></p>
	</br>
	<h3 style = "margin-top:20px;"><b>Smacznego!</b></h3>
	<p><i>COOKING</i></p>
</div>
