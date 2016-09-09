<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台登陆</title>
    <link rel="stylesheet" type="text/css" href="/thinkphp_study/jg_push/Public/Common/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp_study/jg_push/Public/Common/easyui/css/admin.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp_study/jg_push/Public/Common/easyui/themes/icon.css">
    <script type="text/javascript" src="/thinkphp_study/jg_push/Public/Common/easyui/js/jquery.min.js"></script>
    <script type="text/javascript" src="/thinkphp_study/jg_push/Public/Common/easyui/js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/thinkphp_study/jg_push/Public/Common/easyui/js/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="/thinkphp_study/jg_push/Public/Common/easyui/js/common.js"></script>
    <script type="text/javascript" src="/thinkphp_study/jg_push/Public/Common/easyui/js/extends.js"></script>
    <script>
        /** 
        *  重载验证码
        */
        function fleshVerify(){
            var timenow = new Date().getTime();
            document.getElementById('verifyImg1').src= '<?php echo U("Home/Index/verifyx","","");?>'+'/'+timenow;
        }
    </script>

    <style>
        #container{
            margin: 150px auto;
            width: 392px;
        }
        #login{
            margin: 0 auto;
            width:100%;
            padding:30px 70px 20px 70px;
        }
    </style>
</head>
<body>
     <?php echo U('Index/mytest');?>
    <div id="container">
        <div id="login" class="easyui-panel" title="后台登陆" data-options="iconCls:'icon-application'">
            <form id="fmLogin" method="post" novalidate>
                <div style="margin-bottom:10px">
                    <input class="easyui-textbox" name="name"  style="width:100%;height:40px;padding:12px" data-options="prompt:'用户名',iconCls:'icon-man',iconWidth:38,validType:'length[5,15]',delay:'1000',required:true">
                </div>
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" type="password" name="pwd" id="pwd" style="width:100%;height:40px;padding:12px" data-options="prompt:'密码',iconCls:'icon-lock',iconWidth:38,validType:'length[5,20]',delay:'1000',required:true">
                </div> 
                <div style="margin-bottom:20px">
                    <input class="easyui-textbox" name="verify" style="width:100%;height:40px;padding:12px" data-options="prompt:'验证码',iconCls:'icon-cup',iconWidth:38,required:true,validType:'longness[4]'">
                </div>
                <div style="margin-bottom:20px">
                    <img id="verifyImg1" src="<?php echo U('Home/Index/verifyx');?>" title="点击刷新" align="absbottom" onClick="fleshVerify()" style="cursor:pointer;"/>
                </div>
                <div>
                    <a class="easyui-linkbutton" data-options="iconCls:'icon-ok'" style="padding:5px 0px;width:100%;" onclick="doLogin()">
                        <span style="font-size:14px;">登陆</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        //登陆
        function doLogin(){
            var url="<?php echo U('Login/checkLogin');?>";
            $('#fmLogin').form('submit',{
                url:url,
                onSubmit:function(){
                    return $(this).form('validate');
                },
                success:function(result){
                    var result=eval('('+result+')');
                    if(!result.status) $.messager.alert('登录提示',result.message,'error',function(){fleshVerify();});
                    else location.href="<?php echo U('Index/index');?>";
                }
            });
        }
    </script>
</body>
</html>