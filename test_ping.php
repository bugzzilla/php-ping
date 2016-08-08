<?php

	require_once ('./ping/ping.class.php');
	
	$p = new ping();
	
	$p->ping('localhost',1);
	
	print_r($p->pingResult);
		
	