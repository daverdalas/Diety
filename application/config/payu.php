<?php
/**
 * Created by IntelliJ IDEA.
 * User: wizzard
 * Date: 01.10.15
 * Time: 11:06
 */

// POS ID (Checkout)
$config['PosId'] = $_SERVER['___PAYU_POSID'];

//Second MD5 key. You will find it in admin panel.
$config['SignatureKey'] = $_SERVER['___PAYU_SIG'];

$config['title'] = 'Zamówienie z cooking.pl';