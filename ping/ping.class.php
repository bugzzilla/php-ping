<?php

	class ping {
		
		public $pingResult = array (
							'os' => '',
							'rawStdout' => '', 
							'returnVar' => -1);
		
		public function ping($hostname = NULL, $echoRequestCount = 3) {

			if ($hostname) {
				if (strpos(strtoupper(PHP_OS), 'LINUX') == 0) {
					exec('ping -c '.$echoRequestCount.' '.$hostname." 2>&1",$this->pingResult['rawStdout'],$this->pingResult['returnVar']);
				} elseif (strpos(strtoupper(PHP_OS), 'WIN') == 0) {
					exec('ping -n '.$echoRequestCount.' '.$hostname,$this->pingResult['rawStdout'],$this->pingResult['returnVar']);					
				}
			}
		}
		
	}