<?php
namespace zzg\WeChat;


/**
 * 微信sdk 配置文件
 * @author zzg
 *
 */
class WeChatConfig{
	
	const APPID = "wx8f5c1def954afcea";
	const APPSECRET = "5c4ef388abe1e7a03d5bdffb015dafc7";
	
	const TOKENURL = 'https://api.weixin.qq.com/cgi-bin/token?';
	
	const TICKETURL = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?";
	
	
	/**
	 * @param $des
	 * $des     zjg  /   haodingdan
	 * $item     des  app_id   app_secret token
	 */
	static function getWc($des,$item = null)
	{
		$res = array();
		switch ($des){
			case 'haodingdan':
				if(ENVIRONMENT=='live'){//线上
					$res['des'] = 'haodingdan';
					$res['app_id'] = 'wx8f5c1def954afcea';
					$res['app_secret'] = '5c4ef388abe1e7a03d5bdffb015dafc7';
					$res['token'] = 'haodingdan';
				}else{
					$res['des'] = 'haodingdan-test';
					$res['app_id'] = 'wx0e29b3f2a06f4a1f';
					$res['app_secret'] = 'ead3a414c309e21afbcd5735cc962e6e';
					$res['token'] = 'haodingdan';
				}
				break;
			default:
				break;	
		}
		if(!empty($item)){
			return $res[$item];
		}else{
			return $res;
		}
		
	}
	
	static function ZJG_TOKEN()
	{
		if(ENVIRONMENT=='live'){//线上
			return 'wxzjg';
		}else{
			return '0UO0RngoQGgWLII1JSK5';
		}
	}
	
	static function ZJG_APPID()
	{
		if(ENVIRONMENT=='live'){//线上
			return 'wx17b76cdbb3fe2707';
		}else{
			return 'wxa59859d33e614cf2';
		}
	}
	static function ZJG_APPSECRET()
	{
		if(ENVIRONMENT=='live'){//线上
			return '1ddb36c7a28128e8dd6b6f65f67e6b40';
		}else{//测试
			return '8bf2e252ffc024f1787b6c9af51558f2';
		}
	}
	/**
	 * 报名成功通知
	 * @return string
	 */
	static function ZJG_SUC_VER_TEM()
	{
		if(ENVIRONMENT=='live'){//线上
			return '3tFYZBq-yGObEesZotvGmztwSaCOhH3eiYbx2JFxkOI';
		}else{	//测试
			return 'xWQtAhwbDRZEwDxp6ogPjZKwMm1sk2cxe4eyzew1YII';
		}
	}
	/**
	 * 兼职报名人数已满通知
	 * @return string
	 */
	static function ZJG_FAI_VER_TEM()
	{
		if(ENVIRONMENT=='live'){//线上
			return 'QgtwqO0geuyREEL9L08N3bNI3--L7Jvt3KexCxdXtas';
		}else{//测试
			return 'T0J87zpz7cXes-9wDkcy4dLFSdFJNJCnxx03WUw8f58';
		}
	}
	
	
	/**
	 * 您有一条新的整件工任务单待申请
	 * @return string
	 */
	static function ZJG_TASK_PUSH_TEM()
	{
		if(ENVIRONMENT=='live'){//线上
			//return '9rRC1vPBUF9KICRKdCC-Q1ZOoW1A5qRWvjTKM3OjXlU'; //
			return 'DaxfKIfBa64o2rd60QxIm0OS0i0kf5JQ1-tAjH0q1wo';
		}else{//测试
			return 'OJwckk1eL2B9Cu2LRpJd3aPZ2yTANVRt0rVmPmOiDKo';
		}
	}
	
	
	
	/**
	 * 您有一条新的供应链订单待申请
	 * @return string
	 */
	static function SC_ORDER_PUSH_TEM()
	{
		if(ENVIRONMENT=='live'){//线上
			return 'CWE0VkL5AbiOaVZ_3t_N3RNp7WRk0QembqYt0waWOMA'; //
		}else{//测试
			return 'Cz6xPPyjljPX1JTH-rH3IqIBomHdlYw_rhaZ_bAA7AM';
		}
	}
	
