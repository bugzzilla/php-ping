<?php

	require_once ('./ping/ping.class.php');
	
	$p = new ping('localhost',1);
	
	if ($p->pingResult['returnVar'] == 0) echo "Success\n"; else echo "False";
		
	