# PhpStorm配置
## 1. 使用鼠标滚轮调整工作区的字体大小
> File -> Settings -> Editor -> General -> Mouse Control -> Change font size with Ctrl+Mouse Wheel
.

## 2. 设置文件的字符编码
> File -> Settings -> Editor -> File Encodings

## 3. 配置代码注释
> File -> Settings -> Editor -> File and Code Template -> Includes

### PHP File Header
```php 
/**
 * + ------------------------------------------------------ +
 * | Project Name: Study Laravel Fullstack Developement     |
 * + ------------------------------------------------------ +
 * | Copyright: (c) 2022-${YEAR} http://fullstack.test/     |
 * + ------------------------------------------------------ +
 * | License: MIT                                           |
 * + ------------------------------------------------------ +
 * | Author: Zell <jzell@qq.com>                            |
 * + ------------------------------------------------------ +
 * | Version: v1.0.0                                        |
 * + ------------------------------------------------------ +
 * @date ${DATE} ${HOUR}:${MINUTE}
 * @author Zell <jzell@qq.com>
 * @description 
 */
```
可以把优秀框架作者的注释拿来改下。

### Live Templates
> `Alt+Insert` -> Template Group... <br>
> 输入名字 MyTempGroup <br>
> 然后选择 MyTempGroup `Alt+Insert` -> Live Template <br>
```php
 /**
 * @name
 * @description
 * @author Zell <jzell@qq.com>
 * @date $date$ $time$
 * @method GET/POST
 * @param
 * @return JSON
 */
```

