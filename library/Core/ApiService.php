<?php

/**
 * Class represents an api service. Use this class as if it is a real service in the api
 */
class Core_ApiService {

    private $_name;
    private $_apiConfig;
    private $api_url;
    private $api_secret;
    private $api_path;

    public function __construct($serviceName) {
        $this->_name = $serviceName;
        $config = Core_Global::getApplicationIni();
        //print_r($this->config);die;
        $this->api_url = $config->api->synch->api_url;
        $this->api_secret = $config->api->synch->api_secret;
        $this->api_path = $config->api->synch->api_path;
    }

    /**
     * Magic function to simulate function call to API
     * @param string $name
     * @param array $arguments
     * @return array
     * @throws Exception
     */
    public function __call($name, $arguments) {
        try {
            $result = null;

            $path = "{$this->api_path}/{$this->_name}/{$name}";
            //die("{$this->api_url}{$path}");
            $client = new Zend_Rest_Client("{$this->api_url}{$path}");
            $post = array();
            $post['args'] = $arguments;
            $post['api_secret'] = $this->api_secret;
            //print_r($post);die;
            $response = $client->restPost($path, $post);
            //print_r($response->getBody());exit;
            /* if($name=='create') {
            	print_r($response);die;
            } */
            if($response->isSuccessful()){

               // $this->_log->info("API Result\t{$this->_name}.{$name}\t" . $response->getBody());
                $result = Core_DataList_JSON::decode($response->getBody());
                if ($result[0] != '1') {
                    return $result[0];
                }
                return $result[1];
            }
        } catch (Exception $e) {
            Core_Log::getInstance()->log($e,'error');
            throw $e;
        }
        return null;
    }
}
?>
