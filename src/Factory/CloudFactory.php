<?php
namespace gaodewen\OssSdk\Factory;

use gaodewen\OssSdk\Service\Qiniu;

class CloudFactory
{
    const CLOUD_QINIU = 'qiniu';
    const SMS_TENCENT = 'tencent';
    const SMS_ALIYUN = 'aliyun';

    public function uploadCloud($type)
    {
        switch ($type){
            case self::CLOUD_QINIU:
                $obj= new Qiniu();
                break;
            case self::SMS_TENCENT:
               return null;
                break;
            default:
                return null;
        }
        return $obj;
    }

}
