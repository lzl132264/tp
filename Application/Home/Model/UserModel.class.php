<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
	 /**
     * 用户注册自动验证(静态验证：$_validate)
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
	protected $_validate = array(
		array('phone','require','用户名不能为空'),
		array('phone','require',0,'unique',1),
		array('user_pwd','require','密码不能为空'),
		array('yyy','yzm','验证码错误',0,'confirm'),
	);
	
	/**
     * 自动完成(用户注册成功之后)
     * @auther_start    小仓鼠
     * @auther_end      2018.04.15  小仓鼠
     * @return      无
     */
	protected $_auto = array(
		#对pass字段在新增和编辑的时候使md5函数处理
		array('user_pwd','md5',3,'function'),
	);
	
}