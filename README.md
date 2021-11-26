# oss-sdk
oss云存储
一个集成阿里云、腾讯云、七牛云对象存储的工具类
An SDK integrating Alibaba cloud, Tencent cloud and qiniu cloud object storage
超级快速使用阿里云OSS或腾讯COS及七牛云Koa获取、放置、删除对象
Supper quick use Aliyun OSS or Tencent COS or Qiniu Koa to get、put、delete Object.

安装（Installation）
```php
composer require gaodewen/oss-sdk
```
案列（example）
```php
use gaodewen\OssSdk\Factory\CloudFactory;
  //接收文件上传的值
        $file = $_FILES;
        $type=$request->post('type');//上传的类型
        $config=[
            'ak'=>'',
            'sk'=>'',
            'region'=>'',//地区
            'bucket'=>'', //桶名
            'url'=>'' //加速域名
        ];
        $obj=new CloudFactory();
        $res=$obj->uploadCloud($type)->cloud($file,$config);
        if ($res){
            return $res;
        }
```
//上传类型为 
'qiniu' 七牛云
'tencent' 腾讯
'aliyun' 阿里
