<?php
namespace Home\Controller;
use Think\Controller;
use Workerman\Worker;
class WorkermanController{
 
    /**
     * 构造函数
     * @access public
     */
    public function __construct(){
        $this->worker = new \Workerman\Worker('websocket://xxxx.com:8686');// 实例化 Websocket 服务
        $this->worker->count = 4;// 设置进程数
        $this->init();//初始化
        // 设置回调
        foreach (['onWorkerStart', 'onConnect', 'onMessage', 'onClose', 'onError', 'onBufferFull', 'onBufferDrain', 'onWorkerStop', 'onWorkerReload'] as $event) {
            if (method_exists($this, $event)) {
                $this->worker->$event = [$this, $event];
            }
        }
        // Run worker
        Worker::runAll();
    }
 
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $connection->send('收到消息');
    }
 
    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
        $connection->send('建立连接');
    }
 
    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        $connection->send('断开连接');
    }
 
    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }
 
    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {
 
    }
 
    public function init(){
 
    }
}