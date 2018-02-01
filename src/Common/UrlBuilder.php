<?php
namespace zzg\Common;
class UrlBuilder {
	
	
	/**
	 * return https://   ||  http://
	 * @return string
	 */
	static function getHttp(){
		if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443){
			return 'https://';
		}else{
			return 'http://';
		}
	}
	
	/**
	 * return  true   ||  false
	 * @return string
	 */
	static function isHttps(){
		if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443){
			return true;
		}else{
			return false;
		}
	}
	
	
	
}