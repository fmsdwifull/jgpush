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


class JpushController extends Controller{
    public function test()
    //public function test($argc)
    {
        $httph =curl_init();
        curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($httph, CURLOPT_URL, "http://www.baidu.com");
        curl_setopt($httph, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($httph, CURLOPT_HEADER, 0);
        $output = curl_exec($httph);
        print_r($output);
        curl_close($httph);
    }
    
    public function pushinfo()
    {
        $br = '<br/>';
        $app_key='1dd37caa3b80f3cea9ccd593';
        $master_secret = 'd5b0b8dbb9fb58256044f731';
        // 初始化
        $client = new  \JPush($app_key, $master_secret);

        // 简单推送示例
        $result = $client->push()
            ->setPlatform('all')
            ->addAllAudience()
            ->setNotificationAlert('Hi, JPushxxx')
            ->send();

        echo 'Result=' . json_encode($result) . $br;

        // 完整的推送示例,包含指定Platform,指定Alias,Tag,指定iOS,Android notification,指定Message等
        $result = $client->push()
            ->setPlatform(array('ios', 'android'))
            ->addAlias('alias1')
            ->addTag(array('tag1', 'tag2'))
            ->setNotificationAlert('Hi, JPush')
            ->addAndroidNotification('Hi, android notification', 'notification title', 1, array("key1"=>"value1", "key2"=>"value2"))
            ->addIosNotification("Hi, iOS notification", 'iOS sound', JPush::DISABLE_BADGE, true, 'iOS category', array("key1"=>"value1", "key2"=>"value2"))
            ->setMessage("msg content", 'msg title', 'type', array("key1"=>"value1", "key2"=>"value2"))
            ->setOptions(100000, 3600, null, false)
            ->send();

        echo 'Result=' . json_encode($result) . $br;


        // 指定推送短信示例(推送未送达的情况下进行短信送达, 该功能需预付短信费用, 并调用Device API绑定设备与手机号)
        $result = $client->push()
            ->setPlatform('all')
            ->addTag('tag1')
            ->setNotificationAlert("Hi, JPush SMS")
            ->setSmsMessage('Hi, JPush SMS', 60)
            ->send();

        echo 'Result=' . json_encode($result) . $br;
    }
    
	public function  xxx2()
    {
        if(1)
        //if(isset($_POST))
        {
            //$array = $_POST;
            $array['registerId']="0403f0538b3";
            $array['text']="---------------";
                    
            $app_key='b04014b3748dd2ab3a5ae6b5';
            $master_secret = '74ae7799471b74a1817f6fc0';
            $client = new  \JPush($app_key, $master_secret);
            
            $result = $client->push()
                ->setPlatform('all')
                //->addTag($array['tag'])
                ->addRegistrationId($array['registerId'])
                //->addRegistrationId(array('0a07c361ea9'))
                ->setNotificationAlert($array['text'])
                ->send();
            echo 'Result=' . json_encode($result) . $br;
        }
    }
	
    
    public function  xxx()
    {
        if(1)
        //if(isset($_POST))
        {
            //$array = $_POST;
            $array['registerId']="865174020684921";
            $array['text']="---------------";
                    
            $app_key='dba01cbda029ec14a9e08c27';
            $master_secret = '09e9e2f6a67bc70f0a0741a5';
            $client = new  \JPush($app_key, $master_secret);
            
            $result = $client->push()
                ->setPlatform('all')
                //->addTag($array['tag'])
                ->addRegistrationId($array['registerId'])
                //->addRegistrationId(array('0a07c361ea9'))
                ->setNotificationAlert($array['text'])
                ->send();
            echo 'Result=' . json_encode($result) . $br;
        }
    }
    
    public function  sendMessage()
    {
        if(isset($_POST))
        {
            $array = $_POST;
            
            $app_key='dba01cbda029ec14a9e08c27';
            $master_secret = '09e9e2f6a67bc70f0a0741a5';
            $client = new  \JPush($app_key, $master_secret);
            
            $result = $client->push()
                ->setPlatform('all')
                //->addTag($array['tag'])
                ->addRegistrationId($array['registerId'])
                ->addAndroidNotification($array['text'], 'waitlg', 1, array("key"=>$array['tag'], "remark"=>$array['remark']))
                ->send();
            echo 'Result=' . json_encode($result) . $br;
        }
    }
    
    public function getReport()
    {
        $br = '<br/>';
        $app_key='dba01cbda029ec14a9e08c27';
        $master_secret = '09e9e2f6a67bc70f0a0741a5';

        // 初始化
        $client = new JPush($app_key, $master_secret);

        // 获取送达统计
        $response = $client->report()->getReceived('0709eed4a23'); // 也可以如此调用 ->getReceived('1150720279,1492401191,1150722083')
        echo 'Result=' . json_encode($response) . $br;

        // 获取消息统计
        $response = $client->report()->getMessages('0709eed4a23');
        echo 'Result=' . json_encode($response) . $br;

        // 获取用户统计
        //$response = $client->report()->getUsers('DAY', '2016-04-8', 3);
        //echo 'Result=' . json_encode($response) . $br;
    }


    public function pushinfoOld()
    {
        /*
        $br = '<br/>';
        $spilt = ' - ';

        $app_key='b0a6d7a1325a1ad4c0798578';
        $master_secret = '2a6dd01c5e130a4ef3222120';
        JPushLog::setLogHandlers(array(new StreamHandler('jpush.log', Logger::DEBUG)));
        $client = new JPushClient($app_key, $master_secret);

        //easy push
        try {
            $result = $client->push()
                ->setPlatform(M\all)
                ->setAudience(M\all)
                ->setNotification(M\notification('Hi, X'))
                //->printJSON()
                ->send();
            echo 'Push Success.' . $br;
            echo 'sendno : ' . $result->sendno . $br;
            echo 'msg_id : ' .$result->msg_id . $br;
            echo 'Response JSON : ' . $result->json . $br;
        } catch (APIRequestException $e) {
            echo 'Push Fail.' . $br;
            echo 'Http Code : ' . $e->httpCode . $br;
            echo 'code : ' . $e->code . $br;
            echo 'Error Message : ' . $e->message . $br;
            echo 'Response JSON : ' . $e->json . $br;
            echo 'rateLimitLimit : ' . $e->rateLimitLimit . $br;
            echo 'rateLimitRemaining : ' . $e->rateLimitRemaining . $br;
            echo 'rateLimitReset : ' . $e->rateLimitReset . $br;
        } catch (APIConnectionException $e) {
            echo 'Push Fail: ' . $br;
            echo 'Error Message: ' . $e->getMessage() . $br;
            //response timeout means your request has probably be received by JPUsh Server,please check that whether need to be pushed again.
            echo 'IsResponseTimeout: ' . $e->isResponseTimeout . $br;
        }

        echo $br . '-------------' . $br;

        // easy push with ios badge +1
        // 以下演示推送给 Android, IOS 平台下Tag为tag1的用户的示例
        try {
            $result = $client->push()
                ->setPlatform(M\Platform('android', 'ios'))
                ->setAudience(M\Audience(M\Tag(array('tag1'))))
                ->setNotification(M\notification('Hi, JPush',
                    M\android('Hi, Android', 'Message Title', 1, array("key1"=>"value1", "key2"=>"value2")),
                    M\ios("Hi, IOS", "happy", "+1", true, array("key1"=>"value1", "key2"=>"value2"), "Ios8 Category")
                ))
                ->setMessage(M\message('Message Content', 'Message Title', 'Message Type', array("key1"=>"value1", "key2"=>"value2")))
                ->printJSON()
                ->send();
            echo 'Push Success.' . $br;
            echo 'sendno : ' . $result->sendno . $br;
            echo 'msg_id : ' .$result->msg_id . $br;
            echo 'Response JSON : ' . $result->json . $br;
        } catch (APIRequestException $e) {
            echo 'Push Fail.' . $br;
            echo 'Http Code : ' . $e->httpCode . $br;
            echo 'code : ' . $e->code . $br;
            echo 'Error Message : ' . $e->message . $br;
            echo 'Response JSON : ' . $e->json . $br;
            echo 'rateLimitLimit : ' . $e->rateLimitLimit . $br;
            echo 'rateLimitRemaining : ' . $e->rateLimitRemaining . $br;
            echo 'rateLimitReset : ' . $e->rateLimitReset . $br;
        } catch (APIConnectionException $e) {
            echo 'Push Fail: ' . $br;
            echo 'Error Message: ' . $e->getMessage() . $br;
            //response timeout means your request has probably be received by JPUsh Server,please check that whether need to be pushed again.
            echo 'IsResponseTimeout: ' . $e->isResponseTimeout . $br;
        }

        echo $br . '-------------' . $br;


        //full push
        try {
            $result = $client->push()
                ->setPlatform(M\platform('ios', 'android'))
                ->setAudience(M\audience(M\tag(array('555','666')), M\alias(array('555', '666'))))
                ->setNotification(M\notification('Hi, JPush', M\android('Hi, android'), M\ios('Hi, ios', 'happy', 1, true, null, 'THE-CATEGORY')))
                ->setMessage(M\message('msg content', null, null, array('key'=>'value')))
                ->setOptions(M\options(123456, null, null, false, 0))
                ->printJSON()
                ->send();

            echo 'Push Success.' . $br;
            echo 'sendno : ' . $result->sendno . $br;
            echo 'msg_id : ' .$result->msg_id . $br;
            echo 'Response JSON : ' . $result->json . $br;
        } catch (APIRequestException $e) {
            echo 'Push Fail.' . $br;
            echo 'Http Code : ' . $e->httpCode . $br;
            echo 'code : ' . $e->code . $br;
            echo 'message : ' . $e->message . $br;
            echo 'Response JSON : ' . $e->json . $br;
            echo 'rateLimitLimit : ' . $e->rateLimitLimit . $br;
            echo 'rateLimitRemaining : ' . $e->rateLimitRemaining . $br;
            echo 'rateLimitReset : ' . $e->rateLimitReset . $br;
        } catch (APIConnectionException $e) {
            echo 'Push Fail: ' . $br;
            echo 'Error Message: ' . $e->getMessage() . $br;
            //response timeout means your request has probably be received by JPUsh Server,please check that whether need to be pushed again.
            echo 'IsResponseTimeout: ' . $e->isResponseTimeout . $br;
        }



        echo $br . '-------------' . $br;


        //fail push
        try {
            $result = $client->push()
                ->setPlatform(M\all)
                ->setAudience(M\all)
                ->setNotification(M\notification('Hi, JPush'))
                ->setAudience(M\audience(array('no one')))
                ->printJSON()
                ->send();

            echo 'Push Success.' . $br;
            echo 'sendno : ' . $result->sendno . $br;
            echo 'msg_id : ' .$result->msg_id . $br;
            echo 'Response JSON : ' . $result->json . $br;
        } catch (APIRequestException $e) {
            echo 'Push Fail.' . $br;
            echo 'Http Code : ' . $e->httpCode . $br;
            echo 'code : ' . $e->code . $br;
            echo 'message : ' . $e->message . $br;
            echo 'Response JSON : ' . $e->json . $br;
            echo 'rateLimitLimit : ' . $e->rateLimitLimit . $br;
            echo 'rateLimitRemaining : ' . $e->rateLimitRemaining . $br;
            echo 'rateLimitReset : ' . $e->rateLimitReset . $br;
        } catch (APIConnectionException $e) {
            echo 'Push Fail: ' . $br;
            echo 'Error Message: ' . $e->getMessage() . $br;
            //response timeout means your request has probably be received by JPUsh Server,please check that whether need to be pushed again.
            echo 'IsResponseTimeout: ' . $e->isResponseTimeout . $br;
        }
         *  
         */
    }


    public function _empty(){
         echo "xxxxxxxxxxx no the method";
    }
    
}


?>