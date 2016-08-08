<?php

	class ping {
		
		public $host = '';
		public $echoRequestCount = 3;
		
		public $pingResult = array (
							'os' => '',
							'rawStdout' => '', 
							'returnVar' => -1
		);
		
		public function __construct($host = NULL, $echoRequestCount = NULL) {
			
			if ($host) $this->host = $host;
			if ($echoRequestCount) $this->echoRequestCount = $echoRequestCount;
		}
		
		public function ping($host = NULL, $echoRequestCount = NULL) {

			$cmd = '';
			
			if ($host) $this->host = $host;
			if ($echoRequestCount) $this->echoRequestCount = $echoRequestCount;			
				
			if ($this->host) {
				if (strpos(strtoupper(PHP_OS), 'LINUX') == 0) {
					$cmd = 'ping -c '.$this->echoRequestCount.' '.$this->host." 2>&1";
				} elseif (strpos(strtoupper(PHP_OS), 'WIN') == 0) {
					$cmd = 'ping -n '.$this->echoRequestCount.' '.$this->host;					
				}
			}
			
			echo $cmd.PHP_EOL;
			if ($cmd) exec($cmd,$this->pingResult['rawStdout'],$this->pingResult['returnVar']);
			
		}
		
	}