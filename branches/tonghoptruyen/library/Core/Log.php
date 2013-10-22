<?php
class Core_Log {
	protected static $_instance = null;
	public static function getInstance() {
		if (! empty ( self::$_instance )) {
			return self::$_instance;
		}
		self::$_instance = new Core_Log ();
		return self::$_instance;
		return new Core_Log ();
	}

	protected $error_log_file;
	protected $info_log_file;
	private $process_id;
	public function __construct() {
		$info_log_path = PATH_LOG_FILES.'info/'.date('Ymd');
		if(!is_dir($info_log_path))
			mkdir($info_log_path, 0777, true);
		$error_log_path = PATH_LOG_FILES.'error/'.date('Ymd');
		if(!is_dir($error_log_path))
			mkdir($error_log_path, 0777, true);
		$date = new Zend_Date();
		$this->process_id = $date->toString('YMMddHHmmss').'_'.rand(1, 1000);
		$this->error_log_file = $error_log_path.'/'. $date->toString('YMMdd_HH') . '.txt';
		$this->info_log_file = $info_log_path.'/'. $date->toString('YMMdd_HH') . '.txt';
	}
	public function __destruct() {
	}
	public static function error($e, $pri = Zend_Log::ERR) {
		// echo 'MESSAGE : '.$msg.PHP_EOL;
		$msg = $e->getMessage () . PHP_EOL;
		$msg .= $e->getTraceAsString ();
		if ($pri == null)
			$pri = Zend_Log::ERR;
		if ($pri == Zend_Log::EMERG) { // khan cap
		                              // send email & sms
		                              // Core_Utils_MailUtil::getInstance()->send(MASTER_EMAIL,'Grab error',$msg);
		                              // Worker_Model_Log::getInstance()->writeLog($msg);
			$coreEmail = new Core_Email ();
			$coreEmail->send ( DEV_EMAIL, '[jobbid.vn] EMERG!', $msg );
		}
		$logFileName = 'ERROR_' . date ( 'Y-m-d' ) . '.txt';
		$writer = new Zend_Log_Writer_Stream ( PATH_LOG_FILES . $logFileName );
		$logger = new Zend_Log ( $writer );
		$logger->setTimestampFormat ( 'Y-m-d H:i:s' );
		$logger->log ( $msg, $pri );
		$writer->shutdown ();
		// $logger->error($msg);
	}
	public static function write($msg, $reset = true) {
		$logFileName = PATH_LOG_FILES . 'DEBUG_' . date ( 'Y-m-d' ) . '.txt';
		$file = fopen ( $logFileName, 'w' );
		fwrite ( $file, $msg );
		fclose ( $file );
		// file_put_contents($logFileName, $msg);
		/*
		 * $writer = new Zend_Log_Writer_Stream(PATH_LOG_FILES.$logFileName,'w'); $logger = new Zend_Log($writer); $logger->setTimestampFormat('Y-m-d H:i:s'); $logger->log($msg, Zend_Log::ERR); $writer->shutdown();
		 */
	}
	public function log($data, $type = Zend_Log::INFO) {
		if ($type == Zend_Log::ERR) {
			$str = '';
			if (is_array ( $data )) {
				foreach ( $data as $index => $item ) {
					if ($index == 0) {
						$e = $item;
					} else {
						if (is_array ( $item )) {
							$str .= json_encode ( $item ) . '  ';
						} else {
							$str .= $item . '  ';
						}
					}
				}
			} else {
				$e = $data;
			}
			$message = $e->getMessage ();
			$code = $e->getCode ();
			$file = $e->getFile ();
			$line = $e->getLine ();
			$trace = $e->getTraceAsString().PHP_EOL;
			$message = "{code:{$code}}  {message:{$message}{$str}}  {file:{$file}:{$line}}".PHP_EOL;
			$message.=$trace;
			$writer = new Zend_Log_Writer_Stream ($this->error_log_file );
			$logger = new Zend_Log ( $writer );
			$logger->setTimestampFormat ( 'Y-m-d H:i:s' );
			$logger->log ( $this->process_id.'  '.$message, $type );
			$writer->shutdown ();
		} else {
			if (is_array ( $data )) {
				$message = '';
				foreach ( $data as $item ) {
					if (is_object ( $item ))
						$item = ( array ) $item;
					if (is_array ( $item )) {
						$message .= json_encode ( $item ) . '  ';
					} else {
						$message .= $item . '  ';
					}
				}
			} else {
				$message = $data;
			}
		}
		$writer = new Zend_Log_Writer_Stream ( $this->info_log_file );
		$logger = new Zend_Log ( $writer );
		$logger->setTimestampFormat ( 'Y-m-d H:i:s' );
		$logger->log ( $this->process_id.'  '.$message.PHP_EOL, $type );
		$writer->shutdown ();
	}

	public function getProcessId() {
		return $this->process_id;
	}
}