	/**
	 * 报名成功通知
	 * @return string
	 */
	static function SC_SUC_VER_TEM()
	{
		if(ENVIRONMENT=='live'){//线上
			return '';
		}else{	//测试
			return 'AYB25pWGTfhHoRaEx2FfSoirA0xOIN9WPOSgMzETWAo';
		}
	}
	/**
	 * 兼职报名人数已满通知
	 * @return string
	 */
	static function SC_FAI_VER_TEM()
	{
		if(ENVIRONMENT=='live'){//线上
			return '';
		}else{//测试
			return 'ItGfWZVxqOBh2kxlf73A-T6brQjgei5dkDE_ojWzLEE';
		}
	}
	
	
	
	
	/**
	 * 获得推送消息 xml string
	 * @param $MsgType
	 * @param $event
	 * @return Ambigous <string, multitype:string >
	 */
	static function getWechatPushXmlReturnString($MsgType,$event='')
	{
		
		$event_xml_arr = array(
				'subscribe'=>'<xml>
							<ToUserName><![CDATA[toUser]]></ToUserName>
							<FromUserName><![CDATA[FromUser]]></FromUserName>
							<CreateTime>123456789</CreateTime>
							<MsgType><![CDATA[event]]></MsgType>
							<Event><![CDATA[subscribe]]></Event>
							</xml>',
				'unsubscribe'=>'<xml>
							<ToUserName><![CDATA[toUser]]></ToUserName>
							<FromUserName><![CDATA[FromUser]]></FromUserName>
							<CreateTime>123456789</CreateTime>
							<MsgType><![CDATA[event]]></MsgType>
							<Event><![CDATA[subscribe]]></Event>
							</xml>',
				'SCAN'=>'<xml>
						<ToUserName><![CDATA[toUser]]></ToUserName>
						<FromUserName><![CDATA[FromUser]]></FromUserName>
						<CreateTime>123456789</CreateTime>
						<MsgType><![CDATA[event]]></MsgType>
						<Event><![CDATA[subscribe/SCAN]]></Event>
						<EventKey><![CDATA[qrscene_123123]]></EventKey>
						<Ticket><![CDATA[TICKET]]></Ticket>
						</xml>',// 用户未关注时，进行关注后的事件推送 subscribe
								//用户已关注时的事件推送  SCAN 
				'LOCATION'=>'<xml>
							<ToUserName><![CDATA[toUser]]></ToUserName>
							<FromUserName><![CDATA[fromUser]]></FromUserName>
							<CreateTime>123456789</CreateTime>
							<MsgType><![CDATA[event]]></MsgType>
							<Event><![CDATA[LOCATION]]></Event>
							<Latitude>23.137466</Latitude>
							<Longitude>113.352425</Longitude>
							<Precision>119.385040</Precision>
							</xml>',
				'CLICK'=>'<xml>
						<ToUserName><![CDATA[toUser]]></ToUserName>
						<FromUserName><![CDATA[FromUser]]></FromUserName>
						<CreateTime>123456789</CreateTime>
						<MsgType><![CDATA[event]]></MsgType>
						<Event><![CDATA[CLICK]]></Event>
						<EventKey><![CDATA[EVENTKEY]]></EventKey>
						</xml>',//点击菜单拉取消息时的事件推送 
				'VIEW'=>'<xml>
						<ToUserName><![CDATA[toUser]]></ToUserName>
						<FromUserName><![CDATA[FromUser]]></FromUserName>
						<CreateTime>123456789</CreateTime>
						<MsgType><![CDATA[event]]></MsgType>
						<Event><![CDATA[CLICK]]></Event>
						<EventKey><![CDATA[EVENTKEY]]></EventKey>
						</xml>',//点击菜单跳转链接时的事件推送 
				);
		
		
		$xml_data_arr = array(
				'text'=>'<xml>
						 <ToUserName><![CDATA[toUser]]></ToUserName>
						 <FromUserName><![CDATA[fromUser]]></FromUserName> 
						 <CreateTime>1348831860</CreateTime>
						 <MsgType><![CDATA[text]]></MsgType>
						 <Content><![CDATA[this is a test]]></Content>
						 <MsgId>1234567890123456</MsgId>
						 </xml>',
				'image'=>'<xml>
						 <ToUserName><![CDATA[toUser]]></ToUserName>
						 <FromUserName><![CDATA[fromUser]]></FromUserName>
						 <CreateTime>1348831860</CreateTime>
						 <MsgType><![CDATA[image]]></MsgType>
						 <PicUrl><![CDATA[this is a url]]></PicUrl>
						 <MediaId><![CDATA[media_id]]></MediaId>
						 <MsgId>1234567890123456</MsgId>
						 </xml>',
				'voice'=>'<xml>
						<ToUserName><![CDATA[toUser]]></ToUserName>
						<FromUserName><![CDATA[fromUser]]></FromUserName>
						<CreateTime>1357290913</CreateTime>
						<MsgType><![CDATA[voice]]></MsgType>
						<MediaId><![CDATA[media_id]]></MediaId>
						<Format><![CDATA[Format]]></Format>
						<MsgId>1234567890123456</MsgId>
						</xml>',
				'video'=>'<xml>
						<ToUserName><![CDATA[toUser]]></ToUserName>
						<FromUserName><![CDATA[fromUser]]></FromUserName>
						<CreateTime>1357290913</CreateTime>
						<MsgType><![CDATA[video]]></MsgType>
						<MediaId><![CDATA[media_id]]></MediaId>
						<ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
						<MsgId>1234567890123456</MsgId>
						</xml>',
				'shortvideo'=>'<xml>
							<ToUserName><![CDATA[toUser]]></ToUserName>
							<FromUserName><![CDATA[fromUser]]></FromUserName>
							<CreateTime>1357290913</CreateTime>
							<MsgType><![CDATA[shortvideo]]></MsgType>
							<MediaId><![CDATA[media_id]]></MediaId>
							<ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
							<MsgId>1234567890123456</MsgId>
							</xml>',
				'location'=>'<xml>
							<ToUserName><![CDATA[toUser]]></ToUserName>
							<FromUserName><![CDATA[fromUser]]></FromUserName>
							<CreateTime>1351776360</CreateTime>
							<MsgType><![CDATA[location]]></MsgType>
							<Location_X>23.134521</Location_X>
							<Location_Y>113.358803</Location_Y>
							<Scale>20</Scale>
							<Label><![CDATA[位置信息]]></Label>
							<MsgId>1234567890123456</MsgId>
							</xml>',
				'link'=>'<xml>
						<ToUserName><![CDATA[toUser]]></ToUserName>
						<FromUserName><![CDATA[fromUser]]></FromUserName>
						<CreateTime>1351776360</CreateTime>
						<MsgType><![CDATA[link]]></MsgType>
						<Title><![CDATA[公众平台官网链接]]></Title>
						<Description><![CDATA[公众平台官网链接]]></Description>
						<Url><![CDATA[url]]></Url>
						<MsgId>1234567890123456</MsgId>
						</xml>',
				'event'=>$event_xml_arr,
				);
		$return = '';
		if($event){
			$return =$xml_data_arr['event'][$event];
		}else{
			$return =$xml_data_arr[$MsgType];
		}
		return $return;
	}
	
	
	
