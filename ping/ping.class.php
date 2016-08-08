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
						$res = explode(', ',str_replace(array (' packets transmitted', ' received', '% packet loss', ' time', 'ms'), '', prev($this->pingResult['rawStdout'])));
						$this->pingResult['packetsTransmitted'] = $res[0];
						$this->pingResult['packetsReceived'] = $res[1];
						$this->pingResult['packetLoss'] = $res[2];
						$this->pingResult['time'] = $res[3];						
					}
						
				} elseif (strpos(strtoupper(PHP_OS), 'WIN') === 0) {
					exec('chcp 437',$this->pingResult['rawStdout'],$this->pingResult['returnVar']);					
					exec('ping -n '.$echoRequestCount.' '.$host,$this->pingResult['rawStdout'],$this->pingResult['returnVar']);
					if ($this->pingResult['returnVar'] == 0) {
						$res = explode(',', trim(str_replace(array('ms','Minimum = ','Maximum = ','Average = '), '' ,end($this->pingResult['rawStdout']))));
						$this->pingResult['rttMin'] = $res[0];
						$this->pingResult['rttMax'] = $res[1];
						$this->pingResult['rttAvg'] = $res[2];
						prev($this->pingResult['rawStdout']);
						$res = explode(',', trim(str_replace(array('Packets: Sent = ', ' Received = ', ' Lost = '), '', prev($this->pingResult['rawStdout']))));
						$this->pingResult['packetsTransmitted'] = $res[0];
						$this->pingResult['packetsReceived'] = $res[1];
						$this->pingResult['packetLoss'] = strstr($res[2],' (',true);						
						print_r($res);
						
					}
				}
			}
		}
	}