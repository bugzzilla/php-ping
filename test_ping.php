<?php

	require_once ('./ping/ping.class.php');
	
	$p = new ping('localhost',1);
	
	$p->ping();
	
	print_r($p->pingResult);
		
	