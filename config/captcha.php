<?php

/**
 * @Author: che-my
 * @Date:   2019-06-02 21:06:36
 * @Last Modified by:   che-my
 * @Last Modified time: 2019-06-09 02:54:15
 */

return [
	// 验证码字符集合
    'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
    // 验证码字体大小(px)
    'fontSize' => 18,
    // 是否画混淆曲线
    'useCurve' => false,
    //使用中文验证码
    'useZh'    => false,
    // 验证码图片高度
    'imageH'   => 40,
    // 验证码图片宽度
    'imageW'   => 130,
    // 验证码位数
    'length'   => 4,
    // 验证成功后是否重置
    'reset'    => true
];