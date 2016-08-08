<?php

	require_once ('./ping/ping.class.php');
	
	$p = new ping();
	
	$p->ping('mail.ru',3);
	
	print_r($p->pingResult);
		
	