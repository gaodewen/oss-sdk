<?php
namespace gaodewen\OssSdk\service;

use gaodewen\OssSdk\Defineinterface\Cloud;
use Qcloud\Cos\Client;
class TencentCloud implements Cloud{
    public function cloud($file){
        // SECRETID和SECRETKEY请登录访问管理控制台进行查看和管理
        $secretId = "AKID62EBrGPHsCG4dx1qOfgSxC9pFOGrBE0V"; //替换为用户的 secretId，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
        $secretKey = "GGzQaU7TUKuFKAk48wUmpc9PO6YjeIfl"; //替换为用户的 secretKey，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
        $region = "ap-shanghai"; //替换为用户的 region，已创建桶归属的region可以在控制台查看，https://console.cloud.tencent.com/cos5/bucket
        $cosClient = new Client(
            array(
                'region' => $region,
                'schema' => 'https', //协议头部，默认为http
                'credentials'=> array(
                    'secretId'  => $secretId ,
                    'secretKey' => $secretKey)));
        try {
            $bucket = "1904cdn-1306837605"; //存储桶名称 格式：BucketName-APPID
            $fileName=time();
            $key = $fileName; //此处的 key 为对象键，对象键是对象在存储桶中的唯一标识
            $srcPath = $file['file']['tmp_name'];//本地文件绝对路径
            $file = fopen($srcPath, "rb");
            if ($file) {
                $result = $cosClient->putObject(array(
                    'Bucket' => $bucket,
                    'Key' => $key,
                    'Body' => $file));
                print_r($result);
            }
        } catch (\Exception $e) {
            echo "$e\n";
        }
    }
}
