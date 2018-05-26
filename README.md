
## swoole 运行
    php cli 模式运行 server.php (服务端) 即 php server.php
    
    index.html(客户端)
   
## swoole设置配置
    ```php
    $ws->set(
        array(
            'daemonize' => true,      // 是否是守护进程
            'max_request' => 10000,    // 最大连接数量
            'dispatch_mode' => 2,
            'debug_mode'=> 1,
            // 心跳检测的设置，自动踢掉掉线的fd
            'heartbeat_check_interval' => 5,
            'heartbeat_idle_time' => 600,
        )
    );
    ```
## 查看端口情况

    netstat -nutpl
    
## License
    MIT
