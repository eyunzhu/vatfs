<?php
/*
 * Project: webgeeker-validation
 * File: MyValidation2.php
 * CreateTime: 2019/3/13 18:35
 * Author: photondragon
 * Email: photondragon@163.com
 */

/**
 * @file MyValidation2.php
 * @brief brief description
 *
 * elaborate description
 */

namespace WebGeeker\ValidationTest;

use \WebGeeker\Validation\Validation;

/**
 * @class MyValidation2
 * @package WebGeeker\RestTest
 * @brief brief description
 *
 * elaborate description
 */
class MyValidation2 extends Validation
{
    // 新的“错误提示信息模版”翻译对照表
    protected static $langCode2ErrorTemplates = [
        "zh-tw" => [
            'Int' => '“{{param}}”必須是整數', // 🌝
            'IntGt' => '“{{param}}”必須大於 {{min}}',
            'Str' => '“{{param}}”必須是字符串',
        ],
        "en-us" => [
            'Int' => '{{param}} must be an integer',
            'IntGt' => '{{param}} must be greater than {{min}}',
            'Str' => '{{param}} must be a string',
        ],
    ];

    // 旧的“错误提示信息模版”翻译对照表（不建议使用）
    protected static $langCodeToErrorTemplates = [
        "zh-tw" => [
            "“{{param}}”必须是整数" => "“{{param}}”必須是整數啊",
            "“{{param}}”必须是字符串" => "“{{param}}”必須是字符串啊",
        ],
        "en-us" => [
            "“{{param}}”必须是整数" => "{{param}} must be a integer",
            "“{{param}}”必须是字符串" => "{{param}} must be string",
        ],
    ];

}