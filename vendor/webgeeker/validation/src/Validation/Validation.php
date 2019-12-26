<?php
/*
 * Project: simpleim-php
 * File: Validation.php
 * CreateTime: 16/11/6 17:22
 * Author: photondragon
 * Email: photondragon@163.com
 */
/**
 * @file Validation.php
 * @brief brief description
 *
 * elaborate description
 */

namespace WebGeeker\Validation;

/**
 * @class Validation
 * @package WebGeeker\Rest
 * @brief brief description
 *
 * elaborate description
 */
class Validation
{
    //region integer

    public static function validateInt($value, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false)
                return $value;
        } elseif ($type === 'integer') {
            return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('Int');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateIntEq($value, $equalVal, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val == $equalVal)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value == $equalVal)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntEq');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $equalVal, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntNe($value, $equalVal, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val != $equalVal)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value != $equalVal)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntNe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $equalVal, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntGt($value, $min, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val > $min)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value > $min)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntGt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntGe($value, $min, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val >= $min)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value >= $min)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntGe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntLt($value, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val < $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value < $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntLt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntLe($value, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntGtLt($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val > $min && $val < $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value > $min && $value < $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntGtLt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntGeLe($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val >= $min && $val <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value >= $min && $value <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntGeLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntGtLe($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val > $min && $val <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value > $min && $value <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntGtLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIntGeLt($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $val = intval($value);
                if ($val >= $min && $val < $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if ($value >= $min && $value < $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntGeLt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证IntIn: “{{param}}”只能取这些值: {{valueList}}
     * IntIn与StrIn的区别:
     * '0123' -> IntIn:123 通过; '0123' -> StrIn:123 不通过
     * @param $value string|int 参数值
     * @param $valueList string[] 可取值的列表
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return string
     * @throws ValidationException
     */
    public static function validateIntIn($value, $valueList, $reason = null, $alias = 'Parameter')
    {
        if (is_array($valueList) === false || count($valueList) === 0)
            throw new ValidationException("验证器IntIn的参数格式错误, 必须提供整数的列表, 以逗号分隔");

        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $intValue = intval($value);
                if (in_array($intValue, $valueList, true))
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if (in_array($value, $valueList, true))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntIn');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{valueList}}', implode(', ', $valueList), $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证IntNotIn: “{{param}}”不能取这些值: {{valueList}}
     * @param $value mixed 参数值
     * @param $valueList array 不可取的值的列表
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateIntNotIn($value, $valueList, $reason = null, $alias = 'Parameter')
    {
        if (is_array($valueList) === false || count($valueList) === 0)
            throw new ValidationException("验证器IntNotIn的参数格式错误, 必须提供整数的列表, 以逗号分隔");

        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value) && strpos($value, '.') === false) {
                $intValue = intval($value);
                if (!in_array($intValue, $valueList, true))
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'integer') {
            if (!in_array($value, $valueList, true))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Int');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('IntNotIn');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{valueList}}', implode(', ', $valueList), $error);
        }
        throw new ValidationException($error);
    }

    //endregion

    //region float

    public static function validateFloat($value, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value))
                return $value;
        } elseif ($type === 'double' || $type === 'integer')
            return $value;

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('Float');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateFloatGt($value, $min, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val > $min)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value > $min)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatGt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateFloatGe($value, $min, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val >= $min)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value >= $min)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatGe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateFloatLt($value, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val < $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value < $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatLt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateFloatLe($value, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateFloatGtLt($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val > $min && $val < $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value > $min && $value < $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatGtLt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateFloatGeLe($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val >= $min && $val <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value >= $min && $value <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatGeLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateFloatGtLe($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val > $min && $val <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value > $min && $value <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatGtLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateFloatGeLt($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'string') {
            if (is_numeric($value)) {
                $val = floatval($value);
                if ($val >= $min && $val < $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } elseif ($type === 'double' || $type === 'integer') {
            if ($value >= $min && $value < $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Float');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('FloatGeLt');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    //endregion

    //region bool

    public static function validateBool($value, $reason = null, $alias = 'Parameter')
    {
        if (is_bool($value)) {
            return $value;
        } else if (is_string($value)) {
            $valuelc = mb_strtolower($value);
            if ($valuelc === 'true' || $valuelc === 'false')
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('Bool');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateBoolTrue($value, $reason = null, $alias = 'Parameter')
    {
        if (is_bool($value) && $value) {
            return $value;
        } else if (is_string($value)) {
            $valuelc = mb_strtolower($value);
            if ($valuelc === 'true')
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('BoolTrue');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateBoolFalse($value, $reason = null, $alias = 'Parameter')
    {
        if (is_bool($value) && $value === false) {
            return $value;
        } else if (is_string($value)) {
            $valuelc = mb_strtolower($value);
            if ($valuelc === 'false')
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('BoolFalse');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateBoolSmart($value, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'boolean')
            return $value;
        else if ($type === 'string') {
            if (in_array(mb_strtolower($value), ['true', 'false', '1', '0', 'yes', 'no', 'y', 'n'], true))
                return $value;
        } else if ($type === 'integer') {
            if ($value === 0 || $value === 1)
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('BoolSmart');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateBoolSmartTrue($value, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'boolean' && $value)
            return $value;
        else if ($type === 'string') {
            if (in_array(mb_strtolower($value), ['true', '1', 'yes', 'y'], true))
                return $value;
        } else if ($type === 'integer') {
            if ($value === 1)
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('BoolSmartTrue');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateBoolSmartFalse($value, $reason = null, $alias = 'Parameter')
    {
        $type = gettype($value);
        if ($type === 'boolean' && $value === false)
            return $value;
        else if ($type === 'string') {
            if (in_array(mb_strtolower($value), ['false', '0', 'no', 'n'], true))
                return $value;
        } else if ($type === 'integer') {
            if ($value === 0)
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('BoolSmartFalse');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    //endregion

    //region string

    public static function validateStr($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('Str');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”必须等于 {{equalsValue}}
     * @param $value string 参数值
     * @param $equalsValue string 比较值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateStrEq($value, $equalsValue, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if ($value === $equalsValue)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrEq');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $equalsValue, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”不能等于 {{equalsValue}}
     * @param $value string 参数值
     * @param $equalsValue string 比较值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateStrNe($value, $equalsValue, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if ($value !== $equalsValue)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrNe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $equalsValue, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能取这些值: {{valueList}}
     * @param $value string 参数值
     * @param $valueList string[] 可取值的列表
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return string
     * @throws ValidationException
     */
    public static function validateStrIn($value, $valueList, $reason = null, $alias = 'Parameter')
    {
        if (is_array($valueList) === false || count($valueList) === 0)
            throw new ValidationException("“${alias}”参数的验证模版(StrIn:)格式错误, 必须提供可取值的列表");

        if (is_string($value)) {
            if (in_array($value, $valueList, true))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else if (count($valueList) === 1) {
            $error = self::getErrorTemplate('StrEq');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $valueList[0], $error);
        } else {
            $error = self::getErrorTemplate('StrIn');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{valueList}}', '"'.implode('", "', $valueList).'"', $error);
        }

        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”不能取这些值: {{valueList}}
     * @param $value mixed 参数值
     * @param $valueList array 不可取的值的列表
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateStrNotIn($value, $valueList, $reason = null, $alias = 'Parameter')
    {
        if (is_array($valueList) === false || count($valueList) === 0)
            throw new ValidationException("“${alias}”参数的验证模版(StrNotIn:)格式错误, 必须提供不可取的值的列表");

        if (is_string($value)) {
            if (!in_array($value, $valueList, true))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else if (count($valueList) === 1) {
            $error = self::getErrorTemplate('StrNe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $valueList[0], $error);
        } else {
            $error = self::getErrorTemplate('StrNotIn');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{valueList}}', '"'.implode('", "', $valueList).'"', $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”必须等于 {{equalsValue}}（忽略大小写）
     * @param $value string 参数值
     * @param $equalsValue string 比较值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateStrEqI($value, $equalsValue, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (strcasecmp($value, $equalsValue) === 0)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrEqI');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $equalsValue, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”不能等于 {{equalsValue}}（忽略大小写）
     * @param $value string 参数值
     * @param $equalsValue string 比较值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateStrNeI($value, $equalsValue, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (strcasecmp($value, $equalsValue) !== 0)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrNeI');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $equalsValue, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能取这些值: {{valueList}}（忽略大小写）
     * @param $value mixed 参数值
     * @param $valueList array 可取值的列表
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateStrInI($value, $valueList, $reason = null, $alias = 'Parameter')
    {
        if (is_array($valueList) === false || count($valueList) === 0)
            throw new ValidationException("“${alias}”参数的验证模版(StrInI:)格式错误, 必须提供可取值的列表");

        if (is_string($value)) {
            $lowerValue = mb_strtolower($value);
            foreach ($valueList as $v) {
                if (is_string($v) && mb_strtolower($v) === $lowerValue)
                    return $value;
            }
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else if (count($valueList) === 1) {
            $error = self::getErrorTemplate('StrEqI');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $valueList[0], $error);
        } else {
            $error = self::getErrorTemplate('StrInI');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{valueList}}', '"'.implode('", "', $valueList).'"', $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”不能取这些值: {{valueList}}（忽略大小写）
     * @param $value mixed 参数值
     * @param $valueList array 不可取的值的列表
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateStrNotInI($value, $valueList, $reason = null, $alias = 'Parameter')
    {
        if (is_array($valueList) === false || count($valueList) === 0)
            throw new ValidationException("“${alias}”参数的验证模版(StrNotInI:)格式错误, 必须提供不可取的值的列表");

        if (is_string($value)) {
            $lowerValue = mb_strtolower($value);
            foreach ($valueList as $v) {
                if (is_string($v) && mb_strtolower($v) === $lowerValue) {
                    $isTypeError = false;
                    goto VeriFailed;
                }
            }
            return $value;
        } else
            $isTypeError = true;

        VeriFailed:

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else if (count($valueList) === 1) {
            $error = self::getErrorTemplate('StrNeI');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{value}}', $valueList[0], $error);
        } else {
            $error = self::getErrorTemplate('StrNotInI');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{valueList}}', '"'.implode('", "', $valueList).'"', $error);
        }
        throw new ValidationException($error);
    }

    public static function validateStrLen($value, $length, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (mb_strlen($value) == $length)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrLen');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{length}}', $length, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateStrLenGe($value, $min, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (mb_strlen($value) >= $min)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrLenGe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateStrLenLe($value, $max, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (mb_strlen($value) <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrLenLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateStrLenGeLe($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        if ($min > $max)
            throw new ValidationException("“${alias}”参数的验证模版StrLenGeLe格式错误, min不应该大于max");

        if (is_string($value)) {
            $len = mb_strlen($value);
            if ($len >= $min && $len <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('StrLenGeLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateByteLen($value, $length, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (strlen($value) == $length)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ByteLen');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{length}}', $length, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateByteLenGe($value, $min, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (strlen($value) >= $min)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ByteLenGe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateByteLenLe($value, $max, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (strlen($value) <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ByteLenLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateByteLenGeLe($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        if ($min > $max)
            throw new ValidationException("“${alias}”参数的验证模版ByteLenGeLe格式错误, min不应该大于max");

        if (is_string($value)) {
            $len = strlen($value);
            if ($len >= $min && $len <= $max)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ByteLenGeLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能包含字母
     * @param $value mixed 参数值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateLetters($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (preg_match('/^[a-zA-Z]+$/', $value) === 1)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Letters');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能包含字母
     * 同Letters
     * @param $value mixed 参数值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateAlphabet($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (preg_match('/^[a-zA-Z]+$/', $value) === 1)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Alphabet');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能是纯数字
     * @param $value mixed 参数值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateNumbers($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (preg_match('/^[0-9]+$/', $value) === 1)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Numbers');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能是纯数字
     * 同Numbers
     * @param $value mixed 参数值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateDigits($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (preg_match('/^[0-9]+$/', $value) === 1)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Digits');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能包含字母和数字
     * @param $value mixed 参数值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateLettersNumbers($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $value) === 1)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('LettersNumbers');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”必须是数值
     * 一般用于大数处理（超过double表示范围的数,一般会用字符串来表示）
     * 如果是正常范围内的数, 可以使用'Int'或'Float'来检测
     * @param $value mixed 参数值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateNumeric($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (preg_match('/^\-?[0-9.]+$/', $value) === 1) {
                $count = 0; //小数点的个数
                $i = 0;
                while (($i = strpos($value, '.', $i)) !== false) {
                    $count++;
                    $i += 1;
                }
                if ($count === 0)
                    return $value;
                else if ($count === 1) {
                    if ($value !== '.' && $value !== '-.')
                        return $value;
                }
            }
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Numeric');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * 验证: “{{param}}”只能包含字母、数字和下划线，并且以字母或下划线开头
     * @param $value mixed 参数值
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateVarName($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $value) === 1)
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('VarName');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateEmail($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Email');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateUrl($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (filter_var($value, FILTER_VALIDATE_URL))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Url');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateIp($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (filter_var($value, FILTER_VALIDATE_IP))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Ip');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateMac($value, $reason = null, $alias = 'Parameter')
    {
        if (is_string($value)) {
            if (filter_var($value, FILTER_VALIDATE_MAC))
                return $value;
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Mac');
            $error = str_replace('{{param}}', $alias, $error);
        }
        throw new ValidationException($error);
    }

    /**
     * Perl正则表达式验证
     * @param $value string 参数值
     * @param $regexp string Perl正则表达式. 正则表达式内的特殊字符需要转义（包括/）. 首尾无需加/
     * @param $reason null|string 原因（当不匹配时用于错误提示）. 如果为null, 当不匹配时会提示 “${alias}”不匹配正则表达式$regexp
     * @param $alias string 参数别名, 用于错误提示
     * @return mixed
     * @throws ValidationException
     */
    public static function validateRegexp($value, $regexp, $reason = null, $alias = 'Parameter')
    {
        if (is_string($regexp) === false || $regexp === '')
            throw new ValidationException("“${alias}”参数的验证模版(Regexp:)格式错误, 没有提供正则表达式");

        if (is_string($value)) {
            $result = @preg_match($regexp, $value);
            if ($result === 1)
                return $value;
            else if ($result === false)
                throw new ValidationException("“${alias}”参数的正则表达式验证失败, 请检查正则表达式是否合法");
            $isTypeError = false;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Str');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('Regexp');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{regexp}}', $regexp, $error);
        }
        throw new ValidationException($error);
    }

    //endregion

    //region array

    public static function validateArr($value, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            $is = true;
            foreach ($value as $key => $val) {
                if (!is_integer($key)) {
                    $is = false;
                    break;
                }
            }
            if ($is)
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('Arr');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateArrLen($value, $length, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            $is = true;
            foreach ($value as $key => $val) {
                if (!is_integer($key)) {
                    $is = false;
                    break;
                }
            }
            if ($is) {
                if (count($value) == $length)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Arr');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ArrLen');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{length}}', $length, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateArrLenGe($value, $min, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            $is = true;
            foreach ($value as $key => $val) {
                if (!is_integer($key)) {
                    $is = false;
                    break;
                }
            }
            if ($is) {
                if (count($value) >= $min)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Arr');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ArrLenGe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateArrLenLe($value, $max, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            $is = true;
            foreach ($value as $key => $val) {
                if (!is_integer($key)) {
                    $is = false;
                    break;
                }
            }
            if ($is) {
                if (count($value) <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Arr');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ArrLenLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    public static function validateArrLenGeLe($value, $min, $max, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            $is = true;
            foreach ($value as $key => $val) {
                if (!is_integer($key)) {
                    $is = false;
                    break;
                }
            }
            if ($is) {
                $c = count($value);
                if ($c >= $min && $c <= $max)
                    return $value;
                $isTypeError = false;
            } else
                $isTypeError = true;
        } else
            $isTypeError = true;

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isTypeError) {
            $error = self::getErrorTemplate('Arr');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('ArrLenGeLe');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{min}}', $min, $error);
            $error = str_replace('{{max}}', $max, $error);
        }
        throw new ValidationException($error);
    }

    //endregion

    //region object

    /**
     * @param $value mixed
     * @param $reason string|null 验证失败的错误提示字符串. 如果为null, 则自动生成
     * @param string $alias
     * @return mixed
     * @throws ValidationException
     */
    public static function validateObj($value, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            $is = true;
            foreach ($value as $key => $val) {
                if (!is_string($key)) {
                    $is = false;
                    break;
                }
            }
            if ($is)
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('Obj');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    //endregion

    //region file

    private static function _throwFileUploadError($err, $isFilesArray, $alias, $fileIndex)
    {
        if ($isFilesArray)
            throw new ValidationException("“${alias}[$fileIndex]”上传失败(ERR=$err)");
        else
            throw new ValidationException("“${alias}”上传失败(ERR=$err)");
    }

    public static function validateFile($value, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            if (isset($value['name']) && isset($value['type']) &&
                isset($value['tmp_name']) && isset($value['error']) &&
                isset($value['size'])
            ) {

                if (is_array($value['error'])) {
                    $errors = $value['error'];
                    $isFilesArray = true;
                } else {
                    $errors = [$value['error']];
                    $isFilesArray = false;
                }

                for ($i = 0, $count = count($errors); $i < $count; $i++) {
                    $error = $errors[$i];
                    if ($error !== UPLOAD_ERR_OK) {
                        self::_throwFileUploadError($error, $isFilesArray, $alias, $i);
                    }
                }
                return $value;
            }
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('File');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateFileImage($value, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            if (isset($value['name']) && isset($value['type']) &&
                isset($value['tmp_name']) && isset($value['error']) &&
                isset($value['size'])
            ) {

                if (is_array($value['error'])) {
                    $errors = $value['error'];
                    $types = $value['type'];
                    $isFilesArray = true;
                } else {
                    $errors = [$value['error']];
                    $types = [$value['type']];
                    $isFilesArray = false;
                }

                $hasError = false;
                for ($i = 0, $count = count($errors); $i < $count; $i++) {
                    $error = $errors[$i];
                    $type = $types[$i];
                    if ($error === UPLOAD_ERR_OK) {
                        if (strpos($type, 'image/') !== 0) {
                            if ($isFilesArray)
                                $alias = "${alias}[$i]";
                            $hasError = true;
                            break;
                        }
                    } else {
                        self::_throwFileUploadError($error, $isFilesArray, $alias, $i);
                    }
                }
                if ($hasError === false)
                    return $value;
            }
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('FileImage');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateFileVideo($value, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            if (isset($value['name']) && isset($value['type']) &&
                isset($value['tmp_name']) && isset($value['error']) &&
                isset($value['size'])
            ) {

                if (is_array($value['error'])) {
                    $errors = $value['error'];
                    $types = $value['type'];
                    $isFilesArray = true;
                } else {
                    $errors = [$value['error']];
                    $types = [$value['type']];
                    $isFilesArray = false;
                }

                $hasError = false;
                for ($i = 0, $count = count($errors); $i < $count; $i++) {
                    $error = $errors[$i];
                    $type = $types[$i];
                    if ($error === UPLOAD_ERR_OK) {
                        if (strpos($type, 'video/') !== 0) {
                            if ($isFilesArray)
                                $alias = "${alias}[$i]";
                            $hasError = true;
                            break;
                        }
                    } else {
                        self::_throwFileUploadError($error, $isFilesArray, $alias, $i);
                    }
                }
                if ($hasError === false)
                    return $value;
            }
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('FileVideo');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateFileAudio($value, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            if (isset($value['name']) && isset($value['type']) &&
                isset($value['tmp_name']) && isset($value['error']) &&
                isset($value['size'])
            ) {

                if (is_array($value['error'])) {
                    $errors = $value['error'];
                    $types = $value['type'];
                    $isFilesArray = true;
                } else {
                    $errors = [$value['error']];
                    $types = [$value['type']];
                    $isFilesArray = false;
                }

                $hasError = false;
                for ($i = 0, $count = count($errors); $i < $count; $i++) {
                    $error = $errors[$i];
                    $type = $types[$i];
                    if ($error === UPLOAD_ERR_OK) {
                        if (strpos($type, 'audio/') !== 0) {
                            if ($isFilesArray)
                                $alias = "${alias}[$i]";
                            $hasError = true;
                            break;
                        }
                    } else {
                        self::_throwFileUploadError($error, $isFilesArray, $alias, $i);
                    }
                }
                if ($hasError === false)
                    return $value;
            }
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('FileAudio');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateFileMimes($value, $mimes, $originMimesString = null, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            if (isset($value['name']) && isset($value['type']) &&
                isset($value['tmp_name']) && isset($value['error']) &&
                isset($value['size'])
            ) {

                if (is_array($value['error'])) {
                    $errors = $value['error'];
                    $types = $value['type'];
                    $isFilesArray = true;
                } else {
                    $errors = [$value['error']];
                    $types = [$value['type']];
                    $isFilesArray = false;
                }

                $hasError = false;
                for ($i = 0, $count = count($errors); $i < $count; $i++) {
                    $error = $errors[$i];
                    $type = $types[$i];
                    if ($error === UPLOAD_ERR_OK) {
                        $match = false;
                        foreach ($mimes as $mime) {
                            // mime中必定有斜杠
                            if (strpos($mime, '/') === 0) // 斜杠在开头, 需要完全尾部匹配
                            {
                                if (($pos = strpos($type, $mime)) !== false && $pos + strlen($mime) === strlen($type)) // 匹配mime
                                {
                                    $match = true;
                                    break;
                                }
                            } else // 斜杠不在开头, 需要头部完全匹配
                            {
                                if (strpos($type, $mime) === 0) // 匹配mime
                                {
                                    $match = true;
                                    break;
                                }
                            }
                        }

                        if ($match === false) {
                            if ($isFilesArray)
                                $alias = "${alias}[$i]";
                            $hasError = true;
                            break;
                        }
                    } else {
                        self::_throwFileUploadError($error, $isFilesArray, $alias, $i);
                    }
                }
                if ($hasError === false)
                    return $value;
            }
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if (strlen($originMimesString) === 0)
            $originMimesString = implode(',', $mimes);

        $error = self::getErrorTemplate('FileMimes');
        $error = str_replace('{{param}}', $alias, $error);
        $error = str_replace('{{mimes}}', $originMimesString, $error);
        throw new ValidationException($error);
    }

    public static function validateFileMaxSize($value, $maxSize, $originSizeString = null, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            if (isset($value['name']) && isset($value['type']) &&
                isset($value['tmp_name']) && isset($value['error']) &&
                isset($value['size'])
            ) {

                if (is_array($value['error'])) {
                    $errors = $value['error'];
                    $sizes = $value['size'];
                    $isFilesArray = true;
                } else {
                    $errors = [$value['error']];
                    $sizes = [$value['size']];
                    $isFilesArray = false;
                }

                $hasError = false;
                for ($i = 0, $count = count($errors); $i < $count; $i++) {
                    $error = $errors[$i];
                    $size = $sizes[$i];
                    if ($error === UPLOAD_ERR_OK) {
                        if ($size > $maxSize) // 超过上限
                        {
                            if ($isFilesArray)
                                $alias = "${alias}[$i]";
                            $hasError = true;
                            break;
                        }
                    } else {
                        self::_throwFileUploadError($error, $isFilesArray, $alias, $i);
                    }
                }
                if ($hasError === false)
                    return $value;
            }
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if (strlen($originSizeString) === 0)
            $originSizeString = (string)$maxSize;

        $error = self::getErrorTemplate('FileMaxSize');
        $error = str_replace('{{param}}', $alias, $error);
        $error = str_replace('{{size}}', $originSizeString, $error);
        throw new ValidationException($error);
    }

    public static function validateFileMinSize($value, $minSize, $originSizeString = null, $reason = null, $alias = 'Parameter')
    {
        if (is_array($value)) {
            if (isset($value['name']) && isset($value['type']) &&
                isset($value['tmp_name']) && isset($value['error']) &&
                isset($value['size'])
            ) {

                if (is_array($value['error'])) {
                    $errors = $value['error'];
                    $sizes = $value['size'];
                    $isFilesArray = true;
                } else {
                    $errors = [$value['error']];
                    $sizes = [$value['size']];
                    $isFilesArray = false;
                }

                $hasError = false;
                for ($i = 0, $count = count($errors); $i < $count; $i++) {
                    $error = $errors[$i];
                    $size = $sizes[$i];
                    if ($error === UPLOAD_ERR_OK) {
                        if ($size < $minSize) // 没到下限
                        {
                            if ($isFilesArray)
                                $alias = "${alias}[$i]";
                            $hasError = true;
                            break;
                        }
                    } else {
                        self::_throwFileUploadError($error, $isFilesArray, $alias, $i);
                    }
                }
                if ($hasError === false)
                    return $value;
            }
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if (strlen($originSizeString) === 0)
            $originSizeString = (string)$minSize;

        $error = self::getErrorTemplate('FileMinSize');
        $error = str_replace('{{param}}', $alias, $error);
        $error = str_replace('{{size}}', $originSizeString, $error);
        throw new ValidationException($error);
    }

    //endregion

    //region date & time

    public static function validateDate($value, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d$/', $value);
        if ($result === 1) {
            if (strtotime($value) !== false)
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('Date');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateDateFrom($value, $fromTimestamp, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d$/', $value);

        if ($result === 1) {

            $timestamp = strtotime($value);
            if ($timestamp !== false) {
                if ($timestamp >= $fromTimestamp)
                    return $value;

                $isFormatError = false;
            } else {
                $isFormatError = true;
            }
        } else {
            $isFormatError = true;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isFormatError) {
            $error = self::getErrorTemplate('Date');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('DateFrom');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{from}}', date('Y-m-d', $fromTimestamp), $error);
        }
        throw new ValidationException($error);
    }

    public static function validateDateTo($value, $toTimestamp, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d$/', $value);

        if ($result === 1) {

            $timestamp = strtotime($value);
            if ($timestamp !== false) {
                if ($timestamp <= $toTimestamp)
                    return $value;

                $isFormatError = false;
            } else {
                $isFormatError = true;
            }
        } else {
            $isFormatError = true;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isFormatError) {
            $error = self::getErrorTemplate('Date');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('DateTo');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{to}}', date('Y-m-d', $toTimestamp), $error);
        }
        throw new ValidationException($error);
    }

    public static function validateDateFromTo($value, $fromTimestamp, $toTimestamp, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d$/', $value);

        if ($result === 1) {

            $timestamp = strtotime($value);
            if ($timestamp !== false) {
                if ($timestamp >= $fromTimestamp && $timestamp <= $toTimestamp)
                    return $value;

                $isFormatError = false;
            } else {
                $isFormatError = true;
            }
        } else {
            $isFormatError = true;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isFormatError) {
            $error = self::getErrorTemplate('Date');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('DateFromTo');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{from}}', date('Y-m-d', $fromTimestamp), $error);
            $error = str_replace('{{to}}', date('Y-m-d', $toTimestamp), $error);
        }
        throw new ValidationException($error);
    }

    public static function validateDateTime($value, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d \d\d:\d\d:\d\d$/', $value);
        if ($result === 1) {
            if (strtotime($value) !== false)
                return $value;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        $error = self::getErrorTemplate('DateTime');
        $error = str_replace('{{param}}', $alias, $error);
        throw new ValidationException($error);
    }

    public static function validateDateTimeFrom($value, $fromTimestamp, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d \d\d:\d\d:\d\d$/', $value);

        if ($result === 1) {

            $timestamp = strtotime($value);
            if ($timestamp !== false) {
                if ($timestamp >= $fromTimestamp)
                    return $value;

                $isFormatError = false;
            } else {
                $isFormatError = true;
            }
        } else {
            $isFormatError = true;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isFormatError) {
            $error = self::getErrorTemplate('DateTime');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('DateTimeFrom');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{from}}', date('Y-m-d H:i:s', $fromTimestamp), $error);
        }
        throw new ValidationException($error);
    }

    public static function validateDateTimeTo($value, $toTimestamp, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d \d\d:\d\d:\d\d$/', $value);

        if ($result === 1) {

            $timestamp = strtotime($value);
            if ($timestamp !== false) {
                if ($timestamp < $toTimestamp)
                    return $value;

                $isFormatError = false;
            } else {
                $isFormatError = true;
            }
        } else {
            $isFormatError = true;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isFormatError) {
            $error = self::getErrorTemplate('DateTime');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('DateTimeTo');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{to}}', date('Y-m-d H:i:s', $toTimestamp), $error);
        }
        throw new ValidationException($error);
    }

    public static function validateDateTimeFromTo($value, $fromTimestamp, $toTimestamp, $reason = null, $alias = 'Parameter')
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d \d\d:\d\d:\d\d$/', $value);

        if ($result === 1) {

            $timestamp = strtotime($value);
            if ($timestamp !== false) {
                if ($timestamp >= $fromTimestamp && $timestamp < $toTimestamp)
                    return $value;

                $isFormatError = false;
            } else {
                $isFormatError = true;
            }
        } else {
            $isFormatError = true;
        }

        if ($reason !== null)
            throw new ValidationException($reason);

        if ($isFormatError) {
            $error = self::getErrorTemplate('DateTime');
            $error = str_replace('{{param}}', $alias, $error);
        } else {
            $error = self::getErrorTemplate('DateTimeFromTo');
            $error = str_replace('{{param}}', $alias, $error);
            $error = str_replace('{{from}}', date('Y-m-d H:i:s', $fromTimestamp), $error);
            $error = str_replace('{{to}}', date('Y-m-d H:i:s', $toTimestamp), $error);
        }
        throw new ValidationException($error);
    }

    //endregion

    //region ifs

    protected static function validateIf($value)
    {
        if (is_string($value))
            $value = mb_strtolower($value);
        return in_array($value, [1, true, '1', 'true', 'yes', 'y'], true);
    }

    protected static function validateIfNot($value)
    {
        if (is_string($value))
            $value = mb_strtolower($value);
        return in_array($value, [0, false, '0', 'false', 'no', 'n'], true);
    }

    protected static function validateIfTrue($value)
    {
        if (is_string($value))
            return (mb_strtolower($value) === 'true');
        else
            return ($value === true);
    }

    protected static function validateIfFalse($value)
    {
        if (is_string($value))
            return (mb_strtolower($value) === 'false');
        else
            return ($value === false);
    }

    protected static function validateIfExist($value)
    {
        return ($value !== null);
    }

    protected static function validateIfNotExist($value)
    {
        return ($value === null);
    }

    protected static function validateIfIntEq($value, $compareVal)
    {
        return ($value === $compareVal || $value === "$compareVal");
    }

    protected static function validateIfIntNe($value, $compareVal)
    {
        return !($value === $compareVal || $value === "$compareVal");
    }

    protected static function validateIfIntGt($value, $compareVal)
    {
        if (is_string($value)) {

            if (is_numeric($value) && strpos($value, '.') === false)
                return (intval($value) > $compareVal);
            else
                return false;
        } else if (is_integer($value)) {
            return ($value > $compareVal);
        }
        return false;
    }

    protected static function validateIfIntGe($value, $compareVal)
    {
        if (is_string($value)) {

            if (is_numeric($value) && strpos($value, '.') === false)
                return (intval($value) >= $compareVal);
            else
                return false;
        } else if (is_integer($value)) {
            return ($value >= $compareVal);
        }
        return false;
    }

    protected static function validateIfIntLt($value, $compareVal)
    {
        if (is_string($value)) {

            if (is_numeric($value) && strpos($value, '.') === false)
                return (intval($value) < $compareVal);
            else
                return false;
        } else if (is_integer($value)) {
            return ($value < $compareVal);
        }
        return false;
    }

    protected static function validateIfIntLe($value, $compareVal)
    {
        if (is_string($value)) {

            if (is_numeric($value) && strpos($value, '.') === false)
                return (intval($value) <= $compareVal);
            else
                return false;
        } else if (is_integer($value)) {
            return ($value <= $compareVal);
        }
        return false;
    }

    protected static function validateIfIntIn($value, $valuesList)
    {
        if (is_string($value)) {
            if (is_numeric($value) && strpos($value, '.') === false)
                $value = intval($value);
            else
                return false;
        } else if (is_integer($value) === false)
            return false;
        return in_array($value, $valuesList, true);
    }

    protected static function validateIfIntNotIn($value, $valuesList)
    {
        if (is_string($value)) {
            if (is_numeric($value) && strpos($value, '.') === false)
                $value = intval($value);
            else
                return true;
        } else if (is_integer($value) === false)
            return true;
        return !in_array($value, $valuesList, true);
    }

    protected static function validateIfStrEq($value, $compareVal)
    {
        return ($value === $compareVal);
    }

    protected static function validateIfStrNe($value, $compareVal)
    {
        return ($value !== $compareVal);
    }

    protected static function validateIfStrGt($value, $compareVal)
    {
        if (is_string($value)) {
            return (strcmp($value, $compareVal) > 0);
        }
        return false;
    }

    protected static function validateIfStrGe($value, $compareVal)
    {
        if (is_string($value)) {
            return (strcmp($value, $compareVal) >= 0);
        }
        return false;
    }

    protected static function validateIfStrLt($value, $compareVal)
    {
        if (is_string($value)) {
            return (strcmp($value, $compareVal) < 0);
        }
        return false;
    }

    protected static function validateIfStrLe($value, $compareVal)
    {
        if (is_string($value)) {
            return (strcmp($value, $compareVal) <= 0);
        }
        return false;
    }

    protected static function validateIfStrIn($value, $valuesList)
    {
        if (is_string($value) === false) // 不是字符串
            return false;
        return in_array($value, $valuesList, true);
    }

    protected static function validateIfStrNotIn($value, $valuesList)
    {
        if (is_string($value) === false) // 不是字符串
            return true;
        return !in_array($value, $valuesList, true);
    }

    //endregion

    // 当前语言代码
    static protected $langCode = '';

    /**
     * 设置当前语言代码。默认lang code是空串""（无效的）
     * @param $langCode string 语言代码
     */
    static public function setLangCode($langCode)
    {
        if (is_string($langCode))
            self::$langCode = $langCode;
    }

    /**
     * @var array “错误提示信息模版”翻译对照表
     * @deprecated 0.4 从0.4版开始，
     *     使用新的翻译表 static::$langCode2ErrorTemplates, 格式简化了。
     *     旧的翻译表 static::$langCodeToErrorTemplates 仍然有效。
     *     如果新旧翻译表同时提供，优先新的，新表中查不到再使用旧的。
     */
    protected static $langCodeToErrorTemplates = [
//        'en-us' => [],
    ];

    /**
     * @var array “错误提示信息模版”翻译对照表。
     * 完整的“错误提示信息模版”可在成员变量 $errorTemplates 中找到
     * 从0.4版开始，使用新的翻译表取代旧的, 简化了格式。
     * 旧的翻译表 static::$langCodeToErrorTemplates 仍然有效。
     * 如果新旧翻译表同时提供，优先新的，新表中查不到再使用旧的。
     */
    protected static $langCode2ErrorTemplates = [
//        "zh-tw" => [
//            'Int' => '“{{param}}”必須是整數',
//            'IntGt' => '“{{param}}”必須大於 {{min}}',
//            'Str' => '“{{param}}”必須是字符串',
//        ],
//        "en-us" => [
//            'Int' => '{{param}} must be an integer',
//            'IntGt' => '{{param}} must be greater than {{min}}',
//            'Str' => '{{param}} must be a string',
//        ],
    ];

    private static function getErrorTemplate($validator)
    {
        if (isset(static::$langCode2ErrorTemplates[self::$langCode])) {
            $errorTemplates = static::$langCode2ErrorTemplates[self::$langCode];
            if (is_array($errorTemplates) && isset($errorTemplates[$validator])) {
                $errorTemplate = $errorTemplates[$validator];
                if (is_string($errorTemplate) && strlen($errorTemplate))
                    return $errorTemplate;
            }
        }

        $template = self::$errorTemplates[$validator];
        if (isset(static::$langCodeToErrorTemplates[self::$langCode])) {
            $templates = static::$langCodeToErrorTemplates[self::$langCode];
            if (is_array($templates) && isset($templates[$template])) {
                $newTemplate = $templates[$template];
                if (is_string($newTemplate) && strlen($newTemplate))
                    return $newTemplate;
            }
        }
        return $template;
    }

    // 文本翻译对照表
    protected static $langCodeToTranslations = [
//        "en-us" => [],
    ];

    private static function translateText($text)
    {
        if (isset(static::$langCodeToTranslations[self::$langCode])) {
            $translations = static::$langCodeToTranslations[self::$langCode];
            if (is_array($translations) && isset($translations[$text])) {
                $newText = $translations[$text];
                if (is_string($newText) && strlen($newText))
                    return $newText;
            }
        }
        return $text;
    }

    /**
     * @var array 验证失败时的错误提示信息的模板
     *
     * 输入值一般为字符串
     */
    static private $errorTemplates = [
        // 整型（不提供length检测,因为负数的符号位会让人混乱, 可以用大于小于比较来做到这一点）
        'Int' => '“{{param}}”必须是整数',
        'IntEq' => '“{{param}}”必须等于 {{value}}',
        'IntNe' => '“{{param}}”不能等于 {{value}}',
        'IntGt' => '“{{param}}”必须大于 {{min}}',
        'IntGe' => '“{{param}}”必须大于等于 {{min}}',
        'IntLt' => '“{{param}}”必须小于 {{max}}',
        'IntLe' => '“{{param}}”必须小于等于 {{max}}',
        'IntGtLt' => '“{{param}}”必须大于 {{min}} 小于 {{max}}',
        'IntGeLe' => '“{{param}}”必须大于等于 {{min}} 小于等于 {{max}}',
        'IntGtLe' => '“{{param}}”必须大于 {{min}} 小于等于 {{max}}',
        'IntGeLt' => '“{{param}}”必须大于等于 {{min}} 小于 {{max}}',
        'IntIn' => '“{{param}}”只能取这些值: {{valueList}}',
        'IntNotIn' => '“{{param}}”不能取这些值: {{valueList}}',

        // 浮点型（内部一律使用double来处理）
        'Float' => '“{{param}}”必须是浮点数',
        'FloatGt' => '“{{param}}”必须大于 {{min}}',
        'FloatGe' => '“{{param}}”必须大于等于 {{min}}',
        'FloatLt' => '“{{param}}”必须小于 {{max}}',
        'FloatLe' => '“{{param}}”必须小于等于 {{max}}',
        'FloatGtLt' => '“{{param}}”必须大于 {{min}} 小于 {{max}}',
        'FloatGeLe' => '“{{param}}”必须大于等于 {{min}} 小于等于 {{max}}',
        'FloatGtLe' => '“{{param}}”必须大于 {{min}} 小于等于 {{max}}',
        'FloatGeLt' => '“{{param}}”必须大于等于 {{min}} 小于 {{max}}',

        // bool型
        'Bool' => '“{{param}}”必须是bool型(true or false)', // 忽略大小写
        'BoolSmart' => '“{{param}}”只能取这些值: true, false, 1, 0, yes, no, y, n（忽略大小写）',
        'BoolTrue' => '“{{param}}”必须为true',
        'BoolFalse' => '“{{param}}”必须为false',
        'BoolSmartTrue' => '“{{param}}”只能取这些值: true, 1, yes, y（忽略大小写）',
        'BoolSmartFalse' => '“{{param}}”只能取这些值: false, 0, no, n（忽略大小写）',

        // 字符串
        'Str' => '“{{param}}”必须是字符串',
        'StrEq' => '“{{param}}”必须等于"{{value}}"',
        'StrEqI' => '“{{param}}”必须等于"{{value}}"（忽略大小写）',
        'StrNe' => '“{{param}}”不能等于"{{value}}"',
        'StrNeI' => '“{{param}}”不能等于"{{value}}"（忽略大小写）',
        'StrIn' => '“{{param}}”只能取这些值: {{valueList}}',
        'StrInI' => '“{{param}}”只能取这些值: {{valueList}}（忽略大小写）',
        'StrNotIn' => '“{{param}}”不能取这些值: {{valueList}}',
        'StrNotInI' => '“{{param}}”不能取这些值: {{valueList}}（忽略大小写）',
        // todo StrSame:var 检测某个参数是否等于另一个参数, 比如password2要等于password
        'StrLen' => '“{{param}}”长度必须等于 {{length}}', // 字符串长度
        'StrLenGe' => '“{{param}}”长度必须大于等于 {{min}}',
        'StrLenLe' => '“{{param}}”长度必须小于等于 {{max}}',
        'StrLenGeLe' => '“{{param}}”长度必须在 {{min}} - {{max}} 之间', // 字符串长度
        'ByteLen' => '“{{param}}”长度（字节）必须等于 {{length}}', // 字符串长度
        'ByteLenGe' => '“{{param}}”长度（字节）必须大于等于 {{min}}',
        'ByteLenLe' => '“{{param}}”长度（字节）必须小于等于 {{max}}',
        'ByteLenGeLe' => '“{{param}}”长度（字节）必须在 {{min}} - {{max}} 之间', // 字符串长度
        'Letters' => '“{{param}}”只能包含字母',
        'Alphabet' => '“{{param}}”只能包含字母', // 同Letters
        'Numbers' => '“{{param}}”只能是纯数字',
        'Digits' => '“{{param}}”只能是纯数字', // 同Numbers
        'LettersNumbers' => '“{{param}}”只能包含字母和数字',
        'Numeric' => '“{{param}}”必须是数值', // 一般用于大数处理（超过double表示范围的数,一般会用字符串来表示）, 如果是正常范围内的数, 可以使用'Int'或'Float'来检测
        'VarName' => '“{{param}}”只能包含字母、数字和下划线，并且以字母或下划线开头',
        'Email' => '“{{param}}”不是合法的email',
        'Url' => '“{{param}}”不是合法的Url地址',
        'Ip' => '“{{param}}”不是合法的IP地址',
        'Mac' => '“{{param}}”不是合法的MAC地址',
        'Regexp' => '“{{param}}”不匹配正则表达式“{{regexp}}”', // Perl正则表达式匹配. 目前不支持modifiers. http://www.rexegg.com/regex-modifiers.html

        // 数组. 如何检测数组长度为0
        'Arr' => '“{{param}}”必须是数组',
        'ArrLen' => '“{{param}}”长度必须等于 {{length}}',
        'ArrLenGe' => '“{{param}}”长度必须大于等于 {{min}}',
        'ArrLenLe' => '“{{param}}”长度必须小于等于 {{max}}',
        'ArrLenGeLe' => '“{{param}}”长度必须在 {{min}} ~ {{max}} 之间',

        // 对象
        'Obj' => '“{{param}}”必须是对象',

        // 文件
        'File' => '“{{param}}”必须是文件',
        'FileMaxSize' => '“{{param}}”必须是文件, 且文件大小不超过{{size}}',
        'FileMinSize' => '“{{param}}”必须是文件, 且文件大小不小于{{size}}',
        'FileImage' => '“{{param}}”必须是图片',
        'FileVideo' => '“{{param}}”必须是视频文件',
        'FileAudio' => '“{{param}}”必须是音频文件',
        'FileMimes' => '“{{param}}”必须是这些MIME类型的文件:{{mimes}}',

        // Date & Time
        'Date' => '“{{param}}”必须符合日期格式YYYY-MM-DD',
        'DateFrom' => '“{{param}}”不得早于 {{from}}',
        'DateTo' => '“{{param}}”不得晚于 {{to}}',
        'DateFromTo' => '“{{param}}”必须在 {{from}} ~ {{to}} 之间',
        'DateTime' => '“{{param}}”必须符合日期时间格式YYYY-MM-DD HH:mm:ss',
        'DateTimeFrom' => '“{{param}}”不得早于 {{from}}',
        'DateTimeTo' => '“{{param}}”必须早于 {{to}}',
        'DateTimeFromTo' => '“{{param}}”必须在 {{from}} ~ {{to}} 之间',
//        'Time' => '“{{param}}”必须符合时间格式HH:mm:ss或HH:mm',
//        'TimeZone' => 'TimeZone:timezone_identifiers_list()',

        // 其它
        'Required' => '必须提供“{{param}}”',

//        // 预处理（只处理字符串类型, 如果是其它类型, 则原值返回）
//        'Trim' => '', // 对要检测的值先作一个trim操作, 后续的检测是针对trim后的值进行检测
//        'Lowercase' => '', // 将要检测的值转为小写, 后续的检测是针对转换后的值进行检测
//        'Uppercase' => '', // 将要检测的值转为大写, 后续的检测是针对转换后的值进行检测
//        'ToInt' => '', // 预处理为int型
//        'ToString' => '', // 预处理为string型（这个一般用不到）
    ];

    // 所有验证器格式示例
    static private $sampleFormats = [
        // 整型（不提供length检测,因为负数的符号位会让人混乱, 可以用大于小于比较来做到这一点）
        'Int' => 'Int',
        'IntEq' => 'IntEq:100',
        'IntNe' => 'IntNe:100',
        'IntGt' => 'IntGt:100',
        'IntGe' => 'IntGe:100',
        'IntLt' => 'IntLt:100',
        'IntLe' => 'IntLe:100',
        'IntGtLt' => 'IntGtLt:1,100',
        'IntGeLe' => 'IntGeLe:1,100',
        'IntGtLe' => 'IntGtLe:1,100',
        'IntGeLt' => 'IntGeLt:1,100',
        'IntIn' => 'IntIn:2,3,5,7,11',
        'IntNotIn' => 'IntNotIn:2,3,5,7,11',

        // 浮点型（内部一律使用double来处理）
        'Float' => 'Float',
        'FloatGt' => 'FloatGt:1.0',
        'FloatGe' => 'FloatGe:1.0',
        'FloatLt' => 'FloatLt:1.0',
        'FloatLe' => 'FloatLe:1.0',
        'FloatGtLt' => 'FloatGtLt:0,1.0',
        'FloatGeLe' => 'FloatGeLe:0,1.0',
        'FloatGtLe' => 'FloatGtLe:0,1.0',
        'FloatGeLt' => 'FloatGeLt:0,1.0',

        // bool型
        'Bool' => 'Bool',
        'BoolSmart' => 'BoolSmart',
        'BoolTrue' => 'BoolTrue',
        'BoolFalse' => 'BoolFalse',
        'BoolSmartTrue' => 'BoolSmartTrue',
        'BoolSmartFalse' => 'BoolSmartFalse',

        // 字符串
        'Str' => 'Str',
        'StrEq' => 'StrEq:abc',
        'StrEqI' => 'StrEqI:abc',
        'StrNe' => 'StrNe:abc',
        'StrNeI' => 'StrNeI:abc',
        'StrIn' => 'StrIn:abc,def,g',
        'StrInI' => 'StrInI:abc,def,g',
        'StrNotIn' => 'StrNotIn:abc,def,g',
        'StrNotInI' => 'StrNotInI:abc,def,g',
        'StrLen' => 'StrLen:8',
        'StrLenGe' => 'StrLenGe:8',
        'StrLenLe' => 'StrLenLe:8',
        'StrLenGeLe' => 'StrLenGeLe:6,8',
        'ByteLen' => 'ByteLen:8',
        'ByteLenGe' => 'ByteLenGe:8',
        'ByteLenLe' => 'ByteLenLe:8',
        'ByteLenGeLe' => 'ByteLenGeLe:6,8',
        'Letters' => 'Letters',
        'Alphabet' => 'Alphabet', // 同Letters
        'Numbers' => 'Numbers',
        'Digits' => 'Digits', // 同Numbers
        'LettersNumbers' => 'LettersNumbers',
        'Numeric' => 'Numeric',
        'VarName' => 'VarName',
        'Email' => 'Email',
        'Url' => 'Url',
        'Ip' => 'Ip',
        'Mac' => 'Mac',
        'Regexp' => 'Regexp:/^abc$/', // Perl正则表达式匹配

        // 数组. 如何检测数组长度为0
        'Arr' => 'Arr',
        'ArrLen' => 'ArrLen:5',
        'ArrLenGe' => 'ArrLenGe:1',
        'ArrLenLe' => 'ArrLenLe:9',
        'ArrLenGeLe' => 'ArrLenGeLe:1,9',

        // 对象
        'Obj' => 'Obj',

        // 文件
        'File' => 'File',
        'FileMaxSize' => 'FileMaxSize:10mb',
        'FileMinSize' => 'FileMinSize:100kb',
        'FileImage' => 'FileImage',
        'FileVideo' => 'FileVideo',
        'FileAudio' => 'FileAudio',
        'FileMimes' => 'FileMimes:mpeg,jpeg,png',

        // Date & Time
        'Date' => 'Date',
        'DateFrom' => 'DateFrom:2017-04-13',
        'DateTo' => 'DateTo:2017-04-13',
        'DateFromTo' => 'DateFromTo:2017-04-13,2017-04-13',
        'DateTime' => 'DateTime',
        'DateTimeFrom' => 'DateTimeFrom:2017-04-13 12:00:00',
        'DateTimeTo' => 'DateTimeTo:2017-04-13 12:00:00',
        'DateTimeFromTo' => 'DateTimeFromTo:2017-04-13 12:00:00,2017-04-13 12:00:00',
//        'Time' => 'Time',
//        'TimeZone' => 'TimeZone:timezone_identifiers_list()',

        // 其它
        'Required' => 'Required',

        // 条件判断
        'If' => 'If:selected', // 值是否等于 1, true, '1', 'true', 'yes', 'y'(字符串忽略大小写)
        'IfNot' => 'IfNot:selected', // 值是否等于 0, false, '0', 'false', 'no', 'n'(字符串忽略大小写)
        'IfTrue' => 'IfTrue:selected', // 值是否等于 true 或 'true'(忽略大小写)
        'IfFalse' => 'IfFalse:selected', // 值是否等于 false 或 'false'(忽略大小写)
        'IfExist' => 'IfExist:var', // 参数 var 是否存在
        'IfNotExist' => 'IfNotExist:var', // 参数 var 是否不存在
        'IfIntEq' => 'IfIntEq:var,1', // if (type === 1)
        'IfIntNe' => 'IfIntNe:var,2', // if (state !== 2). 特别要注意的是如果条件参数var的数据类型不匹配, 那么If条件是成立的; 而其它几个IfIntXx当条件参数var的数据类型不匹配时, If条件不成立
        'IfIntGt' => 'IfIntGt:var,0', // if (var > 0)
        'IfIntLt' => 'IfIntLt:var,1', // if (var < 0)
        'IfIntGe' => 'IfIntGe:var,6', // if (var >= 6)
        'IfIntLe' => 'IfIntLe:var,8', // if (var <= 8)
        'IfIntIn' => 'IfIntIn:var,2,3,5,7', // if (in_array(var, [2,3,5,7]))
        'IfIntNotIn' => 'IfIntNotIn:var,2,3,5,7', // if (!in_array(var, [2,3,5,7]))
        'IfStrEq' => 'IfStrEq:var,waiting', // if (type === 'waiting')
        'IfStrNe' => 'IfStrNe:var,editing', // if (state !== 'editing'). 特别要注意的是如果条件参数var的数据类型不匹配, 那么If条件是成立的; 而其它几个IfStrXx当条件参数var的数据类型不匹配时, If条件不成立
        'IfStrGt' => 'IfStrGt:var,a', // if (var > 'a')
        'IfStrLt' => 'IfStrLt:var,z', // if (var < 'z')
        'IfStrGe' => 'IfStrGe:var,A', // if (var >= '0')
        'IfStrLe' => 'IfStrLe:var,Z', // if (var <= '9')
        'IfStrIn' => 'IfStrIn:var,normal,warning,error', // if (in_array(var, ['normal', 'warning', 'error'], true))
        'IfStrNotIn' => 'IfStrNotIn:var,warning,error', // if (!in_array(var, ['warning', 'error'], true))
//        'IfSame' => 'IfSame:AnotherParameter',
//        'IfNotSame' => 'IfNotSame:AnotherParameter',
//        'IfAny' => 'IfAny:type,1,type,2', //待定

//        // 预处理（只处理字符串类型, 如果是其它类型, 则原值返回）
//        'Trim' => 'Trim',
//        'Lowercase' => 'Lowercase',
//        'Uppercase' => 'Uppercase',
//        'ToInt' => 'ToInt',
//        'ToString' => 'ToString',
    ];

    /**
     * 将验证器(Validator)编译为验证子(Validator Unit)的数组
     *
     * 示例1:
     * 输入: $validator = 'StrLen:6,16|regex:/^[a-zA-Z0-9]+$/'
     * 输出: [
     *     'countOfIfs' => 0,
     *     'required' => false,
     *     'units' => [
     *         ['StrLen', 6, 16],
     *         ['regex', '/^[a-zA-Z0-9]+$/'],
     *     ],
     *     'reason' => null,
     *     'alias' => $alias,
     * ]
     *
     * 示例2（自定义验证失败的提示）:
     * 输入: $validator = 'StrLen:6,16|regex:/^[a-zA-Z0-9]+$/|>>>:参数验证失败了'
     * 输出: [
     *     'countOfIfs' => 0,
     *     'required' => false,
     *     'units' => [
     *         ['StrLen', 6, 16],
     *         ['regex', '/^[a-zA-Z0-9]+$/'],
     *     ],
     *     'reason' => $reason,
     *     'alias' => $alias,
     * ]
     *
     * @param $validator string 一条验证字符串
     * @param $alias string 参数的别名. 如果验证器中包含Alias:xxx, 会用xxx取代这个参数的值
     * @return array 返回包含验证信息的array
     * @throws ValidationException
     */
    private static function _compileValidator($validator, $alias)
    {
        if (is_string($validator) === false)
            throw new ValidationException("编译Validator失败: Validator必须是字符串");;
        if (strlen($validator) === 0) {
            return [
                'countOfIfs' => 0,
                'required' => false,
                'units' => [],
            ];
        }

        $countOfIfs = 0; //Ifxxx的个数
//        $ifUnits = [];
        $required = false;
        $validatorUnits = [];

        $segments = explode('|', $validator);
        $segCount = count($segments);
        $customReason = null;
        for ($i = 0; $i < $segCount;) {
            $segment = $segments[$i];
            $i++;
            if (strpos($segment, 'Regexp:') === 0) // 是正则表达式
            {
                if (strpos($segment, '/') !== 7) // 非法的正则表达. 合法的必须首尾加/
                    throw new ValidationException("正则表达式验证器Regexp格式错误. 正确的格式是 Regexp:/xxxx/");

                $pos = 8;
                $len = strlen($segment);

                $finish = false;
                do {
                    $pos2 = strripos($segment, '/'); // 反向查找字符/
                    if ($pos2 !== $len - 1 // 不是以/结尾, 说明正则表达式中包含了|分隔符, 正则表达式被explode拆成了多段
                        || $pos2 === 7
                    ) // 第1个/后面就没字符了, 说明正则表达式中包含了|分隔符, 正则表达式被explode拆成了多段
                    {
                    } else // 以/结尾, 可能是完整的正则表达式, 也可能是不完整的正则表达式
                    {
                        do {
                            $pos = strpos($segment, '\\', $pos); // 从前往后扫描转义符\
                            if ($pos === false) { // 结尾的/前面没有转义符\, 正则表达式扫描完毕
                                $finish = true;
                                break;
                            } else if ($pos === $len - 1) { // 不可能, $len-1这个位置是字符/
                                ;
                            } else if ($pos === $len - 2) { // 结尾的/前面有转义符\, 说明/只是正则表达式内容的一部分, 正则表达式尚未结束
                                $pos += 3; // 跳过“\/|”三个字符
                                break;
                            } else {
                                $pos += 2;
                            }
                        } while (1);

                        if ($finish)
                            break;
                    }

                    if ($i >= $segCount) // 后面没有segment了
                        throw new ValidationException("正则表达式验证器Regexp格式错误. 正确的格式是 Regexp:/xxxx/");

                    $segment .= '|';
                    $segment .= $segments[$i]; // 拼接后面一个segment
                    $len = strlen($segment);
                    $i++;
                    continue;

                } while (1);

                $validatorUnits[] = ['Regexp', substr($segment, 7)];
            } // end if(strpos($segment, 'Regexp:')===0)
            else {
                $pos = strpos($segment, ':');
                if ($pos === false) {
                    if ($segment === 'Required') {
                        if (count($validatorUnits) > $countOfIfs) {
                            throw new ValidationException("Required只能出现在验证规则的开头（IfXxx后面）");
                        }
                        $required = true;
                    } else
                        $validatorUnits[] = [$segment];
                } else {
                    $validatorName = substr($segment, 0, $pos);
                    $p = substr($segment, $pos + 1);
                    if ($p === false) {
                        if ($pos + 1 === strlen($segment))
                            $p = '';
                    }
                    if (strlen($validatorName) === 0) {
                        throw new ValidationException("“${segment}”中的':'号前面没有验证器");
                    }
                    switch ($validatorName) {
                        case 'IntEq':
                        case 'IntNe':
                        case 'IntGt':
                        case 'IntGe':
                        case 'IntLt':
                        case 'IntLe':
                        case 'StrLen':
                        case 'StrLenGe':
                        case 'StrLenLe':
                        case 'ByteLen':
                        case 'ByteLenGe':
                        case 'ByteLenLe':
                        case 'ArrLen':
                        case 'ArrLenGe':
                        case 'ArrLenLe':
                            if (self::_isIntOrIntString($p) === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, intval($p)];
                            break;
                        case 'IntGtLt':
                        case 'IntGeLe':
                        case 'IntGtLe':
                        case 'IntGeLt':
                        case 'StrLenGeLe':
                        case 'ByteLenGeLe':
                        case 'ArrLenGeLe':
                            $vals = explode(',', $p);
                            if (count($vals) !== 2)
                                self::_throwFormatError($validatorName);
                            $p1 = $vals[0];
                            $p2 = $vals[1];
                            if (self::_isIntOrIntString($p1) === false || self::_isIntOrIntString($p2) === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, intval($p1), intval($p2)];
                            break;
                        case 'IntIn':
                        case 'IntNotIn':
                            $ints = self::_parseIntArray($p);
                            if ($ints === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $ints];
                            break;
                        case 'StrEq':
                        case 'StrNe':
                        case 'StrEqI':
                        case 'StrNeI':
                            $validator = [$validatorName, $p];
                            break;
                        case 'StrIn':
                        case 'StrNotIn':
                        case 'StrInI':
                        case 'StrNotInI':
                            $strings = self::_parseStringArray($p);
                            if ($strings === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $strings];
                            break;
                        case 'IfIntEq':
                        case 'IfIntNe':
                        case 'IfIntGt':
                        case 'IfIntLt':
                        case 'IfIntGe':
                        case 'IfIntLe':
                            if (count($validatorUnits) > $countOfIfs)
                                throw new ValidationException("条件验证器 IfXxx 只能出现在验证规则的开头");
                            $params = self::_parseIfXxxWith1Param1Int($p, $validatorName);
                            if ($params === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $params[0], $params[1]];
                            $countOfIfs++;
                            break;
                        case 'IfIntIn':
                        case 'IfIntNotIn':
                            if (count($validatorUnits) > $countOfIfs)
                                throw new ValidationException("条件验证器 IfXxx 只能出现在验证规则的开头");
                            $params = self::_parseIfXxxWith1ParamMultiInts($p, $validatorName);
                            if ($params === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $params[0], $params[1]];
                            $countOfIfs++;
                            break;
                        case 'IfStrEq':
                        case 'IfStrNe':
                        case 'IfStrGt':
                        case 'IfStrLt':
                        case 'IfStrGe':
                        case 'IfStrLe':
                            if (count($validatorUnits) > $countOfIfs)
                                throw new ValidationException("条件验证器 IfXxx 只能出现在验证规则的开头");
                            $params = self::_parseIfXxxWith1Param1Str($p, $validatorName);
                            if ($params === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $params[0], $params[1]];
                            $countOfIfs++;
                            break;
                        case 'IfStrIn':
                        case 'IfStrNotIn':
                            if (count($validatorUnits) > $countOfIfs)
                                throw new ValidationException("条件验证器 IfXxx 只能出现在验证规则的开头");
                            $params = self::_parseIfXxxWith1ParamMultiStrings($p, $validatorName);
                            if ($params === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $params[0], $params[1]];
                            $countOfIfs++;
                            break;
                        case 'If':
                        case 'IfNot':
                        case 'IfExist':
                        case 'IfNotExist':
                        case 'IfTrue':
                        case 'IfFalse':
//                        case 'IfSame':
//                        case 'IfNotSame':
                            if (count($validatorUnits) > $countOfIfs)
                                throw new ValidationException("条件验证器 IfXxx 只能出现在验证规则的开头");
                            $varname = self::_parseIfXxxWith1Param($p);
                            if ($varname === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $varname];
                            $countOfIfs++;
                            break;
//                        case 'IfAny':
//                            break;
                        case 'FloatGt':
                        case 'FloatGe':
                        case 'FloatLt':
                        case 'FloatLe':
                            if (is_numeric($p) === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, doubleval($p)];
                            break;
                        case 'FloatGtLt':
                        case 'FloatGeLe':
                        case 'FloatGtLe':
                        case 'FloatGeLt':
                            $vals = explode(',', $p);
                            if (count($vals) !== 2)
                                self::_throwFormatError($validatorName);
                            $p1 = $vals[0];
                            $p2 = $vals[1];
                            if (is_numeric($p1) === false || is_numeric($p2) === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, doubleval($p1), doubleval($p2)];
                            break;
                        case 'DateFrom':
                        case 'DateTo':
                            $p = trim($p);
                            $timestamp = self::_parseDateString($p);
                            if ($timestamp === null)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $timestamp];
                            break;
                        case 'DateFromTo':
                            $p = trim($p);
                            $timestamps = self::_parseTwoDateStrings($p);
                            if ($timestamps === null)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $timestamps[0], $timestamps[1]];
                            break;
                        case 'DateTimeFrom':
                        case 'DateTimeTo':
                            $p = trim($p);
                            $timestamp = self::_parseDateTimeString($p);
                            if ($timestamp === null)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $timestamp];
                            break;
                        case 'DateTimeFromTo':
                            $p = trim($p);
                            $timestamps = self::_parseTwoDateTimeStrings($p);
                            if ($timestamps === null)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $timestamps[0], $timestamps[1]];
                            break;
                        case 'FileMimes':
                            $mimes = self::_parseMimesArray($p);
                            if ($mimes === false)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $mimes, $p];
                            break;
                        case 'FileMaxSize':
                        case 'FileMinSize':
                            $size = self::_parseSizeString($p);
                            if ($size === null)
                                self::_throwFormatError($validatorName);
                            $validator = [$validatorName, $size, $p];
                            break;
                        case '>>>':
                            $customReason = $p;
                            // >>>:之后的所有字符都属于错误提示字符串
                            for (; $i < $segCount; $i++) {
                                $customReason .= '|' . $segments[$i];
                            }
                            $customReason = static::translateText($customReason);
                            $validator = null;
                            break;
                        case 'Alias':
                            if (strlen($p))
                                $alias = static::translateText($p);
                            $validator = null;
                            break;
                        default:
                            throw new ValidationException("未知的验证器\"${validatorName}\"");
                    }
                    if ($validator)
                        $validatorUnits[] = $validator;
                } // end if 有冒号:分隔符
            } // end else 不是Regexp
        } // end for ($segments)

        if (!is_string($alias) || strlen($alias) === 0)
            $alias = 'UnknownParameter';
        return [
            'countOfIfs' => $countOfIfs,
            'required' => $required,
            'units' => $validatorUnits,
            'reason' => $customReason,
            'alias' => $alias,
        ];
    }

    private static function _throwFormatError($validatorName)
    {
        $sampleFormat = @self::$sampleFormats[$validatorName];
        if ($sampleFormat === null)
            throw new ValidationException("验证器${validatorName}格式错误");
        throw new ValidationException("验证器${validatorName}格式错误, 正确的格式是: $sampleFormat");
    }

    private static function _isIntOrIntString($value)
    {
        return (is_numeric($value) && strpos($value, '.') === false);
    }

    /**
     * 将包含int数组的字符串转为int数组
     * @param $value
     * @return int[]|bool 如果是合法的int数组, 并且至少有1个int, 返回int数组; 否则返回false
     */
    private static function _parseIntArray($value)
    {
        $vals = explode(',', $value);
        $ints = [];
        foreach ($vals as $val) {
            if (is_numeric($val) === false || strpos($val, '.') !== false)
                return false; // 检测到了非int
            $ints[] = intval($val);
        }
        if (count($ints) === 0)
            return false;
        return $ints;
    }

    /**
     * 将字符串转为字符串数组（逗号分隔）
     * @param $value
     * @return string[]|bool 如果至少有1个有效字符串, 返回字符串数组; 否则返回false
     */
    private static function _parseStringArray($value)
    {
        if (strlen($value)) {
            $vals = explode(',', $value);
            if ($vals === false)
                return false;
//            $vals = array_unique($vals); // 不需要去重, 不影响结果. 程序员不应该写出重复的字符串
        } else
            $vals = [''];
        if (count($vals) === 0)
            return false;
        return $vals;
    }

    private static function _parseSizeString($value)
    {
        $value = mb_strtolower($value);
        $matches = [];
        if (preg_match('/^([0-9]+)(kb|k|mb|m)*$/', mb_strtolower($value), $matches) !== 1)
            return null;

        $size = intval($matches[1]);
        if (count($matches) === 3) {
            $unit = $matches[2]; // 单位
            if ($unit === 'kb' || $unit === 'k')
                $size *= 1024;
            else if ($unit === 'mb' || $unit === 'm')
                $size *= 1048576;
//            else if ($unit === 'gb' || $unit === 'g')
//                $size *= 1048576*1024;
        }
        return $size;
    }

    /**
     * 解析日期字符串
     * @param $value string 日期字符串, 格式为YYYY-MM-DD
     * @return int|null 时间戳. 日期格式错误返回null
     */
    private static function _parseDateString($value)
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d$/', $value);
        if ($result !== 1)
            return null;
        $timestamp = strtotime($value);
        if ($timestamp === false)
            return null;

        return $timestamp;
    }

    /**
     * 解析两个日期字符串
     * @param $value string 两个日期字符串, 以逗号‘,’分隔, 格式为YYYY-MM-DD,YYYY-MM-DD
     * @return int[]|null 时间戳的数组. 日期格式错误返回null
     */
    private static function _parseTwoDateStrings($value)
    {
        $dateStrings = explode(',', $value);
        if (count($dateStrings) !== 2)
            return null;

        $timestamps = [];

        foreach ($dateStrings as $dateString) {
            $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d$/', $dateString);
            if ($result !== 1)
                return null;
            $timestamp = strtotime($dateString);
            if ($timestamp === false)
                return null;

            $timestamps[] = $timestamp;
        }
        return $timestamps;
    }

    /**
     * 解析日期时间字符串
     * @param $value string 日期字符串, 格式为YYYY-MM-DD HH:mm:ss
     * @return int|null 时间戳. 日期时间格式错误返回null
     */
    private static function _parseDateTimeString($value)
    {
        $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d \d\d:\d\d:\d\d$/', $value);
        if ($result !== 1)
            return null;
        $timestamp = strtotime($value);
        if ($timestamp === false)
            return null;

        return $timestamp;
    }

    /**
     * 解析两个日期时间字符串
     * @param $value string 两个日期字符串, 以逗号‘,’分隔, 格式为YYYY-MM-DD HH:mm:ss,YYYY-MM-DD HH:mm:ss
     * @return int[]|null 时间戳的数组. 日期时间格式错误返回null
     */
    private static function _parseTwoDateTimeStrings($value)
    {
        $dateStrings = explode(',', $value);
        if (count($dateStrings) !== 2)
            return null;

        $timestamps = [];

        foreach ($dateStrings as $dateString) {
            $result = @preg_match('/^\d\d\d\d-\d?\d-\d?\d \d\d:\d\d:\d\d$/', $dateString);
            if ($result !== 1)
                return null;
            $timestamp = strtotime($dateString);
            if ($timestamp === false)
                return null;

            $timestamps[] = $timestamp;
        }
        return $timestamps;
    }

    /**
     * 将Mimes字符串转为Mimes数组（逗号分隔）
     * @param $value
     * @return string[]|bool 如果至少有1个有效字符串, 返回字符串数组; 否则返回false
     * @throws ValidationException
     */
    private static function _parseMimesArray($value)
    {
        $mimes = explode(',', $value);
        $strings = [];
        foreach ($mimes as $mime) {
            $mime = trim($mime);
            if (strlen($mime) === 0)
                continue;

            if (($pos = strpos($mime, '/')) === false) // 没有斜杠'/'. 例: jpg 或 avi
            {
                if ($mime === '*')
                    throw new ValidationException("无效的MIME“${mime}”");
                $mime = "/$mime";
            } else // 有斜杠'/'. 例: image/jpeg 或 video/*
            {
                $parts = explode('/', $mime);
                if (count($parts) !== 2)
                    throw new ValidationException("无效的MIME“${mime}”");
                $type = $parts[0];
                $ext = $parts[1];
                if (strlen($type) === 0 || strlen($ext) === 0 || $type === '*')
                    throw new ValidationException("无效的MIME“${mime}”");

                // 将形如"video/*"的转化为"video/"以方便后续处理
                if ($ext === '*')
                    $mime = "$type/";
            }

            $strings[] = $mime;
        }
        if (count($strings) === 0)
            return false;
        return $strings;
    }

    /**
     * 解析 IfIntXx:varname,123 中的冒号后面的部分（1个条件参数后面带1个Int值）
     * @param $paramstr string
     * @param $validatorName string 条件验证子'IfIntXx'
     * @return array|false 出错返回false, 否则返回 ['varname', 123]
     * @throws ValidationException
     */
    private static function _parseIfXxxWith1Param1Int($paramstr, $validatorName)
    {
        $params = explode(',', $paramstr);
        if (count($params) != 2)
            return false;

        $varName = $params[0];
        $value = $params[1];
        self::validateInt($value, "“$validatorName:${paramstr}”中“${varName}”后面必须是整数，实际上却是“${value}”");
        return [$varName, intval($value)];
    }

    /**
     * 解析 IfStrXx:varname,abc 中的冒号后面的部分（1个条件参数后面带1个String值）
     * @param $paramstr string
     * @param $validatorName string 条件验证子'IfStrXx'
     * @return array|false 出错返回false, 否则返回 ['varname', 'abc']
     * @throws ValidationException
     */
    private static function _parseIfXxxWith1Param1Str($paramstr, $validatorName)
    {
        $params = explode(',', $paramstr);
        if (count($params) != 2)
            return false;

        $varName = $params[0];
//        $value = $params[1];
        if (strlen($varName) == 0) // 简单检测
            throw new ValidationException("“$validatorName:${paramstr}”中“${$validatorName}”后面必须是一个参数（变量）名，实际上却是空串");
        return $params;
    }

    /**
     * 解析 IfXxx:varname 中的冒号后面的部分（1个条件参数后面带0个值）
     * @param $paramstr string
     * @return string|false 出错返回false, 否则返回 'varname'
     * @throws ValidationException
     */
    private static function _parseIfXxxWith1Param($paramstr)
    {
        $params = explode(',', $paramstr);
        if (count($params) != 1)
            return false;

//        $varName = $params[0];
        return $params[0];
    }

    /**
     * 解析 IfStrXxx:varname,a,b,abc 中的冒号后面的部分（1个条件参数后面带多个字符串）
     * @param $paramstr string
     * @param $validatorName string 条件验证子'IfStrXxx'
     * @return array|false 出错返回false, 否则返回 ['varname', ['a','b','abc']]
     * @throws ValidationException
     */
    private static function _parseIfXxxWith1ParamMultiStrings($paramstr, $validatorName)
    {
        $params = explode(',', $paramstr);
        $c = count($params);
        if ($c < 2)
            return false;

        $varName = $params[0];
        $vals = [];
        for ($i = 1; $i < $c; $i++) {
            $vals[] = $params[$i];
        }
        return [$varName, $vals];
    }

    /**
     * 解析 IfIntInXxx:varname,1,2,3 中的冒号后面的部分（1个条件参数后面带多个整数）
     * @param $paramstr string
     * @param $validatorName string 条件验证子'IfIntInXxx'
     * @return array|false 出错返回false, 否则返回 ['varname', [1,2,3]]
     * @throws ValidationException
     */
    private static function _parseIfXxxWith1ParamMultiInts($paramstr, $validatorName)
    {
        $params = explode(',', $paramstr);
        $c = count($params);
        if ($c < 2)
            return false;

        $varName = $params[0];
        $vals = [];
        for ($i = 1; $i < $c; $i++) {
            $intVal = $params[$i];
            self::validateInt($intVal, "“$validatorName:${paramstr}”中“${varName}”后面必须全部是整数，实际上却包含了“${intVal}”");
            $vals[] = intval($intVal);
        }
        return [$varName, $vals];
    }

    /**
     * 验证一个值
     * @param $value mixed 要验证的值
     * @param $validator string|string[] 一条验证器, 例: 'StrLen:6,16|regex:/^[a-zA-Z0-9]+$/'; 或多条验证器的数组, 多条验证器之间是或的关系
     * @param string $alias 要验证的值的别名, 用于在验证不通过时生成提示字符串.
     * @param $ignoreRequired bool 是否忽略所有的Required检测子
     * @param array $originParams 原始参数的数组(这个参数只用于条件验证器的参数的取值)
     * @param array $siblings 与当前要检测的参数同级的全部参数的数组(这个参数只用于条件验证器的参数的取值)
     * @return mixed 返回$value被过滤后的新值
     * @throws ValidationException
     */
    public static function validateValue($value, $validator, $alias = 'Parameter', $ignoreRequired = false, $originParams = [], $siblings = [])
    {
        if (is_array($validator)) {
            $validators = $validator;
        } else if (is_string($validator)) {
            $validators = [$validator];
        } else
            throw new ValidationException(self::class . '::' . __FUNCTION__ . "(): \$validator必须是字符串或字符串数组");

        /*
         * 一个参数可以有一条或多条validator, 检测是否通过的规则如下:
         * 1. 如果有一条validator检测成功, 则该参数检测通过
         * 2. 如果即没有成功的也没有失败的（全部validator都被忽略或者有0条validator）, 也算参数检测通过
         * 3. 上面两条都不满足, 则参数检测失败
         */
        $success = 0;
        $failed = 0;
        $lastException = null;
        foreach ($validators as $validator) {

            $validatorInfo = self::_compileValidator($validator, $alias);
            $validatorUnits = $validatorInfo['units'];
            try {

                $countOfIfs = $validatorInfo['countOfIfs'];
                $countOfUnits = count($validatorUnits);
                for ($i = 0; $i < $countOfIfs; $i++) {
                    $validatorUnit = $validatorUnits[$i];
//                    echo "\n".json_encode($validatorUnit)."\n";

                    $ifName = $validatorUnit[0];
                    $method = 'validate' . ucfirst($ifName);
                    if (method_exists(self::class, $method) === false)
                        throw new ValidationException("找不到条件判断${$ifName}的验证方法");

                    $varkeypath = $validatorUnit[1]; // 条件参数的路径

                    // 提取条件参数的值
                    if (strpos($varkeypath, '.') === 0) // 以.开头, 是相对路径
                    {
                        $key = substr($varkeypath, 1); // 去掉开头的.号
                        self::validateVarName($key, "IfXxx中的条件参数“${key}”不是合法的变量名");
                        $ifParamValue = isset($siblings[$key]) ? $siblings[$key] : null;
                    } else // 绝对路径
                    {
                        // 解析路径
                        $asterisksCount = 0;
                        $keys = self::_compileKeypath($varkeypath, $asterisksCount);
                        if ($asterisksCount > 0) {
                            throw new ValidationException("IfXxx中的条件参数“${varkeypath}”中不得包含*号");
                        }

                        $ifParamValue = self::getParamValueForIf($originParams, $keys);
                    }

//                    echo "\n\$actualValue = $actualValue\n";
//                    echo "\n\$compareVal = $compareVal\n";

                    // 处理条件参数不存在的情况
                    if ($ignoreRequired) {// 这是增量更新
                        if ($value !== null) {// 如果参数存在，则其依赖的条件参数也必须存在
                            if ($ifParamValue === null && // 依赖的条件参数不存在
                                $ifName !== 'IfExist' && $ifName !== 'IfNotExist'
                            ) {
                                throw new ValidationException("必须提供条件参数“${varkeypath}”，因为“${alias}”的验证依赖它");
                            }
                        } else { // 如果参数不存在，则该参数不检测
                            return $value;
                        }
                    } else {// 不是增量更新
                        // 无论参数是否存在，则其依赖的条件参数都必须存在
                        if ($ifParamValue === null && // 依赖的条件参数不存在
                            $ifName !== 'IfExist' && $ifName !== 'IfNotExist'
                        ) {
                            throw new ValidationException("必须提供条件参数“${varkeypath}”，因为“${alias}”的验证依赖它");
                        }
                    }

                    if (isset($validatorUnit[2]))
                        $params = [$ifParamValue, $validatorUnit[2]];
                    else
                        $params = [$ifParamValue];
                    $trueOfFalse = call_user_func_array([self::class, $method], $params);
                    if ($trueOfFalse === false) // If条件不满足
                        break; // 跳出
                }

                if ($i < $countOfIfs) // 有If条件不满足, 忽略本条validator
//                {
//                    echo "\n不满足条件\n";
                    continue;
//                } else if ($countOfIfs)
//                    echo "\n满足条件\n";

                if ($value === null) //没有提供参数
                {
                    if (($validatorInfo['required'] === false) || $ignoreRequired)
                        continue; // 忽略本条validator
                    else {
                        $reason = $validatorInfo['reason'];
                        if ($reason !== null)
                            throw new ValidationException($reason);

                        $error = self::getErrorTemplate('Required');
                        $aAlias = $validatorInfo['alias'];
                        if ($aAlias == null)
                            $aAlias = $alias;
                        $error = str_replace('{{param}}', $aAlias, $error);
                        throw new ValidationException($error);
                    }
                }

                for ($i = $countOfIfs; $i < $countOfUnits; $i++) {
                    $validatorUnit = $validatorUnits[$i];

                    $validatorUnitName = $validatorUnit[0];

                    $method = 'validate' . ucfirst($validatorUnitName);

//                    if ($countOfIfs) {
//                        echo "\n$method()\n";
//                    }

                    if (method_exists(self::class, $method) === false)
                        throw new ValidationException("找不到验证子${validatorUnitName}的验证方法");

                    $params = [$value];
                    $paramsCount = count($validatorUnit);
                    for ($j = 1; $j < $paramsCount; $j++) {
                        $params[] = $validatorUnit[$j];
                    }
                    $params[] = $validatorInfo['reason'];
                    $params[] = $validatorInfo['alias'];

                    $value = call_user_func_array([static::class, $method], $params);
                }

                $success++;
                break; // 多个validator只需要一条验证成功即可
            } catch (ValidationException $e) {
                $lastException = $e;
                $failed++;
            }
        }

        if ($success || $failed === 0)
            return $value;
        throw $lastException; // 此时 $success == 0 && $failed > 0
    }

    /**
     * @param $keypath string 路径
     * @param $asterisksCount &int 路径中包含星号(*)的个数
     * @return array
     * @throws ValidationException
     */
    private static function _compileKeypath($keypath, &$asterisksCount)
    {
        if (strlen($keypath) === 0)
            throw new ValidationException('参数$validations中包含空的参数名称');

        if (preg_match('/^[a-zA-Z0-9_.\[\]*]+$/', $keypath) !== 1)
            throw new ValidationException("非法的参数名称“${keypath}”");

        $keys = explode('.', $keypath); // 不可能返回空数组. $keys中的数组还没有解析

        $asterisksCount = 0;

        $filteredKeys = [];
        // 尝试识别普通数组, 形如'varname[*]'
        foreach ($keys as $key) {
            if (strlen($key) === 0)
                throw new ValidationException("“${keypath}”中包含空的参数名称");

            $i = strpos($key, '[');
            if ($i === false) // 普通的key
            {
                if (strpos($key, '*') !== false)
                    throw new ValidationException("“${keypath}”中'*'号只能处于方括号[]中");
                if (strpos($key, ']') !== false)
                    throw new ValidationException("“${key}”中包含了非法的']'号");
                if (preg_match('/^[0-9]/', $key) === 1) {
                    if (count($keys) === 1)
                        throw new ValidationException("参数名称“${keypath}”不得以数字开头");
                    else
                        throw new ValidationException("“${keypath}”中包含了以数字开头的参数名称“${key}”");
                }
                $filteredKeys[] = $key;
                continue;
            } else if ($i === 0) {
                throw new ValidationException("“${keypath}”中'['号前面没有参数名称");
            } else {
                $j = strpos($key, ']');
                if ($j === false)
                    throw new ValidationException("“${key}”中的'['号之后缺少']'");
                if ($i > $j)
                    throw new ValidationException("“${key}”中'[', ']'顺序颠倒了");

                // 识别普通数组的变量名（'[*]'之前的部分）
                $varName = substr($key, 0, $i);
                if (strpos($varName, '*') !== false)
                    throw new ValidationException("“${key}”中包含了非法的'*'号");
                if (preg_match('/^[0-9]/', $varName) === 1)
                    throw new ValidationException("“${keypath}”中包含了以数字开头的参数名称“${varName}”");
                $filteredKeys[] = $varName;

                // 识别普通数组的索引值
                $index = substr($key, $i + 1, $j - $i - 1);
                if ($index === '*') {
                    $filteredKeys[] = $index;
                    $asterisksCount++;
                } else if (is_numeric($index))
                    $filteredKeys[] = intval($index);
                else
                    throw new ValidationException("“${key}”中的方括号[]之间只能包含'*'号或数字");

                // 尝试识别多维数组
                $len = strlen($key);
                while ($j < $len - 1) {
                    $j++;
                    $i = strpos($key, '[', $j);
                    if ($i !== $j)
                        throw new ValidationException("“${key}”中的“[$index]”之后包含非法字符");
                    $j = strpos($key, ']', $i);
                    if ($j === false)
                        throw new ValidationException("“${key}”中的'['号之后缺少']'");

                    $index = substr($key, $i + 1, $j - $i - 1);
                    if ($index === '*') {
                        $filteredKeys[] = $index;
                        $asterisksCount++;
                    } else if (is_numeric($index))
                        $filteredKeys[] = intval($index);
                    else
                        throw new ValidationException("“${key}”中的方括号[]之间只能包含*号或数字");
                }
            }
        }
        return $filteredKeys;
    }

    /**
     * 验证输入参数
     *
     * 如果客户端通过HTTP协议要传递的参数的值是一个空Array或空Object, 实际上客户
     * 端HTTP协议是会忽略这种参数的, 服务器接收到的参数数组中也就没有相应的参数.
     * 举例, 如果客户端传了这样的参数: {
     *     "bookname": "hello,world!",
     *     "authors": [],
     *     "extra": {},
     * }
     * 服务器接收到的实际上会是: {
     *     "bookname": "hello",
     * }
     * 没有authors和extra参数
     *
     * @param $params array 包含输入参数的数组. 如['page'=>1,'pageSize'=>10]
     * @param $validations array 包含验证字符串的数组. 如: [
     *     'keypath1' => 'validator string',
     *     'bookname' => 'StrLen:2',
     *     'summary' => 'StrLen:0',
     *     'authors' => 'Required|Arr',
     *     'authors[*]' => 'Required|Obj',
     *     'authors[*].name' => 'StrLen:2',
     *     'authors[*].email' => 'Regexp:/^[a-zA-Z0-9]+@[a-zA-Z0-9-]+.[a-z]+$/',
     * ]
     * @param $ignoreRequired bool 是否忽略所有的Required检测子
     * @return mixed
     * @throws ValidationException 验证不通过会抛出异常
     */
    public static function validate($params, $validations, $ignoreRequired = false)
    {
        if (is_array($params) === false)
            throw new ValidationException(self::class . '::' . __FUNCTION__ . "(): \$params必须是数组");

        $cachedKeyValues = [];
        foreach ($validations as $keypath => $validator) {

            // 解析路径
            $asterisksCount = 0;
            $keys = self::_compileKeypath($keypath, $asterisksCount);

            $keysCount = count($keys);
            if ($keysCount > 1 && $cachedKeyValues === null)
                $cachedKeyValues = [];

            self::_validate($params, $keys, $keysCount, $validator, '', $ignoreRequired, $cachedKeyValues);
        }
//        if(count($cachedKeyValues))
//            echo json_encode($cachedKeyValues, JSON_PRETTY_PRINT);
        return $params;
    }

    /**
     * 根据路径从参数数组中取值. 只用于IfXxx中参数的取值
     *
     * 本函数里的代码与 _validate() 中的相似, 但是不可能合并成一个函数.
     * 因为针对"comments[*]"这样的参数路径, _validate() 方法内部必须枚举数组
     * 的每个元素, 一个个检测; 而本函数根本就不会遇到参数路径中带*号的情况, 因
     * 为本函数只需要返回一个值, 带*号的话就不知道要返回哪个值了.
     *
     * @param $params array
     * @param $keys array 条件参数的路径中不能有 * 号, 否则就不知道取哪个值了
     * @param $ancestorExist &bool 返回: 上一级是否存在
     * @return null|mixed
     * @throws ValidationException
     */
    private static function getParamValueForIf($params, $keys, &$ancestorExist = null)
    {
        $keysCount = count($keys);

        $value = $params;

        $keyPath = '';
        $siblings = $params;
        for ($n = 0; $n < $keysCount; $n++) {

            $key = $keys[$n];
            if (is_integer($key))
                self::validateArr($siblings, null, $keyPath);
            else
                self::validateObj($siblings, null, $keyPath);
            $value = isset($siblings[$key]) ? $siblings[$key] : null;

            if ($keyPath === '')
                $keyPath = $key;
            else if (is_integer($key))
                $keyPath .= "[$key]";
            else
                $keyPath .= ".$key";

            if ($value === null) {
                $n++;
                break;
            }
            $siblings = $value;
        }

        // 到这里$n表示当前的$value是第几层. 取值在[1, $keysCount]之间, 也就是说 $n 只可能小于或等于$keysCount
        if ($n == $keysCount) {
            if ($ancestorExist !== null)
                $ancestorExist = true;
        } else {
            if ($ancestorExist !== null)
                $ancestorExist = false;
        }
        return $value;
    }

    /**
     * 验证一条Validation
     * @param $params array
     * @param $keys array
     * @param $keysCount int
     * @param $validator string
     * @param string $keyPrefix
     * @param $cachedKeyValues array|null 缓存已取过的值. 存储格式为: ['key1' => val1, 'key2' => val2]
     * @param $ignoreRequired bool 是否忽略所有的Required检测子
     * @throws ValidationException
     */
    private static function _validate($params, $keys, $keysCount, $validator, $keyPrefix = '', $ignoreRequired = false, &$cachedKeyValues = null)
    {
        $keyPath = $keyPrefix;
        $siblings = $params;
        $value = $params;

        for ($n = 0; $n < $keysCount; $n++) {
            $siblings = $value;
            $keyPrefix = $keyPath;

            $key = $keys[$n];
            if ($key === '*') {
                self::validateArr($siblings, null, $keyPrefix);
                $c = count($siblings);
                if ($c > 0) {
                    $subKeys = array_slice($keys, $n + 1);
                    $subKeysCount = $keysCount - $n - 1;
                    for ($i = 0; $i < $c; $i++) {
                        $element = $siblings[$i];
                        $keyPath = $keyPrefix . "[$i]";
                        if ($subKeysCount)
                            self::_validate($element, $subKeys, $subKeysCount, $validator, $keyPath, $ignoreRequired, $cachedKeyValues);
                        else {
                            self::validateValue($element, $validator, $keyPath, $ignoreRequired, $params, $siblings);

                            // 缓存数组本身的没什么用, 因为提取不到.
                            if ($cachedKeyValues !== null && $keyPrefix) {
                                $cachedKeyValues[$keyPrefix] = $siblings;
//                                echo "\n缓存: keyPrefix=$keyPrefix, key=$keyPath" . ", value=$siblings\n";
                            }
                        }
                    }
                    return;
                } else // 'items[*]' => 'Required' 要求items至少有1个元素, 但上面的循环不检测items==[]的情况
                    $value = null; // 这里是针对$value==[]这种情况的特殊处理
            } else {
                if (is_integer($key))
                    self::validateArr($siblings, null, $keyPrefix);
                else
                    self::validateObj($siblings, null, $keyPrefix);
                $value = isset($siblings[$key]) ? $siblings[$key] : null;
            }

            if ($keyPrefix === '')
                $keyPath = $key;
            else if (is_integer($key) || $key === '*')
                $keyPath = $keyPrefix . "[$key]";
            else
                $keyPath = "$keyPrefix.$key";
            if ($value === null) {
                $n++;
                break;
            }
        } // end for keys

        // 到这里$n表示当前的$value是第几层
        if ($n == $keysCount) {
            self::validateValue($value, $validator, $keyPath, $ignoreRequired, $params, $siblings);
        } else {
            if ($cachedKeyValues !== null) {
                for (; $n < $keysCount; $n++) {
                    $keyPrefix = $keyPath;

                    $key = $keys[$n];

                    if ($keyPrefix === '')
                        $keyPath = $key;
                    else if (is_integer($key) || $key === '*')
                        $keyPath = $keyPrefix . "[$key]";
                    else
                        $keyPath = "$keyPrefix.$key";
                }
                $siblings = null;
            }
        }
        if ($cachedKeyValues !== null && $keyPrefix) {
            $cachedKeyValues[$keyPrefix] = $siblings;
//            echo "\n缓存: keyPrefix=$keyPrefix, key=$keyPath" . ", value=$siblings\n";
        }
    }

}