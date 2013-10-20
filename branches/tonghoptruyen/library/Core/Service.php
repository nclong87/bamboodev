<?php
class Core_Service{
	private $api_url;	
	private $api_secret;
	private $rest = array();
	private $method = array();
	private $config;
	
    public function __construct(){
    	$this->config = Core_Global::getApplicationIni();
    	//print_r($this->config);die;
        $this->api_url = $this->config->app->baseUrl;
		$this->api_secret = $this->config->app->api_secret;
    }
	
	public function __call($name, $args){
		if(count($this->method)>=2){
			$this->method = array();				
		}
		$this->method[] = ucfirst($name);
		//print_r($this->method);exit;	
		if(1 == count($this->method)){
			$result = false;			
			$start = microtime(true);			

			$path = "/Api/{$this->method[0]}/{$name}";		
			//die("{$this->api_url}{$path}");				
			$client = new Zend_Rest_Client("{$this->api_url}{$path}");

			$post = array();
			$post['args'] = $args;
			$post['api_secret'] = $this->api_secret;						
			$response = $client->restPost($path, $post);			
			if($response->isSuccessful()){
				try{
					$result = Core_DataList_JSON::decode($response->getBody());					
				}
				catch(Exception $e){	
					throw new Zend_Exception($response->getBody());
				}				
			}		
			
			$end = microtime(true);
			return $result;
		}
		return $this;
	}
}