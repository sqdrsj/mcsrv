<?php
function dnspod_freeset($domain,$login_token)
{
//dnspod��������������
$data=array(
			'login_token'=>$login_token,
			'domain'  =>$domain,
			'format'=>'json',
	);
$ch = curl_init(); //��ʼ��
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
$content=json_decode($content, true); //ִ��curl����ֵ��$content
curl_close($ch);
return $content;
}


function dnspod_freeset_srv($domain,$play_domain,$port,$srv_domain,$login_token)
{
//dnspod�������������Ľ�������
$data=array(
			'login_token' =>$login_token,
			'record_type' =>'SRV',//��¼����
			'domain'      =>$domain,//����
			'value'       =>'5 0 '.$port.' '.$play_domain,// ��¼ֵ
			'sub_domain'  =>'_minecraft._tcp.'.$srv_domain,//������¼, �� www, Ĭ��@����ѡ
			'ttl'         =>'3600',//TTL����Χ1-604800
			'record_line' =>iconv("gb2312","UTF-8",'Ĭ��') ,//��¼��·��ͨ��API��¼��·��ã����ģ����磺Ĭ��, ��ѡ
			'format'      =>'json',
	);
$ch = curl_init(); //��ʼ��
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
$content=json_decode($content, true); //ִ��curl����ֵ��$content
curl_close($ch);
return $content;
}



function dnspod_freeset_srv_remove($domain,$play_domain,$port,$srv_domain,$record_id,$login_token)
{
//dnspod�޸������Ľ�������
$data=array(
			'login_token' =>$login_token,
			'record_type' =>'SRV',//��¼����
			'domain'      =>$domain,//����
			'value'       =>'5 0 '.$port.' '.$play_domain,// ��¼ֵ
			'sub_domain'  =>'_minecraft._tcp.'.$srv_domain,//������¼, �� www, Ĭ��@����ѡ
			'ttl'         =>'3600',//TTL����Χ1-604800
			'record_line' =>iconv("gb2312","UTF-8",'Ĭ��') ,//��¼��·��ͨ��API��¼��·��ã����ģ����磺Ĭ��, ��ѡ
			'record_id'  =>$record_id,//��¼ID
			'format'      =>'json',
	);
$ch = curl_init(); //��ʼ��
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
$content=json_decode($content, true); //ִ��curl����ֵ��$content
curl_close($ch);
return $content;
}











