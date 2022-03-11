# PhpStorm配置Debug

## 首先确保我们的PHP开启了`xdebug扩展`

这个必要步骤，如果没有开启，或者开启过程中有问题，自行向搜索引擎找答案。

## php.ini 文件中配置
```php 
## 找到 `[Xdebug]` 项
...
[Xdebug]
zend_extension=D:/WorkSpace/CODING/phpstudy_pro/Extensions/php/php7.3.9nts/ext/php_xdebug.dll
xdebug.collect_params=1
xdebug.collect_return=1
xdebug.auto_trace=Off
xdebug.trace_output_dir=D:/WorkSpace/CODING/phpstudy_pro/Extensions/php_log/php7.3.9nts.xdebug.trace
xdebug.profiler_enable=Off
xdebug.profiler_output_dir=D:/WorkSpace/CODING/phpstudy_pro/Extensions/php_log/php7.3.9nts.xdebug.profiler
xdebug.remote_enable=On
xdebug.remote_mode=req
xdebug.remote_host=localhost
xdebug.remote_port=9100
xdebug.idekey=PHPSTORM
xdebug.remote_handler=dbgp
xdebug.overload_var_dump=0
...
```
## PhpStorm中的配置

### 1. 设置Xdebug
> File -> Settings -> PHP -> Debug -> Xdebug -> Debug port: 9100 (这里的port与上面配置中的 xdebug.remote_port=9100 相同) -> Apply <br>

### 创建一个Server
> File -> Settings -> PHP -> Servers -> + (选择“加号”，新增一个server) <br> 
> -> Name => fullstack.test (这里的Name随便填写，但后面会用到) <br>
> -> Host => fullstack.test, Port => 80, Debugger => Xdebug, 注意：不要选择“Use path mappings”，否则会报错“Remote file path 'XXX' is not mapped to any file path in project” <br>
> -> Apply

### 2. 编辑调试配置

选择IDE顶部的Run下面的“Edit Configurations...” (或IDE右上角选择“Edit Configurations...”)

> -> + (选择“PHP Web Page”) <br>
> -> Name => fullstack.test <br>
> -> Configuration -> Server => fullstack.test (选择刚刚创建的server) <br>
> -> Start URL: /
> -> Validate (Debug pre-configuration -> 点击 Validate)
> -> Local Web Server or Shared Folder
> -> Path to create validation script: D:\\WorkSpace\\PROJECT\\_php\\fullstack\\public
> -> Url to validation script: http://fullstack.test:80
> -> Validate (验证难过即表示配置OK)

## ApiPost工具的Debug调试

1. IDE右上角，先点击“电话”，绿色表示监听 `9100` 端口。
2. 打断点。(断点一旦打上，当程序执行到断点处时，则不会再继续运行)
3. 只有当点击“Resume Program”才会断续执行
4. 在断点处，把鼠标放置于断点所在行，会显示相关的输出。
5. 点击“Step Into”可以执行到下一步，通过它可以清晰地了解程序运行的全过程

**附**：[详细的PhpStorm与Xdebug的用法](https://www.php.cn/jishu/php/410116.html)(可以解决我们首次使用Xdebug的一些疑惑吧) <br>
> **注意**：生产环境禁止使用Xdebug，因为其非常消耗服务器资源。

## Xdebug自动断开

找到`httpd.conf`配置文件，添加如下配置：
```php 
... ## Other configurations

IPCConnectTimeout 3600
IPCCommTimeout 3600
```
