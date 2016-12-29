<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 微信配置
    |--------------------------------------------------------------------------
    |
    |  $options = array(
    |		'token'=>'tokenaccesskey', //填写应用接口的Token
 	|		'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey
 	|		'appid'=>'wxdk1234567890', //填写高级调用功能的app id
 	|		'appsecret'=>'xxxxxxxxxxxxxxxxxxx', //填写高级调用功能的密钥
 	|		'agentid'=>'1', //应用的id
 	|		'debug'=>false, //调试开关
 	|		'logcallback'=>'logg', //调试输出方法，需要有一个string类型的参数
 	|	);
    */
    'app' => array(

        'token' => env('WECHAT_TOKEN',''),
        'encodingaeskey' => env('WECHAT_ENCODINGAESKEY',''),
        'appid' => env('WECHAT_APPID',''),
        'appsecret' => env('WECHAT_APPSECRET',''),

    )

];