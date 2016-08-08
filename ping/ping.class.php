<?php

	class ping {
		
		public $Result = array();
		
		public function __construct($host, $echoRequestCount = 3) {
			
			if (is_array($host)) {
				$tmp = array();
				foreach ($host as $item) {
					$tmp[$item] = $this->ping($item, $echoRequestCount);					
				}
				$this->Result = $tmp;
			} else $this->Result = $this->ping($host, $echoRequestCount);
		}
		
		private function ping($host, $echoRequestCount = 3) {

			$pingResult = array ();
			if (strpos(strtoupper(PHP_OS), 'LINUX') === 0) {
				exec('ping -c '.$echoRequestCount.' '.$host." 2>&1",$pingResult['rawStdout'],$pingResult['returnVar']);
				if ($pingResult['returnVar'] == 0) {
					$res = explode('/', str_replace(array('= ', ' ms'), '', strstr(end($pingResult['rawStdout']),'=')));
					$pingResult['rttMin'] = $res[0];
					$pingResult['rttAvg'] = $res[1];
					$pingResult['rttMax'] = $res[2];
					$pingResult['rttMdev'] = $res[3];						
					$res = explode(', ',str_replace(array (' packets transmitted', ' received', '% packet loss', ' time', 'ms'), '', prev($pingResult['rawStdout'])));
					$pingResult['packetsTransmitted'] = $res[0];
					$pingResult['packetsReceived'] = $res[1];
					$pingResult['packetLoss'] = $res[2];
					$pingResult['time'] = $res[3];						
				}
			} elseif (strpos(strtoupper(PHP_OS), 'WIN') === 0) {
				exec('chcp 437',$pingResult['rawStdout'],$pingResult['returnVar']);					
				exec('ping -n '.$echoRequestCount.' '.$host,$pingResult['rawStdout'],$pingResult['returnVar']);
				if ($pingResult['returnVar'] == 0) {
					$res = explode(',', trim(str_replace(array('ms','Minimum = ','Maximum = ','Average = '), '' ,end($pingResult['rawStdout']))));
					$pingResult['rttMin'] = $res[0];
					$pingResult['rttMax'] = $res[1];
					$pingResult['rttAvg'] = $res[2];
					prev($this->pingResult['rawStdout']);
					$res = explode(',', trim(str_replace(array('Packets: Sent = ', ' Received = ', ' Lost = '), '', prev($pingResult['rawStdout']))));
					$pingResult['packetsTransmitted'] = $res[0];
					$pingResult['packetsReceived'] = $res[1];
					$pingResult['packetLoss'] = strstr($res[2],' (',true);						
				}
			}
			return $pingResult;
		}
	}