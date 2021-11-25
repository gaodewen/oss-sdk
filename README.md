# oss-sdk
oss云存储
<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use App\Http\Factory\CloudFactory;
use Illuminate\Http\Request;

class CloudController extends Controller
{
    public function cloud(Request $request,CloudFactory $cloudFactory){
        //接收文件上传的值
        $file = $_FILES;
        $type=$request->post('type');//上传的类型
        $obj=$cloudFactory->uploadCloud($type);
        $res=$obj->cloud($file);
        if ($res){
          // 返回结果
            return $res;
        }
    }
}
//上传类型为 
'qiniu' 七牛云
'tencent' 腾讯
'aliyun' 阿里
