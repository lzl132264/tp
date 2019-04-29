<?php

namespace Home\Controller;
use Think\Controller;
use Home\Controller\AlismsController;
class LoginController extends Controller{
	
	public function register(){
		if(IS_POST){
			#实例化User对象
			$user = D('user');
			
			#通过create()调用对应的模型进行自动验证 创建数据集
			if(!$data = $user->create())
			{
				#防止输出中文乱码
				header("Content-type:text/html;charset=utf-8");
				#输出对应的错误
				#例如:用户没有输入用户名,就提示
				#用户名不能为空
				exit($user->getError());
			}
			//如果输入的都符合条件
			//插入数据库
			if($id = $user->add($data)){
				$this->success('注册成功','login',1);
			} else {
				$this->error('注册失败');
			}
		}else{
			$this->display();
		}
	}
	
/**
     * 用户登录
     */
    public function login()
    {
        # 清空session之前保留的数据
        session('uname',null);

        # 判断提交方式
        if (IS_POST) {
            # 实例化Login对象
            $login = D('user');
            
            # 通过create()调用对应的模型进行自动验证 创建数据集
            # $data = 获取用户输入的信息
            if (!$data = $login->create()) {
                # 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                # 输出对应的错误
                # 例如：用户没有输入用户名，就提示
                # 用户名不能为空
                exit($login->getError());
            }

            // 组合查询条件
            $where = array();
            # $where['user_name']：数据库中的user_name字段
            # $data['user_name'：与此模型同名视图下的name名
            $where['phone'] = $data['phone'];
            $where['user_pwd'] = $data['user_pwd'];
            # 相当于：
            # select * from think_user where user_name=用户输入的user_name and user_repwd=用户输入的密码;
            # result输出为一个二维数组
            $result = $login->where($where)->select();
            if ($result) {  
                # 保存session
                # 将$result['user_name']值赋值给session,名字叫uname               
                session('uname', $result[0]['id']);
				session('name', $result[0]['name']);
                         
                $this->success('登录成功,正跳转至用户列表...','../Index/index', 1);
            } else {
                $this->error('登录失败,用户名或密码不正确!');
            }
        } else {
            $this->display();
        }
    }
	
	public function sendCode(){
	    $code = new AlismsController(); //此类存放在Common\Controller\
	    $code->code($_POST['iphone'],$msg);
		$this -> ajaxReturn($msg);
	}
	
	
}