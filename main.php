<?php
/*
ʹ�÷���
url?play_domain=��Ҫӳ��ĵ�ַ&port=ԭ��ַ�˿�
&srv_domain=������������
&record_id=��¼id(ѡ��,��������Ϊ�޸�����,û����Ϊ�������)
�������� b-op
*/
include 'dnspod.php';										//dnspod api
header('Content-type: application/json');					//���Ϊjson
$login_token='';		//dnspod ��ȫ����
$domain = 'saomc.ml';										//Ĭ�� domain

if(!(isset($_REQUEST['play_domain'])&&isset($_REQUEST['srv_domain'])&&isset($_REQUEST['port'])))
{echo '{"errno":2,"errmsg":"Lack of parameter"}';return;}	//�ж� �����Ƿ���ȫ
/*
����û�жԲ������н�һ�����,�Ժ���������ж�
b-op
*/
$play_domain=$_REQUEST['play_domain'];
$srv_domain =$_REQUEST{'srv_domain'};
$port = $_REQUEST['port'];									//��ֵ

if(!isset($_REQUEST['record_id']))							//�Ƿ��м�¼id,û��Ϊ�������,����Ϊ�޸�����
{
$content=dnspod_freeset_srv($domain,$play_domain,$port,$srv_domain,$login_token);
															//����api ��ȡ���ص�����
if($content['status']['code']!=1)
{
	$res=array('errno'=>'3','errmsg'=>$content['status']['message']);
	echo json_encode($res);									//������Ϣ���
	return;													//����
}

$res=array(
'errno' =>'1',
'errmsg'=>iconv("gb2312","UTF-8",'ӳ��ɹ�,����Ϊ:'.$srv_domain.'.'.$domain.', ���סID,�޸ĺ�ɾ��������Ҫ'),
'record_id'    =>$content['record']['id'],					//�ɹ�,��Ϣ

);
echo json_encode($res);										//���
}

else														//�޸�srv������Ϣ
{
$record_id=$_REQUEST['record_id'];							//��ֵ��¼id
$content=dnspod_freeset_srv_remove($domain,$play_domain,$port,$srv_domain,$record_id,$login_token);
															//����api ��ȡ��������
if($content['status']['code']!=1)
{
	$res=array('errno'=>'4','errmsg'=>$content['status']['message']);
	echo json_encode($res);									//������Ϣ���
	return;													//����
}
$res=array(
'errno' =>'1',
'errmsg'=>iconv("gb2312","UTF-8",'�޸ĳɹ�,������Ϊ:'.$srv_domain.'.'.$domain.', ���ס��ID,�޸ĺ�ɾ��������Ҫ'),
'record_id'    =>$content['record']['record_id'],
);															//�ɹ�,��Ϣ
echo json_encode($res);										//���
}








	
