
## Swoole异步网络通信引擎
    Swoole：面向生产环境的 PHP 异步网络通信引擎
    使 PHP 开发人员可以编写高性能的异步并发 TCP、UDP、Unix、SocketHTTP， WebSocket 服务。Swoole 可以广泛应用于互联网、移动、通信、企业软件、云计算、网络游戏、物联网（IOT）、车联网、智能家居、等领域。</br> 使用 PHP + Swoole 作为网络通信框架，可以使企业  IT 、研发团队的效率大大提升，更加专注于开发创新产品</br>
    
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
