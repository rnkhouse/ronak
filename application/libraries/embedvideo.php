<?php

class EmbedVideo {

	private $apiUrl; 
	private $data;
	
	function __construct($url = '') {
		$this->apiUrl = 'https://api.embed.ly/1/oembed?url=$1&maxwidth=500&maxheight=400&key=61e8a8cacadc40ae89da030dcaec681c';
 		$this->loadVideo($url);
	}
	
	private function loadVideo($url) {
		$targetURL      = str_replace('$1', $url. '&autoplay=1', $this->apiUrl);
		$oembedContents = @file_get_contents($targetURL);
		$this->data     = @json_decode($oembedContents);
	}
	
	public function getVideoURL() {
            if (isset($this->data->html))
            {
			$count = preg_match('/src=(["\'])(.*?)\1/', $this->data->html, $match);
		return ($count === FALSE) ? false : str_replace('http', 'https', $match[2]);                
            }
            else return '';
	}
	
	public function getThumb() {
		return $this->data->thumbnail_url;
	}
        
        public function getHTML() {
            return $this->data->html;
        }
}
