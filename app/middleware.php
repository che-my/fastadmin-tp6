<?php

return [
    // 全局请求缓存
    // 'think\middleware\CheckRequestCache',
    // 多语言加载
    // 'think\middleware\LoadLangPack',
    // Session初始化
    'think\middleware\SessionInit',
    // 页面Trace调试
    // 'think\middleware\TraceDebug',
    //模块中间件
    'app\common\middleware\ModuleInit',
    //表单验证中间件
    'app\common\middleware\FormValidate',
];
