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

			if ($host) $this->host = $host;
			if ($echoRequestCount) $this->echoRequestCount = $echoRequestCount;			
				
			if ($this->host) {
				if (strpos(strtoupper(PHP_OS), 'LINUX') === 0) {
					exec('ping -c '.$this->echoRequestCount.' '.$this->host." 2>&1",$this->pingResult['rawStdout'],$this->pingResult['returnVar']);					
				} elseif (strpos(strtoupper(PHP_OS), 'WIN') === 0) {
					exec('chcp 437',$this->pingResult['rawStdout'],$this->pingResult['returnVar']);					
					exec('ping -n '.$this->echoRequestCount.' '.$this->host,$this->pingResult['rawStdout'],$this->pingResult['returnVar']);					
				}
			}
			
		}
		
	}