<?php
	/*
	 * Created on 2010-04-10
	 *
	 * To change the template for this generated file go to
	 * Window - Preferences - PHPeclipse - PHP - Code Templates
	 */

    $config['protocol']  = 'smtp';
    $config['smtp_host'] = $_SERVER['___MAIL_HOST'];
    $config['smtp_user'] = $_SERVER['___MAIL_USER'];
    $config['smtp_pass'] = $_SERVER['___MAIL_PASS'];
    $config['smtp_port'] = $_SERVER['___MAIL_PORT'];
    $config['useragent'] = "Microsoft Outlook Express 6.00.2800.1409";
    $config['crlf'] 	= "\r\n";
    $config['newline'] 	= "\r\n";
    $config['mailtype']	= 'html';
    $config['smtp_timeout'] = '7';
    $config['charset']    = 'utf-8';
    $config['validation'] = TRUE; // bool whether to validate email or not
?>
