<?php
class History {
	function __construct($apiKey) {
		$this->apiKey = $apiKey;
		$this->url = 'https://history.filelabel.co/api/?';		
	}
	
    private function curl($url, $utf8 = false) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, NULL);
        curl_setopt($curl, CURLOPT_POST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPGET, TRUE);        
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $return = curl_exec($curl);
        curl_close($curl);
        return ($utf8) ? json_decode(utf8_encode($return))->output : json_decode($return)->output;        
    }
	
	public function get($project, $id = false) {
		return $this->getResponse(array(
			'project' => $project,
			'token'   => $_SESSION['historyAPIToken'],
			'action'  => 'get'
		));
	}
    
    private function getResponse($params = false) {
        if($params) :
            $url = $this->url.http_build_query($params);
            $response = @$this->curl($url);
            return (empty($response) ? false : $response);
        endif;
        return false;
    }
	
	public function post($project, $data) {
		$response = $this->getResponse(array(
			'apiKey'  => $this->apiKey,
			'project' => $project,
			'data'    => $data,
			'time'    => time(),
			'action'  => 'post'
		));
	}
}
?>
