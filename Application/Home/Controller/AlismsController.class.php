<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\SignatureHelper;
class AlismsController extends Controller {
    
    public function _initialize(){
        $this->accessKeyId = "LTAI3Sz0NhKQVsKd"; //AccessKeyId
        $this->accessKeySecret = "Z49crpW60hr6dIjes1Xv7wN3oP93th"; //AccessKeySecret
        $this->SignName = "友才"; //签名
        $this->CodeId = "SMS_163526145"; //验证码模板ID
    }
    
    //发送验证码
    public function code($phone,&$msg){
        
        $params["PhoneNumbers"] = $phone; 
        $params["TemplateCode"] = $this->CodeId; //模板
        //记录存储验证码
        $code = rand(100000,999999);
        session("iphonecode",$code);//session存储手机号+验证码
        $params['TemplateParam'] = array("code" => $code); //验证码
		// $this->redirect('Login/register');
        return $this->send($params,$msg);        
    }
    
    // 验证手机号是否正确


    //发送短信消息
    private function send($params=[],&$msg){
        
        $params["SignName"] = $this->SignName;
        
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }
         $helper = new SignatureHelper();
        $content = $helper->request(
            $this->accessKeyId,
            $this->accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        );
        if($content===false){
            $msg = "发送异常";
            return false;
        }else{
            $data = (array)$content;
            if($data['Code']=="OK"){
                $msg = "发送成功";
                return true;
            }else{
                $msg = "发送失败 ".$data['Message'];
                return false;
            }
        }        
    }
}