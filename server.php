<?php
$ws = new swoole_websocket_server("0.0.0.0", 9502);
  //$ws = new swoole_websocket_server("0.0.0.0", 9502,SWOOLE_PROCESS, SWOOLE_SOCK_TCP | SWOOLE_SSL); // 用户https 访问


// 设置配置
$ws->set(
    array(
        'daemonize' => true,      // 是否是守护进程
        'max_request' => 10000,    // 最大连接数量
        'dispatch_mode' => 2,
        'debug_mode'=> 1,
        // 心跳检测的设置，自动踢掉掉线的fd
        'heartbeat_check_interval' => 5,
        'heartbeat_idle_time' => 600,
        //'ssl_cert_file' => '/usr/local/nginx/ssl/www.good100.top/www.good100.top.crt', // 用户https 访问
        //'ssl_key_file' => '/usr/local/nginx/ssl/www.good100.top/www.good100.top.key', //用户https 访问

    )
);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    $ws->push($request->fd, "hello, welcome to chatroom\n");
});

//监听WebSocket消息事件，其他：swoole提供了bind方法，支持uid和fd绑定
$ws->on('message', function ($ws, $frame) {
    $msg = 'from'.$frame->fd.":{$frame->data}\n";

    // 分批次发送
    $start_fd = 0;
    while(true)
    {
        // connection_list函数获取现在连接中的fd
        $conn_list = $ws->connection_list($start_fd, 100);   // 获取从fd之后一百个进行发送
        var_dump($conn_list);
        echo count($conn_list);

        if($conn_list === false || count($conn_list) === 0)
        {
            echo "finish\n";
            return;
        }

        $start_fd = end($conn_list);
        
        foreach($conn_list as $fd)
        {
            $ws->push($fd, $msg);
        }
    }
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
    $ws->close($fd);   // 销毁fd链接信息
});

$ws->start();
