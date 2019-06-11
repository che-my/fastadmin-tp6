##FastAdmin ThinkPHP 6.0 tp6版本还在测试中,不适合商用，仅供学习使用
===============

> 运行环境要求PHP7.1+。
~~~
克隆本仓库代码 git clone https://github.com/che-my/fastadmin-tp6.git
~~~
~~~
安装依赖 composer install
tp6推荐使用环境变量env
cp .example.env .env

调试模式 
APP_DEBUG = true

trace调试模式，tp6已结做成全局中间件服务，需要在app\middleware.php文件里吧注释trace的服务那里取消注释就行
~~~

[在线体验](http://fatp6.cbjwww.cn)

> fastadmin升级tp6，

> 有以下BUG 暂待解决

>1.插件模块暂时使用不了

>2.在线命令管理模块，默认自定义控制器名称和自定义模型 这2个地方留空是正常的，能生成代码，但是有可能还是会有部分bug存在，建议还是自己手动写写代码也好

>3.以上2个bug，由于本人能力有限，修改力不从心，希望大家一起来参与修改更新

>4.其它bug，暂未发现

> 由于tp6的模块应用下的文件夹的控制器访问方式 
~~~
tp6路由
/模块/自定义文件夹/控制器/方法 访问失败，
统一转为：/模块/自定义文件夹.控制器/方法
例如 /admin/test/index/index ->访问失败
改成 /admin/test.index/index ->访问成功
~~~
## tp6文档

[完全开发手册](https://www.kancloud.cn/manual/thinkphp6_0/content)

## fastadmin文档

[fastadmin开发文档](https://www.kancloud.cn/manual/thinkphp6_0/content)


## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2019 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)
