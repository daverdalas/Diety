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
</head>
<body class = "body-app">
    <?php include('application/views/header.php'); ?>
    <div class = "row gray margin-top-30">
        <hr>
    </div>
    <section class = "row my-account padding-bottom-30">
        <div class = "col-md-12 margin-top-30 text-center padding-bottom-30">
            <h2 class = "text-uppercase margin-bottom-30">Szczegóły płatności</h2>
            <div class = "col-xs-12 col-md-5 centered">
            	<table class = "table text-left">
            		<tbody>
            				<caption>Informacje o zamówieniu</caption>
	            			<tr>
	            				<th class = "col-md-6">Numer zamówienia:</th>
	            				<td class = "col-md-6"><?php echo $order[0]->orderId ?></td>
	            			</tr>
	            			<tr>
	            				<th>Data zamówienia:</th>
	            				<td><?php echo $order[0]->orderCreateDate ?></td>
	            			</tr>
	            			<tr>
	            				<th>Całkowity koszt zamówienia:</th>
	            				<td><?php echo $order[0]->totalAmount/100, " " ,  $order[0]->currencyCode  ?></td>
	            			</tr>
                            <tr>
                                <th>Status płatności:</th>
                                <td><?php if ($order[0]->status === 'COMPLETED') { echo "opłacone" ;} else { echo "nieopłacone"; }  ?></td>
                            </tr>
                            <?php if ($order[0]->status === 'COMPLETED'): ?>
                            <th>Zamówienie:</th>
                            <td>
                                <ul class = "list-unstyled">
                                <?php foreach ($order[0]->products as $products): ?>
                                    <li class = "margin-bottom-10">
                                        <ul class = "list-unstyled">
                                            <li><b><?php echo $products->name ?></b></li>
                                            <li>ilość: <?php echo $products->quantity ?></li>
                                            <li>cena jednostkowa: <?php echo $products->unitPrice/100 ?> PLN</li>
                                        </ul>
                                    </li>

                                <?php endforeach; ?>
                                </ul>
                            </td>
                            <?php endif ?>
            		</tbody>
            	</table>
                <?php if ($order[0]->status === 'COMPLETED'): ?>
            	<table class = "table text-left">
            		<tbody>
            				<caption>Dane zamawiającego</caption>
            		</tbody>
            		<tr>
	            		<th class = "col-md-6">Imię i nazwisko:</th>
	            		<td class = "col-md-6"><?php echo $order[0]->buyer->firstName, " ",  $order[0]->buyer->lastName ?></td>
	       			</tr>
	       			<tr>
	            		<th class = "col-md-6">Email:</th>
	            		<td class = "col-md-6"><?php echo $order[0]->buyer->email ?></td>
	       			</tr>
                    <tr>
                        <th class = "col-md-6">Numer telefonu:</th>
                        <td class = "col-md-6"><?php echo $order[0]->buyer->phone ?></td>
                    </tr>
            	</table>
                <?php endif ?>
            </div>
        </div>
    </section>
    <?php include('application/views/footer.php'); ?>
</body>
</html>


