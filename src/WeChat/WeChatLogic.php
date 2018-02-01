<?php
namespace zzg\WeChat;






use zzg\Common\ComHelp;

/**
 * 微信sdk 逻辑处理
 * @author zzg
 *
 */
class WeChatLogic
{

	/**
	 * 获取用户身上的标签列表
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post
	 * {
		  "openid" : "ocYxcuBt0mRugKZ7tGAHPnUaOW7Y"
	   }
	 * @return 
	 * {
 		 "tagid_list":[//被置上的标签列表
						134,
						2
					  ]
		}
	 */
	static  function getUserTaglist($appid,$appkey,$post=array())
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
	
		$url = "https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token={$access_token}";
	
		$output = ComHelp::http_curl($url,$post);
		$output = json_decode($output,true);
		return $output;
	}
	
	
	
	/**
	 * 批量为用户取消标签
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post
	 * {
		  "openid_list" : [//粉丝列表
		    "ocYxcuAEy30bX0NXmGn4ypqx3tI0",
		    "ocYxcuBt0mRugKZ7tGAHPnUaOW7Y"
		  ],
		  "tagid" : 134
		}
	 * @return mixed
	 */
	static  function batchUnTagging($appid,$appkey,$post=array())
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
	
		$url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token={$access_token}";
		if(count($post['openid_list']>50)){
			$tem_post_all = array_chunk($post['openid_list'], 45);
			foreach ($tem_post_all as $val){
				$post_p = array('openid_list'=>$val,'tagid'=>$post['tagid']);
				$output = ComHelp::http_curl($url,$post_p);
			}
		}else{
			$output = ComHelp::http_curl($url,$post);
		}
		
		$output = json_decode($output,true);
		return $output;
	}
	
	/**\
	 * 批量打标签
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post
	 * {
		  "openid_list" : [//粉丝列表
		    "ocYxcuAEy30bX0NXmGn4ypqx3tI0",
		    "ocYxcuBt0mRugKZ7tGAHPnUaOW7Y"
		  ],
		  "tagid" : 134
		}
	 * @return mixed
	 */
	static  function batchTagging($appid,$appkey,$post=array())
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
	
		$url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token={$access_token}";
	
		if(count($post['openid_list']>50)){
			$tem_post_all = array_chunk($post['openid_list'], 45);
			foreach ($tem_post_all as $val){
				$post_p = array('openid_list'=>$val,'tagid'=>$post['tagid']);
				$output = ComHelp::http_curl($url,$post_p);
			}
		}else{
			$output = ComHelp::http_curl($url,$post);
		}
		
		
		$output = json_decode($output,true);
		return $output;
	}
	
	
	/**
	 * 创建标签
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post
	 * {
	  "tag" : {
	
	    "name" : "广东"//标签名
	
	  }
	 * @return array
	 * {
	    "tag":{
			"id":134,//标签id
			"name":"广东"
		  }
	   }
	 */
	static  function createTag($appid,$appkey,$post=array())
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
		
		$url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token={$access_token}";
		
		$output = ComHelp::http_curl($url,$post);
		$output = json_decode($output,true);
		return $output;
	}
	
	
	/**
	 * 获取公众号已创建的标签
	 * @param  $appid
	 * @param  $appkey
	 * @return 
	 * {
	    "tags":[{
	      "id":1,
	      "name":"每天一罐可乐星人",
	      "count":0 //此标签下粉丝数
		},{
		  "id":2,
		  "name":"星标组",
		  "count":0
		},{
		  "id":127,
		  "name":"广东",
		  "count":5
		}
		  ]
		}
	 */
	static  function getTags($appid,$appkey)
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
	
		$url = "https://api.weixin.qq.com/cgi-bin/tags/get?access_token={$access_token}";
	
		$output = ComHelp::http_curl($url);
		$output = json_decode($output,true);
		return $output;
	}
	
	/**
	 * 编辑标签
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post
	 * {
	  "tag" : {
	    "id" : 134,
	    "name" : "广东人"
	  }
	 }
	 * @return array
	 */
	static  function updateTag($appid,$appkey,$post)
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
	
		$url = "https://api.weixin.qq.com/cgi-bin/tags/update?access_token={$access_token}";
	
		$output = ComHelp::http_curl($url,$post);
		$output = json_decode($output,true);
		return $output;
	}
	
	/**
	 * 获取标签下粉丝列表
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post
	 * {
	  "tagid" : 134,
	  "next_openid":""//第一个拉取的OPENID，不填默认从头开始拉取
	 }
	 * @return array
	 * {
		  "count":2,//这次获取的粉丝数量
		  "data":{//粉丝列表
		  "openid":[
		    "ocYxcuAEy30bX0NXmGn4ypqx3tI0",
		    "ocYxcuBt0mRugKZ7tGAHPnUaOW7Y"
	      	]
	  	  },
	  	"next_openid":"ocYxcuBt0mRugKZ7tGAHPnUaOW7Y"//拉取列表最后一个用户的openid
	   }
	 */
	static  function getTagUsers($appid,$appkey,$post)
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
	
		$url = "https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token={$access_token}";
	
		$output = ComHelp::http_curl($url,$post);
		$output = json_decode($output,true);
		return $output;
	}
	
	/**
	 * //设置用户备注名
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post
	 * {
		"openid":"oDF3iY9ffA-hqb2vVvbr7qxf6A0Q",
		"remark":"pangzi"
		}
	 * @return array
	 */
	static function updateRemark($appid,$appkey,$post=array())
	{
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
		
		$url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token={$access_token}";
		
		$output = ComHelp::http_curl($url,$post);
		$output = json_decode($output,true);
		return $output;
	}

	/**
	 * 获得 所有关注用户
	 * @param  $parm
	 * $star 第一个拉取的OPENID，不填默认从头开始拉取 [拉取结果不包含这条]
	 * 次拉取调用最多拉取10000个关注者的OpenID 无法指定拉取数
	 */
	static function getFollowUserList($appid,$appkey,$star=''){
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
		if($star){
			$url_1 = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid={$appkey}";
		}
		$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}";
		
		$output = ComHelp::http_curl($url);
		$output = json_decode($output,true);
		return $output;
	}
	
	
	
	
	
	/**
	 * 客服接口-发消息
	 *  $post_data json
	 */
	static function sendCustomMessage($appid,$appkey,$post_data){
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
		$output = ComHelp::http_curl($url,$post_data);
		return $output;
	}
	
	/**
	 * 发送模板消息 
	 * @return json
	 */
	static function sendTemplateMessage($appid,$appkey,$post_data){
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";
		$output = ComHelp::http_curl($url,$post_data);
		return $output;
		//在模版消息发送任务完成后，微信服务器会将是否送达成功作为通知，发送到开发者中心中填写的服务器配置地址中
	}
	
	
	
	
	/**
	 * 获得 微信服务器 推送过的 xml包 
	 * 并记录日志
	 * @return SimpleXMLElement
	 */
	static function getPushXmlDataForObj($obj='zjg')
	{
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		$postObj = simplexml_load_string( $postArr, null, LIBXML_NOCDATA );//读 cdata数据
		
		//写日志操作
		$msg = json_encode($postObj);
		ComHelp::write_log($msg,"wechat_{$obj}_sdk_log");//写文件
		
		$obj_hdd = "wechat{$obj}_pushmessage_log";
		$arr = json_decode($msg,true);//写入mongo
		ModuleManager::hddCollection($obj_hdd)->insert($arr);
		
		return $postObj;
	}
	
	/**
	 *创建自定义菜单
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post_data array
	 * @return string
	 */
	static function createButton($appid,$appkey,$post_data){
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
		$output = ComHelp::http_curl($url,$post_data);
		return $output;
	}
	
	
	
	/**
	 *创建个性化菜单
	 * @param  $appid
	 * @param  $appkey
	 * @param  $post_data array
	 * @return string
	 */
	static function createSecButton($appid,$appkey,$post_data){
		$access_token = WeChatLogic::getWxAccessToken($appid,$appkey);
		$url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token={$access_token}";
		$output = ComHelp::http_curl($url,$post_data);
		return $output;
	}
	

	/**
	 * 第一次检查验证
	 * @return boolean
	 */
	static function checkSignature($parm,$token)
	{
		$signature = $parm["signature"];
		$timestamp = $parm["timestamp"];
		$nonce = $parm["nonce"];
	
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
	
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * 获得 AccessToken
	 */
	static  function getWxAccessToken($appid,$appkey)
	{//低耦合
		$access_token_mem_key = "access_token_mem_key_{$appid}";
		$access_token = ComHelp::get_cache($access_token_mem_key);
		
		$res = ModuleManager::hddCollection('wx_access_token')
			->where('key',$access_token_mem_key)
			->first(array('val','expire_date'));
		
		if(	empty($access_token) && $res['expire_date'] > time()){
			
			$access_token = $res['val'];
		
		}else if(empty($access_token)){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appkey;
			$res = ComHelp::http_curl($url);
			$arr = json_decode($res, true);
			
			
			if(!empty($arr['access_token'])){
				$access_token = $arr['access_token'];
				ComHelp::set_cache($access_token_mem_key, $arr['access_token'], $arr['expires_in']-1);
				if(empty($res)){
					ModuleManager::hddCollection('wx_access_token')
						->insert(array('key'=>$access_token_mem_key,'val'=>$access_token,'expire_date'=>time()+$arr['expires_in']-1));
				}else{
					$res = ModuleManager::hddCollection('wx_access_token')
						->where('key',$access_token_mem_key)
						->update(array('val'=>$access_token,'expire_date'=>time()+$arr['expires_in']-1));
				}
				
			}
		}
		return $access_token;
	}
	
	
	/**
	 *用户同意授权，获取code token user_infor
	 *
	 */
	static  function callBackGetCodeThenGetTokenAndUserInfor($appid,$appkey,$parm)
	{
		$code = '';
		$access = '';
		$user_infor = '';
		if(!isset($parm['code'])){
			return  '';
		}else{
			$code =  $parm['code'];
			$mem_name = "wechat_{$code}_access_token_data";
			$mem_ref = "wechat_{$code}_access_refresh_token";
			$access = ComHelp::get_cache($mem_name);//查看用户AccessToken是否超时
			if(empty($access)){//缓存中没有，需要重新请求
				$refresh_token = ComHelp::get_cache($mem_ref);//查看用户的refresh_token
				if(!empty($refresh_token)){//refresh_token存在，则刷新access_token
					$access = self::getAccessTokenByRefreshToken($appid,$appkey,$refresh_token);
				}else{
					$access = self::getAccessTokenByCode($appid,$appkey,$code);
					if(!isset($access['errcode']) && isset($access['expires_in'])){//返回正常时
						set_cache($mem_name, $access, $access['expires_in']-3600);
						set_cache($mem_ref, $access['refresh_token'], 24*3600);//refresh_token要长于access_token的有效期
					}
				}
			}
		}
		header("Content-type: text/html; charset=utf-8");
		if(isset($access['scope']) && $access['scope']=='snsapi_userinfo' ){//获取用户信息无限制
			$user_infor = self::getUserInforByAcessTokenAndOpenIdSns($access['access_token'], $access['openid']);
		}else{//snsapi_base 有限制 500w
			$wx_access = self::getWxAccessToken($appid, $appkey);
			$user_infor = self::getUserInforByAcessTokenAndOpenIdUser($wx_access, $access['openid']);
		}
		$retrun_data = array('code'=>$code,'access_token'=>$access,'user_infor'=>$user_infor);
		return  $retrun_data;
	}
	
	/**
	 * 拉取用户信息(需scope为 snsapi_userinfo)
	 * @param  $access_token
	 * @param  $open_id
	 * @return array
	 */
	static function getUserInforByAcessTokenAndOpenIdSns($access_token,$open_id){
		$url= "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
		$json_data =  ComHelp::http_curl($url);
		$arr_data = json_decode($json_data,true);
		return $arr_data;
	}
	
	/**
	 * 刷新access_token（如果需要）
	 * @param  $refresh_token
	 * @return array
	 */
	static function getAccessTokenByRefreshToken($appid,$appkey,$refresh_token){
		
		$url= "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$appid}&grant_type=refresh_token&refresh_token={$refresh_token}";
		$json_data =  ComHelp::http_curl($url);
		$arr_data = json_decode($json_data,true);
		return $arr_data;
	}
	/**
	 * 通过code换取网页授权access_token
	 * @param  $code
	 * @return array
	 */
	static function getAccessTokenByCode($appid,$appkey,$code){
		
		$url= "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appkey}&code={$code}&grant_type=authorization_code";
		$json_data =  ComHelp::http_curl($url);
		$arr_data = json_decode($json_data,true);
		return $arr_data;
	}
	
	
	
	/**
	 * 获取用户基本信息（包括UnionID机制）开发者可通过OpenID来获取用户基本信息
	 * @param  $access_token  自己的
	 * @param unknown_type $open_id
	 * @return mixed
	 */
	static function getUserInforByAcessTokenAndOpenIdUser($access_token,$open_id){
		if(empty($open_id)){
			return array("subscribe"=>1,"nickname"=>"-1",
					"openid"=>$open_id,"sex"=>0,"language"=>"zh_CN",
					"city"=>"","province"=>"","country"=>"",
					"headimgurl"=>"","subscribe_time"=>0,"unionid"=>"",
					"remark"=>"","groupid"=>0,"tagid_list"=>array());
		}
		$url= "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
		$json_data =  ComHelp::http_curl($url);
		$arr_data = json_decode($json_data,true);
		return $arr_data;
	}
	
	/**
	 * 长链接转成短链接
	 * @param  $appid
	 * @param  $appkey
	 * @param  $long_url
	 */
	static function toShortUrl($appid,$appkey,$long_url)
	{
		$access_token = self::getWxAccessToken($appid, $appkey);
		$url= "https://api.weixin.qq.com/cgi-bin/shorturl?access_token={$access_token}";
		
		$post_data['action'] = 'long2short';
		$post_data['long_url'] = $long_url;
		$json_data =  ComHelp::http_curl($url,$post_data);
		$arr_data = json_decode($json_data,true);
		
		if(isset($arr_data['errcode']) && $arr_data['errcode'] == 0){
			return $arr_data['short_url'];
		}else{
			return '';
		}
	}
	
	/**
	 * 生成微信 授权地址
	 * @param $appid
	 * @param $appkey
	 * @param  $redirect_uri 回调地址
	 * @param  $scope 授权模式 snsapi_base/snsapi_userinfo
	 * @param  $need_short 是否返回短连接
	 * //默认关闭 短连接
	 */
	static function createWxOauthUrl($appid,$appkey,$redirect_uri,$scope,$need_short=false)
	{
		$redirect_uri = urlencode($redirect_uri);
		$wx_open = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state=weChat#wechat_redirect";
		if($need_short){
			$key = md5($appid.'_'.$redirect_uri.'_'.$scope);
			ComHelp::del_cache($key);
			$res = ComHelp::get_cache($key);
			if(empty($res)){
				$wx_open = self::toShortUrl($appid, $appkey, $wx_open);
				ComHelp::set_cache($key, $wx_open, '7*24*3600');
			}else{
				$wx_open = $res;
			}
			
		
		}
		return $wx_open;
	}
	
	
	
	
	
}