<?php
namespace gaodewen\OssSdk\service;

use gaodewen\OssSdk\Defineinterface\Cloud;
//引入七牛云SDK
use Qiniu\Config;
use Qiniu\Storage\BucketManager;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Qiniu implements Cloud
{
    public function cloud($file)
    {
        //本地的文件路径
        $localFilePath = $file['file']['tmp_name'];

        //截取文件后缀名
        //$suffix = '.jpg';
        $suffix = strtolower(substr($file['file']['name'],strpos($file['file']['name'],'.')));

        //生成一个唯一的文件名称,重命名 (md5加密原文件名+秒+随机数)
        $fileName = md5($file['file']['name']) . date('s',time()) . rand(1,9999999);
        $fileName .= $suffix;

        //上传七牛云业务逻辑
        $accessKey = 'FNbcGeNVSydTXAmq5gpXwT0IMSYCGgBi4c3A3nvb'; //去控制台的秘钥管理拿AK
        $secretKey = 'zA8AeRR0j9Tf1KlUgEcH6A0X4yBg1T5_Zq0kmi8Y';//去控制台的秘钥管理拿SK
        $auth = new Auth($accessKey, $secretKey);
        //七牛云桶名，根据自己实际进行填写
        $bucket = '1904cdn';
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $fileName, $localFilePath);

        //错误信息提示
        if ($err != null) {
            //可调整为错误页面
            $this->error('上传文件失败');
        }

        //把七牛云图片路径存储到我们自己的数据库  七牛云图片路径
        $imageUrl = 'http://1904cdn.gaodw.cn/' . $fileName;
        //入库业务逻辑 create save 只有这两个模型方法才能自动写入时间戳
        print_r($imageUrl);
//        $this->success('上传文件成功');
    }
}
