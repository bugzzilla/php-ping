<?php

	require_once ('./ping/ping.class.php');
	
	$p = new ping();
	
	$p->ping('mail.ru',1);
	
	var_dump($p->pingResult);
		
	