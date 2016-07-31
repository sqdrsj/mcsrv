<?php
function dnspod_freeset($domain,$login_token)
{
//dnspod创建新域名测试
$data=array(
			'login_token'=>$login_token,
			'domain'  =>$domain,
			'format'=>'json',
	);
$ch = curl_init(); //初始化
$options = array
(
	CURLOPT_USERAGENT => 'MC SRV /1.0.0(saomc@sina.com)',
	CURLOPT_URL => 'https://dnsapi.cn/Domain.Create',
	CURLOPT_TIMEOUT => 5,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_POSTFIELDS => http_build_query($data),
	CURLOPT_RETURNTRANSFER  => true,
);
curl_setopt_array($ch, $options);
$content=curl_exec($ch);
$content=json_decode($content, true); //执行curl并赋值给$content
curl_close($ch);
return $content;
}


function dnspod_freeset_srv($domain,$play_domain,$port,$srv_domain,$login_token)
{
//dnspod创建新子域名的解析测试
$data=array(
			'login_token' =>$login_token,
			'record_type' =>'SRV',//记录类型
			'domain'      =>$domain,//域名
			'value'       =>'5 0 '.$port.' '.$play_domain,// 记录值
			'sub_domain'  =>'_minecraft._tcp.'.$srv_domain,//主机记录, 如 www, 默认@，可选
			'ttl'         =>'3600',//TTL，范围1-604800
			'record_line' =>iconv("gb2312","UTF-8",'默认') ,//记录线路，通过API记录线路获得，中文，比如：默认, 必选
			'format'      =>'json',
	);
$ch = curl_init(); //初始化
$options = array
(
	CURLOPT_USERAGENT => 'MC SRV /1.0.0(saomc@sina.com)',
	CURLOPT_URL => 'https://dnsapi.cn/Record.Create',
	CURLOPT_TIMEOUT => 5,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_POSTFIELDS => http_build_query($data),
	CURLOPT_RETURNTRANSFER  => true,
);
curl_setopt_array($ch, $options);
$content=curl_exec($ch);
$content=json_decode($content, true); //执行curl并赋值给$content
curl_close($ch);
return $content;
}



function dnspod_freeset_srv_remove($domain,$play_domain,$port,$srv_domain,$record_id,$login_token)
{
//dnspod修改域名的解析测试
$data=array(
			'login_token' =>$login_token,
			'record_type' =>'SRV',//记录类型
			'domain'      =>$domain,//域名
			'value'       =>'5 0 '.$port.' '.$play_domain,// 记录值
			'sub_domain'  =>'_minecraft._tcp.'.$srv_domain,//主机记录, 如 www, 默认@，可选
			'ttl'         =>'3600',//TTL，范围1-604800
			'record_line' =>iconv("gb2312","UTF-8",'默认') ,//记录线路，通过API记录线路获得，中文，比如：默认, 必选
			'record_id'  =>$record_id,//记录ID
			'format'      =>'json',
	);
$ch = curl_init(); //初始化
$options = array
(
	CURLOPT_USERAGENT => 'MC SRV /1.0.0(saomc@sina.com)',
	CURLOPT_URL => 'https://dnsapi.cn/Record.Modify',
	CURLOPT_TIMEOUT => 5,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_POSTFIELDS => http_build_query($data),
	CURLOPT_RETURNTRANSFER  => true,
);
curl_setopt_array($ch, $options);
$content=curl_exec($ch);
$content=json_decode($content, true); //执行curl并赋值给$content
curl_close($ch);
return $content;
}











