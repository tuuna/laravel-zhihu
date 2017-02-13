# laravel-zhihu
知乎仿站
使用Laravel5.4+Vue

- 使用Select2来完成标签联想
- 因为Laravel 5.3之后路由是单独放在Route文件夹中的，并且分为`web.php`以及`api.php`等，相应的文件中定义的路由不一样
- 使用repository模式分离控制器和模型
- 功能模块主要包括评论，点赞，关注，回答，提问
**在Laravel 5.4中需要注意的是npm或者cnpm的版本，
版本较低(如4.0.x)等很容易出现错误**

要注意的是Laravel 5.4中使用到的是Laravel-mix来打包资源（webpack）

使用的命令由
```$xslt
$ gulp
```

变成了
```$xslt
$ npm run dev/product
```

为了避免出现各种错误，可以先执行命令升级到4.1.2以上
```$xslt
$ npm install npm@latest -g
或者使用镜像的朋友
$ cnpm install cnpm@latest -g
```



