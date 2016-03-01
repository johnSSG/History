<?php
class Obfuscator {
	function __construct($key) {
		$this->encryptionKey = $key;
	}
	
	public function encrypt($string) {
		return base64_encode($this->x($string));
	}
	
	public function decrypt($string) {
		return $this->x(base64_decode($string));
	}
	
	public function x($string) {
		$key = $this->encryptionKey;
		$text = $string;
		$outText = '';
		for($i = 0; $i < strlen($text);) :
			for($j=0;($j<strlen($key) && $i<strlen($text));$j++,$i++) :
				$outText .= $text{$i} ^ $key{$j};
				//echo 'i='.$i.', '.'j='.$j.', '.$outText{$i}.'<br />'; //for debugging
			endfor;
			return substr($outText, 0, 19);
		endfor;
	}
}
?>
