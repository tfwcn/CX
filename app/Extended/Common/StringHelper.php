<?php namespace App\Extended\Common;

/**
 * 字符串处理类
 */
class StringHelper
{
    /**
     * 判断空字符串，去掉前后空格
     * @return boolean
     */
    public static function IsEmpty($str)
    {
        return (empty ($str) || trim($str) == "");
    }

    /**
     * 判断空数据
     * @return boolean
     */
    public static function IsNull($obj)
    {
        return ($obj == null || empty ($obj) || trim($obj) == "");
    }

    /**
     * 判断日期格式
     * @return boolean
     */
    public static function IsDate($str)
    {
        $format = "Y-m-d";
        $unixTime = strtotime($str);
        $checkDate = date($format, $unixTime);
        if ($checkDate == $str)
            return true;
        else
            return false;
    }

    /**
     * 判断时间格式
     * @return boolean
     */
    public static function IsTime($str)
    {
        $format = "H:i:s";
        $unixTime = strtotime($str);
        $checkDate = date($format, $unixTime);
        if ($checkDate == $str)
            return true;
        else
            return false;
    }

    /**
     * 判断日期和时间格式
     * @return boolean
     */
    public static function IsDatetime($str)
    {
        $format = "Y-m-d H:i:s";
        $unixTime = strtotime($str);
        $checkDate = date($format, $unixTime);
        if ($checkDate == $str)
            return true;
        else
            return false;
    }

    /**
     * 判断邮箱地址格式
     * @return boolean
     */
    public static function IsMail($str)
    {
        return (preg_match('/^[_.0-9a-z-a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/', $str));
    }

    /**
     * 判断数字格式（未实现）
     * @return boolean
     */
    public static function IsNum($str)
    {
        return false;
    }

    /**
     * 判断字符串长度
     * @return boolean
     */
    public static function CheckStrLen($str, $min, $max)
    {
        $len = strlen($str);
        return ($len >= $min && $len <= $max);
    }

    /**
     * 判断字符串长度
     * @return boolean
     */
    public static function CheckStrLenMax($str, $max)
    {
        $len = strlen($str);
        return ($len <= $max);
    }

    /**
     * 判断字符串长度
     * @return boolean
     */
    public static function CheckStrLenMin($str, $min)
    {
        $len = strlen($str);
        return ($len >= $min);
    }

    /**
     * 解密
     * @param string $encryptedText 已加密字符串
     * @param string $key 密钥
     * @return string
     */
    public static function Decrypt($encryptedText, $key)
    {
        $cryptText = base64_decode($encryptedText);
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);
        $decryptText = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $cryptText, MCRYPT_MODE_ECB, $iv);
        return trim($decryptText);
    }

    /**
     * 加密
     * @param string $plainText 未加密字符串
     * @param string $key 密钥
     * @return string
     */
    public static function Encrypt($plainText, $key)
    {
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);
        $encryptText = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plainText, MCRYPT_MODE_ECB, $iv);
        return trim(base64_encode($encryptText));
    }

    /**
     * MD5加密
     * @param string $plainText 未加密字符串
     * @return string
     */
    public static function MD5($plainText)
    {
        return md5($plainText);
    }

    /**
     * 生成随机字符串
     * @param $len
     * @return string
     */
    public static function Random($len)
    {
        $is_abc = $is_numer = 0;
        $password = $tmp = '';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        mt_srand((double)microtime() * 1000000 * getmypid());
        while (strlen($password) < $len) {
            $tmp = substr($chars, (mt_rand() % strlen($chars)), 1);
            if ($is_numer <> 1 && is_numeric($tmp) && $tmp > 0) {
                $is_numer = 1;
            }
            if ($is_abc <> 1 && preg_match('/[a-zA-Z]/', $tmp)) {
                $is_abc = 1;
            }
            $password .= $tmp;
        }
        if ($is_numer <> 1 || $is_abc <> 1 || empty($password)) {
            $password = StringHelper::Random($len);
        }
        return $password;
    }

    /**
     * 补全字符串到指定长度
     * @param $str
     * @param $len
     * @param $val
     * @return string
     */
    public static function PadLeft($str, $len, $val)
    {
        return str_pad($str, $len, $val, STR_PAD_LEFT);
    }

    /**
     * 补全字符串到指定长度
     * @param $str
     * @param $len
     * @param $val
     * @return string
     */
    public static function PadRight($str, $len, $val)
    {
        return str_pad($str, $len, $val, STR_PAD_RIGHT);
    }

    /**
     * 字符串按分割符转数组
     * @param $str
     * @param $key
     * @return array
     */
    public static function Split($str, $key)
    {
        return explode($key, $str);
    }

    /**
     * 替换字符串
     * @param $str
     * @param $key
     * @param $val
     * @return mixed
     */
    public static function Replace($str, $key, $val)
    {
        return str_replace($key, $val, $str);
    }
}