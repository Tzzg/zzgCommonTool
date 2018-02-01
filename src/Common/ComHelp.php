<?php
namespace zzg\Common;


class ComHelp {
	
	
	
	
	static function get_request_source_ip()
	{
		if ($_SERVER)
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		}
		else
		{
			if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
				$ip = getenv( 'HTTP_X_FORWARDED_FOR' );
			} elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
				$ip = getenv( 'HTTP_CLIENT_IP' );
			} else {
				$ip = getenv( 'REMOTE_ADDR' );
			}
		}
	
		return $ip;
	}
	
	
	
	

	/**
	 * 写入日志
	 * @param string $msg 内容
	 * @param string $product_name  项目名字
	 * @return boolean
	 */
	static  function write_log($msg, $product_name = 'common'){
		try {
			$filepath = BASEPATH.'logs/'.$product_name.'.log';
			$message  = '';
			if ( ! $fp = @fopen($filepath, 'ab'))
			{
				return FALSE;
			}
			
			$message .= $msg."\n";
			flock($fp, 2);
			fwrite($fp, $message);
			flock($fp, 3);
			fclose($fp);
		
			@chmod($filepath, 0666);
		} catch (\Exception $e){
			echo $e->getMessage();
		}
		return TRUE;
	}
	
	
	
	/**
	 * @param string $url  访问的URL，
	 * @param array $post post数据(不填则为GET)，
	 * @param $type post 提交  默认为 json 负责 为arr直接提交
	 */
	static function http_curl($url,$post = array(),$type='json')
	{
		$ch = curl_init();
		//设置抓取的url
		curl_setopt($ch, CURLOPT_URL, $url);
		//设置头文件的信息作为数据流输出
		//设置获取的信息以文件流的形式返回，而不是直接输出。
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		
		/* //7081
		if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443){
			
		}else{ */
			//跳过ssl检查项。
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
		/* } */
		
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10); 
		
		if($type=='json'){
			$post = json_encode($post,JSON_UNESCAPED_UNICODE);
		}
		if(!empty($post)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        }
		$data = curl_exec($ch);
		if(curl_errno($ch)){
          return curl_error($ch);
     	}
     	curl_close($ch);
     	return $data;
	}
	
	
	
	
	
	
	
}