<?php

	require_once ('./ping/ping.class.php');
	
	$p = new ping(array ('facebook.com','google.com','localhost'));
	print_r($p->Result);
	
	$p = new ping('google.com');
	print_r($p->Result);
		
	