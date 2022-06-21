<div align="center" style="display:flex;justify-content:center">
    <img src="https://www.ex-admin.com/logo.png" height="80"><h1 style="margin-left:10px">Ex-Admin</h3>
</div>
<br>
<p><code>Ex-Admin</code>是一个基于<a href="https://www.antdv.com/docs/vue/introduce-cn/" target="_blank">Ant Design of Vue</a>开发而成后台系统构建工具，无需关注页面模板JavaScript，只用php代码即可快速构建出一个功能完善的后台系统。。</p>


- [中文文档](https://www.ex-admin.com/doc)
- [Demo / 在线演示](https://demo.ex-admin.com)
- [github](https://github.com/rocky-git/ex-admin-laravel)
- [gitee(码云)](https://gitee.com/rocky-git/ex-admin-laravel)




![](https://www.ex-admin.com/img/1655645000903.png)




### 特性
- 灵活的设计，支持php各种框架接入
- 后台组件面向对象编程，组件化开发
- 自定义vue页面组件，无需重新编译打包
- 注解权限RBAC的权限系统,无限极菜单
- 数据表格构建工具，内置丰富的表格常用功能（如拖拽排序、数据导出、搜索、快捷创建、批量操作等）
- 数据表单构建工具，分步表单构建工具，内置丰富的表单类型，表单watch，表单互动
- 数据详情页构建工具
- 支持自定义图表

### 安装
首先需要安装 laravel 框架，如已安装可以跳过此步骤。如果您是第一次使用 laravel，请务必先阅读文档 <a href="https://learnku.com/docs/laravel/8.5/installation/10359" target="_blank">安装《Laravel 8 中文文档》</a> ！
```
composer create-project laravel/laravel 项目名称 ^8
# 或
composer create-project laravel/laravel 项目名称
```

安装完 laravel 之后需要修改.env 文件，设置数据库连接设置正确
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

安装 ex-admin

```
cd {项目名称}

composer require rockys/ex-admin-laravel
```

:::tip
执行这一步命令可能会报以下错误 Specified key was too long ... 767 bytes，如果出现这个报错，请在 app/Providers/AppServiceProvider.php 文件的 boot 方法中加上代码 Schema::defaultStringLength(191);，然后删除掉数据库中的所有数据表，再重新运行一遍 php artisan admin:install 命令即可
:::
然后运行下面的命令完成安装：
```
php artisan admin:install
```

启动服务后，在浏览器打开 http://localhost/admin，使用用户名 admin 和密码 admin 登陆

-----------------------------------


### Apache
```
<IfModule mod_rewrite.c>
  Options +FollowSymlinks -Multiviews
  RewriteEngine On

  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php?/$1 [QSA,PT,L]
</IfModule>
```

另外apache默认是没有开启Authorization请求头的，需要在 `httpd.conf` 配置以下规则


```dotenv
// 路径举例：D:\phpstudy_pro\Extensions\Apache2.4.39\conf
// 在httpd.conf搜索 IfModule dir_module 新增SefEnvIf这一行

<IfModule dir_module>
    DirectoryIndex index.php index.html
    SetEnvIf Authorization .+ HTTP_AUTHORIZATION=$0
</IfModule>
```

### Nginx
```
location / {
   if (!-e $request_filename) {
       rewrite  ^(.*)$  /index.php?s=/$1  last;
       break;
   }
}
```

### 鸣谢
`Ex-Admin` 基于以下组件:

+ [ThinkPhP](http://www.thinkphp.cn/)
+ [Element Plus](https://element-plus.gitee.io/)
+ [Ant Design Vue](https://www.antdv.com)
+ [Vue3](https://cn.vuejs.org/)
+ [font-awesome](http://fontawesome.io)
+ [echarts](https://echarts.apache.org/)
+ [simple-uploader.js](https://github.com/simple-uploader/Uploader)
+ [tinymce](https://www.tiny.cloud/)
+ [sortablejs](http://www.sortablejs.com/)


### License
------------
Ex-Admin遵循Apache2开源协议发布，并提供免费使用
