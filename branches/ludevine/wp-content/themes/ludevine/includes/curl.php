<?php
class Curl
{
	protected static $_instance = null;
	public static function getInstance($params){
		//Check instance
		if(empty(self::$_instance)){
			self::$_instance = new Curl($params);
		}
	
		//Return instance
		return self::$_instance;
	}
    private $ch;
    /**
     * Init curl session
     * 
     * $params = array('url' => '',
     *                    'host' => '',
     *                   'header' => '',
     *                   'method' => '',
     *                   'referer' => '',
     *                   'cookie' => '',
     *                   'post_fields' => '',
     *                    ['login' => '',]
     *                    ['password' => '',]      
     *                   'timeout' => 0
     *                   );
     */      
    public function  __destruct() {
    	//echo 'Core_Dom_Curl::__destruct'.PHP_EOL;
    }          
    
    public function __construct($params)
    {
    	$this->ch = Utils::initCurl($params);
    }
    
    /**
     * Make curl request
     *
     * @return array  'header','body','curl_error','http_code','last_url'
     */
    public function exec($return = true)
    {
        $response = curl_exec($this->ch);
        if($return) {
	        $cookie = '';
	        preg_match('/^Set-Cookie:\s*([^;]*)/mi', $response, $m);
	        if(isset($m[1]))
	        	parse_str($m[1], $cookie);
	        $error = curl_error($this->ch);
	        $result = array( 'header' => '', 
	                         'body' => '', 
	                         'curl_error' => '', 
	                         'http_code' => '',
	                         'last_url' => '');
	        if ( $error != "" )
	        {
	            $result['curl_error'] = $error;
	            return $result;
	        }
	        
	        $header_size = curl_getinfo($this->ch,CURLINFO_HEADER_SIZE);
	        $result['header'] = substr($response, 0, $header_size);
	        $result['body'] = substr( $response, $header_size );
	        $result['http_code'] = curl_getinfo($this -> ch,CURLINFO_HTTP_CODE);
	        $result['last_url'] = curl_getinfo($this -> ch,CURLINFO_EFFECTIVE_URL);
	        $result['cookie'] = $cookie;
	        //curl_close($this->ch);
	        return $result;
        }
    }
    public function setOpt($name,$value) {
    	@curl_setopt($this -> ch, $name, $value);
    }
}
