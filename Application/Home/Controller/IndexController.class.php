<?php


namespace Home\Controller;


use Think\Controller;

//require_once 'vendor/autoload.php';



class IndexController extends Controller {
	
    function mytest()
{ 
	$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}'; 
	var_dump(json_decode($json)); 
	var_dump(json_decode($json, true)); 


}
	
    function unicode_decode()  
    {  
		$name = "\u6b22\u8fce\u4f7f\u7528\u6c49\u5b57\u8f6c\u5316"; 
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码  
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';  
        preg_match_all($pattern, $name, $matches);  
        if (!empty($matches))  
        {  
            $name = '';  
            for ($j = 0; $j < count($matches[0]); $j++)  
            {  
                $str = $matches[0][$j];  
                if (strpos($str, '\\u') === 0)  
                {  
                    $code = base_convert(substr($str, 2, 2), 16, 10);  
                    $code2 = base_convert(substr($str, 4), 16, 10);  
                    $c = chr($code).chr($code2);  
                    $c = iconv('UCS-2', 'UTF-8', $c);  
                    $name .= $c;  
                }  
                else  
                {  
                    $name .= $str;  
                }  
            }  
        } 	
		echo $name;
        //return $name;  
    }  
	
	function unicode2utf8()
	{
		$str = "\u6b22\u8fce\u4f7f\u7528\u6c49\u5b57\u8f6c\u5316";

        $str = '["' . $str . '"]';
        $decode = json_decode($str);
		print_r($decode[0]); 
        //return $decode[0]; 
	}	
	
    public function indexx(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
 
    public function _empty(){
         echo "xxxxxxxxxxx no the method";
    }
    
    public function verifyx(){  
        $Verify = new \Think\Verify();  
        $Verify->fontSize = 18;  
        $Verify->length   = 4;  
        $Verify->useNoise = false;  
        $Verify->codeSet = '0123456789';  
        $Verify->imageW = 130;  
        $Verify->imageH = 50;  
        //$Verify->expire = 600;  
        $Verify->entry();  
    }
	
	public function login(){
		//echo "hi test";
		$this->display();
	}
        
        public function mytest()
        {
            echo "xxxxxxxxxxxxxxxxxxxxxxxxxx";
        }
    
    
}
