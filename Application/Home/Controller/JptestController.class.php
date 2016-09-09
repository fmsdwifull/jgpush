<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
vendor("JPush/JPush");
use JPush;


class JptestController extends Controller{

    
	public function  sendMessage()
    {
	    //url?app_key="+app_key+"&master_secret="+master_secret+"&operate="+operate+"&rid="+rid+"&title="+title+"&msg="+msg+"&json="+json
            //operate  1通知、2通知所有、3消息、4消息所有
		if(isset($_GET['app_key']))
		{
			$appKey = $_GET['app_key'];
			$masterSecret = $_GET['master_secret'];
			$operate = $_GET['operate'];
			$rid = $_GET['rid'];
			//$title = $_POST['title'];
			$title = $this->unicode2utf8($_GET['title']);
			//echo $title;
			$msg = $this->unicode2utf8($_GET['msg']);
			//$msg = $_GET['msg'];
			//echo $msg;

			$json = $_GET['json'];

			//echo "---";
			//print_r($json);

			$log_path = "/var/www/html/workdir/jpush.log";
			$client = new  \JPush($appKey, $masterSecret,$log_path,3);
			if($operate==1)
			{
				$result = $client->push()
					->setPlatform('all')
					->addRegistrationId($rid)//
					->addAndroidNotification($msg, $title, 1, json_decode($json,true))
					//->addAndroidNotification($msg, $title, 1,array("key1"=>"value1", "key2"=>"value2"))
					->send();
				echo json_encode($result);
			}elseif($operate==3){
					$result = $client->push()
					->setPlatform('all')
					->addRegistrationId($rid)//
					->setMessage($msg, $title, 'type', json_decode($json,true))
					->send();
				echo json_encode($result);
			}else{				 
				$result = $client->push()
					->setPlatform('all')
					->addAllAudience()
					->addAndroidNotification($msg, $title, 1, json_decode($json,true))
					->send();
				echo json_encode($result);
			}
		}else{
                echo "请传入参数";
            }
    }
	
	function unicode2utf8($str)
	{
	
        $str = '["' . $str . '"]';
        $decode = json_decode($str);
		//print_r($decode[0]); 
        return $decode[0]; 
	}
	
	function test()
	{
	//$str = "\u6210\u529f\u53d6\u8f66\uff0c\u5f00\u59cb\u8ba1\u65f6\u6536\u8d39\uff0c\u8d77\u6b65\u8d39\31\35\u5143\uff0c\u5143\u6bcf\u5206\u949f\u3002";
	$str = "\u6210\u529f\u53d6\u8f66\uff0c\u5f00\u59cb\u8ba1\u65f6\u6536\u8d39\uff0c\u8d77\u6b65\u8d39\u0033\u0035\u5143\uff0c\u5143\u6bcf\u5206\u949f\u3002";
        $str = '["' . $str . '"]';
        $decode = json_decode($str);
	//echo "-------------";
	print_r($decode); 
        //return $decode[0]; 
	}	



}

?>

