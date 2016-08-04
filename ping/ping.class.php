<?php

	class ping {
		
		public $pingResult = array (
							'rawStdout' => '', 
							'returnVar' => -1);
		
		public function ping($hostname, $echoRequestCount = 3) {

			exec('ping -c '.$echoRequestCount.' '.$hostname." 2>&1",$this->pingResult['rawStdout'],$this->pingResult['returnVar']);
		}
		
	}