	/**
	 * 获得微信 回复消息 xml string
	 * @param unknown_type $MsgType
	 * @param unknown_type $event
	 */
	static function getWechatReponseXmlReturnString($MsgType){
		$xml_data_arr = array(
				'text'=>'<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[text]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						</xml>',
				'image'=>'<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[image]]></MsgType>
						<Image>
						<MediaId><![CDATA[%s]]></MediaId>
						</Image>
						</xml>',
				'voice'=>'<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[voice]]></MsgType>
						<Voice>
						<MediaId><![CDATA[%s]]></MediaId>
						</Voice>
						</xml>',
				'video'=>'<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[video]]></MsgType>
						<Video>
						<MediaId><![CDATA[%s]]></MediaId>
						<Title><![CDATA[%s]]></Title>
						<Description><![CDATA[%s]]></Description>
						</Video> 
						</xml>',
				'music'=>'<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[music]]></MsgType>
						<Music>
						<Title><![CDATA[%s]]></Title>
						<Description><![CDATA[%s]]></Description>
						<MusicUrl><![CDATA[%s]]></MusicUrl>
						<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
						<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
						</Music>
						</xml>',
				'news'=>'<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>%s</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						</Articles>
						</xml>',//图文回复，支持多图文 四条
				'news_sp'=>'<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>%s</ArticleCount>
						<Articles>
						',//图文回复， 特殊  需要处理 多图文 xml闭合问题
		);
		return isset($xml_data_arr[$MsgType])?$xml_data_arr[$MsgType]:'';
	}
	
	
	/**
	 * 客服接口-发消息 :
	 * 各消息类型所需的JSON数据 
	 * 这里返回 arr结构
	 * @param  $MsgType
	 * @param  $customservice 如果需要以某个客服帐号来发消息（在微信6.0.2及以上版本中显示自定义头像），则需在JSON数据包的后半部分加入customservice参数
	 */
	static function getWechatCustomSendMessageReturnArr($MsgType,$customservice='')
	{
		
		
		$msg_type_arr = array(
				"text"=>array("content"=>"Hello World"),
				"image"=>array("media_id"=>"MEDIA_ID"),
				"voice"=>array("media_id"=>"MEDIA_ID"),
				"video"=>array("media_id"	   =>"MEDIA_ID",
							   "thumb_media_id"=>"MEDIA_ID",
						       "title"         =>"TITLE",
						       "description"   =>"DESCRIPTION"),
				"music"=>array(   "title"=>"MUSIC_TITLE",
							      "description"=>"MUSIC_DESCRIPTION",
							      "musicurl"=>"MUSIC_URL",
							      "hqmusicurl"=>"HQ_MUSIC_URL",
							      "thumb_media_id"=>"THUMB_MEDIA_ID" ),
				"news"=>array('articles'=>array(
									array(
											"title"=>"Happy Day",
											"description"=>"Is Really A Happy Day",
											"url"=>"URL",
											"picurl"=>"PIC_URL"),//图文消息（点击跳转到外链） 图文消息条数限制在8条以内，注意，如果图文数超过8，则将会无响应。 
							)),
				'mpnews'=> array( "media_id"=>"MEDIA_ID"),//发送图文消息（点击跳转到图文消息页面） 图文消息条数限制在8条以内，注意，如果图文数超过8，则将会无响应。 
				'wxcard'=>array(   "card_id"=>"123dsdajkasd231jhksad",
         						   "card_ext"=>"{\"code\":\"\",\"openid\":\"\",\"timestamp\":\"1402057159\",\"signature\":\"017bb17407c8e0058a66d72dcc61632b70f511ad\"}"
								),//cardExt本身是一个JSON字符串 规则 自己去找
				);
		$return = array(
					  "touser"=>"OPENID",
    				  "msgtype"=>$MsgType,
			    	  $MsgType=>$msg_type_arr[$MsgType],
					);
		if($customservice){
			$return['customservice']=array( "kf_account"=>"test1@kftest" );
		}
		
		
		
	}
	
	
}