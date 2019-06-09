<?php

namespace app\common\model;

use think\Model;

class Attachment extends Model
{

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 定义字段类型
    protected $type = [
    ];

    public function setUploadtimeAttr($value)
    {
        return is_numeric($value) ? $value : strtotime($value);
    }

    protected static function init()
    {

    }

    public static function onBeforeInsert($data)
    {
        // 如果已经上传该资源，则不再记录
        if (self::where('url', '=', $data['url'])->find()) {
            return false;
        }
    }
}
