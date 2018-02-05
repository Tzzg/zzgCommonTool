<?php
/*
 * 此文件用于验证短信服务API接口，供开发时参考
 * 执行验证前请确保文件为utf-8编码，并替换相应参数为您自己的信息，并取消相关调用的注释
 * 建议验证前先执行Test.php验证PHP环境
 *
 * 2017/11/30
 */

namespace zzg\AliSmsLite;



class AliSmsConfig
{
    static function getAppId(){

        return env('ALISMS_ACCESSKEYID','');
    }


    static function getSecret(){

        return env('ALISMS_ACCESSKEYSECRET','');
    }
}