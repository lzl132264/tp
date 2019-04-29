<?php
	namespace Home\Controller;
	use Think\Controller;
	class IndexController extends Controller {
	  	public function index() { 
	  		$this->uid = I('uid'); 									//发信人ID，获取登录时ID，和下方message()中的I('uid')不同
	  		session('uid', $this->uid); 
	  		$this->display(); 
	  	} 
	  	function bind() { 
	  		$uid = I('uid'); 										//发信人ID
	  		$client_id = I('client_id'); 
	  		$gateway = new \Org\Util\Gateway(); 
	  		$gateway->bindUid($client_id, $uid);
			$message = '绑定成功' . $uid . '-' . $client_id; 
	  		$gateway->sendToUid($uid, $message); 
	  	}

	  	function message() { 
	  		$to_uid = I('uid'); 										//收信人ID
	  		$message = I('msg'); 
	  		$gateway = new \Org\Util\Gateway(); 
	  		$data['msg'] = $message; 
	  		$data['from_uid'] = I('uids'); 
	  		$data['to_uid'] = $to_uid; 
	  		$gateway->sendToUid($to_uid, json_encode($data)); 			//发给对方 
	  		echo json_encode($data); 
	  	}
	}