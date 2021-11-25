# oss-sdk
oss云存储
 public function cloud(Request $request,CloudFactory $cloudFactory){
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
        $obj=$cloudFactory->uploadCloud($type);
        $res=$obj->cloud($file,$config);
        if ($res){
            return $res;
        }
    }
//上传类型为 
'qiniu' 七牛云
'tencent' 腾讯
'aliyun' 阿里
