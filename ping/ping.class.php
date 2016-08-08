<?php

	class ping {
		
		public $pingResult = array (
							'rawStdout' => '', 
							'rttMin' => -1,
							'rttAvg' => -1,
							'rttMax' => -1,
							'rttMdev' => -1,
							'packetsTransmitted' => -1,
							'packetsReceived' => -1,
							'packetLoss' => -1,
							'time' => -1,
							'returnVar' => -1
		);
		
		public function __construct($host = NULL, $echoRequestCount = NULL) {

			if ($host) $this->ping($host, $echoRequestCount);
		}
		
		public function ping($host = NULL, $echoRequestCount = NULL) {

			if ($host) {
				if (strpos(strtoupper(PHP_OS), 'LINUX') === 0) {
					exec('ping -c '.$echoRequestCount.' '.$host." 2>&1",$this->pingResult['rawStdout'],$this->pingResult['returnVar']);
					if ($this->pingResult['returnVar'] == 0) {
						$res = explode('/', str_replace(array('= ', ' ms'), '', strstr(end($this->pingResult['rawStdout']),'=')));
						$this->pingResult['rttMin'] = $res[0];
						$this->pingResult['rttAvg'] = $res[1];
						$this->pingResult['rttMax'] = $res[2];
						$this->pingResult['rttMdev'] = $res[3];						
						$res = explode(', ',prev($this->pingResult['rawStdout']));
						$this->pingResult['packetsTransmitted'] = strstr($res[0],' p', true);
						$this->pingResult['packetsReceived'] = strstr($res[1],' r', true);
						$this->pingResult['packetLoss'] = strstr($res[2],'%', true);
						$this->pingResult['time'] = strstr(str_replace('time ', '', $res[3]),'ms', true);						
					}
						
				} elseif (strpos(strtoupper(PHP_OS), 'WIN') === 0) {
					exec('chcp 437',$this->pingResult['rawStdout'],$this->pingResult['returnVar']);					
					exec('ping -n '.$echoRequestCount.' '.$host,$this->pingResult['rawStdout'],$this->pingResult['returnVar']);
					if ($this->pingResult['returnVar'] == 0) {
						$res = explode(',', end($this->pingResult['rawStdout']));
						$this->pingResult['rttMin'] = strstr(str_replace('= ', '', $res[0]),'ms', true);
						$this->pingResult['rttAvg'] = strstr(str_replace('= ', '', $res[1]),'ms', true);
						$this->pingResult['rttMax'] = strstr(str_replace('= ', '', $res[2]),'ms', true);						
						print_r($res);
					}
				}
			}
		}
	}