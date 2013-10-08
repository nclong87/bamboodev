<?php
class Core_Plugin_Env extends Zend_Controller_Plugin_Abstract {
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
		//die ( 'sss' );
	}
	public function dispatchLoopShutdown() {
		Core_Global::closeAllDb ();
	}
}