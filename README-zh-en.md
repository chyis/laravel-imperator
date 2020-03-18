# laravel-imperator

laravel-imperator 是基于 laravel 编写的多功能内容管理及发布系统。使用它可以快速的搭建文章发布系统、电商系统、小程序及微信公众号管理系统。



## 系统特点

- 内置多用户体系和Rbac权限系统

- 支持多中内容类型基础数据【文章、图库、电商、生活、问答等十余种】

- 可在操作平台快速构建数据表单和构建树状数据

- 支持字典扩展

- 支持前端页面内容扩展

- 支持`Laravel`的多种模型关系

- `mysql`、`mongodb`、`pgsql`等多数据库支持

- 提供丰富的artisan命令行工具和web视图实现操作

- 支持引入第三方前端库

- 支持自定义图表和界面

- 支持绝大多数常用web组件

- 支持本地和oss文件上传

- 支持多CDN互备模式

  

## 环境需求

- Composer

- PHP >= 7.0.0

- Laravel >= 5.5.0

  

## 安装流程

系统环境需要 PHP 7及以上版本、Laravel 5.5及以上版本。

首先, 安装 Laravel 5.5，确保 key 已经生成数据库连接配置正确。

```shell
composer require chyis/laravel-imperator
```

运行如下命令发布 assets 和 config 文件：

```shell
php artisan vendor:publish --provider="Chyis\Imperator\PublishServiceProvider"
```

运行成功后可以在 config 目录下找到  `config/imperator.php`， 文件中你可以设置本系统安装的位置，数据库连接以及数据表名。

最后运行如下命令完成系统的安装。

```shell
php artisan imperator:install 
```

打开你配置的网址（默认是 http://yoursitename/imperator ），然后用用户名 `admin` 和密码 `admin` 登录操作台。



## 指令运行

系统提供了诸多命令让开发者可以在系统环境里直接生成指定类型的系统文件，便于开发者进行扩展开发。当然这些功能都可以在操作台实现。方便众多站长们。

| 命令              | 作用          | 参数  |
| ---------------- | ------------- | ---- |
| `php artisan imperator:build` | 创建新的系统 | --app 生成位置 --type 系统类型 |
| `php artisan imperator:modify` | 修改已经存在的系统 |  |
| `php artisan imperator:remove` | 删除已经存在的系统 |  |
| `php artisan imperator:facades` | 引入前端组件 |      |
| `php artisan imperator:block` | 生成代码块 |      |



## 配置详情

配置文件 `config/imperator.php` 包含一系列可以自定义的配置项，通过这些配置项你可以自主选配所要搭建的系统。

| 配置名称 | 说明         |      |
| -------- | ------------ | ---- |
| siteName | 系统名称     | ~1.0 |
| appName  | 生成位置     | ~1.0 |
| facades  | 生成外观类型 | ~1.0 |
|          |              |      |
|          |              |      |

## License

`laravel-imperator`  is licensed under [The MIT License (MIT)](https://github.com/z-song/laravel-admin/blob/master/LICENSE).

