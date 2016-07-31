<?php
/*
使用方法
url?play_domain=需要映射的地址&port=原地址端口
&srv_domain=域名的子域名
&record_id=记录id(选填,这里有则为修改域名,没有则为添加域名)
就是这样 b-op
*/
include 'dnspod.php';										//dnspod api
header('Content-type: application/json');					//输出为json
$login_token='';		//dnspod 安全密码
$domain = 'saomc.ml';										//默认 domain

if(!(isset($_REQUEST['play_domain'])&&isset($_REQUEST['srv_domain'])&&isset($_REQUEST['port'])))
{echo '{"errno":2,"errmsg":"Lack of parameter"}';return;}	//判断 参数是否齐全
/*
这里没有对参数进行进一步检测,以后会用正则判断
b-op
*/
$play_domain=$_REQUEST['play_domain'];
$srv_domain =$_REQUEST{'srv_domain'};
$port = $_REQUEST['port'];									//赋值

if(!isset($_REQUEST['record_id']))							//是否有记录id,没有为添加域名,有则为修改域名
{
$content=dnspod_freeset_srv($domain,$play_domain,$port,$srv_domain,$login_token);
															//连接api 获取返回的数组
if($content['status']['code']!=1)
{
	$res=array('errno'=>'3','errmsg'=>$content['status']['message']);
	echo json_encode($res);									//错误信息输出
	return;													//结束
}

$res=array(
'errno' =>'1',
'errmsg'=>iconv("gb2312","UTF-8",'映射成功,域名为:'.$srv_domain.'.'.$domain.', 请记住ID,修改和删除域名需要'),
'record_id'    =>$content['record']['id'],					//成功,信息

);
echo json_encode($res);										//输出
}

else														//修改srv域名信息
{
$record_id=$_REQUEST['record_id'];							//赋值记录id
$content=dnspod_freeset_srv_remove($domain,$play_domain,$port,$srv_domain,$record_id,$login_token);
															//连接api 获取返回数组
if($content['status']['code']!=1)
{
	$res=array('errno'=>'4','errmsg'=>$content['status']['message']);
	echo json_encode($res);									//错误信息输出
	return;													//结束
}
$res=array(
'errno' =>'1',
'errmsg'=>iconv("gb2312","UTF-8",'修改成功,新域名为:'.$srv_domain.'.'.$domain.', 请记住新ID,修改和删除域名需要'),
'record_id'    =>$content['record']['record_id'],
);															//成功,信息
echo json_encode($res);										//输出
}








	
