<?php

use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 9:48
 */
class UserKeys{

    public static function getKeys(){

        $content = file_get_contents('./Keys/keys.json');
        $keys = json_decode($content, true);

        return $keys;
    }

    /**
     * Desc 随机生成 "user_id"
     * User: Xlong
     * Date: 2022/06/17
     * Time: 08:08
     * @param $query
     * @return int
     */
    public function randUserId($query)
    {
        $user_id = mt_rand(1351324, 9999999);
        $ex_user = $query->where('user_id', $user_id)->first();
        if (!empty($ex_user)){
            return self::randUserId($query);
        }else {
            return $user_id;
        }
    }

    /**
     * Desc: Rsa 私鑰解碼
     * User: Xlong
     * Date: 2022/06/17
     * Time: 08:08
     * @param $code 因為RSA加密後會出現無法被encode的字符，所以需要客戶端先對數據進行base64封裝，再次通過接口傳遞
     * @return string
     */
    public static function RsaDecodeByPrivate($code) {
        $res = openssl_private_decrypt(base64_decode($code), $decrypted, openssl_pkey_get_private(file_get_contents(getenv("RSA_PRIVATE_KEY_PATH"))));
        if (!$res) {
            return 0;
        }
        return $decrypted;
    }

    /**
     * Desc: Rsa 公鑰解碼
     * User: Xlong
     * Date: 2022/06/17
     * Time: 08:08
     * @param $code 因為RSA加密後會出現無法被encode的字符，所以需要客戶端先對數據進行base64封裝，再次通過接口傳遞
     * @return string
     */
    public static function RsaDecodeByPublic($code) {
        $res = openssl_private_decrypt(base64_decode($code), $decrypted, openssl_pkey_get_public(file_get_contents(getenv("RSA_PUBLIC_KEY_PATH"))));
        if (!$res) {
            return 0;
        }
        return $decrypted;
    }

    /**
     * 生成code 和 code加密信息
     * User: Xlong
     * Date: 2022/06/17
     * Time: 08:08  * @return mixed
     * @return array
     */
    public static function RsaEncodeByPublic()
    {
        $str = self::getRandom();
        $user_code= base64_encode(substr(base64_encode($str), rand(0,25), 62).'==');
        $data['code'] = $user_code;
        $en_code = self::encrypt_public($data['code']);
        $data['ras_code'] = $en_code;
        return $data;
    }

    /**
     * Desc code 取值范文
     * User: Xlong
     * Date: 2022/06/17
     * Time: 08:08
     * @return string
     */
    public static function getModulus(){
        $modulus = "DB1EA572B55F5D9C8ADF092F5DCC3559CFEA8CE8BB54E3A71DA9B1AFBD7D17CF80ADB224FE4EA5379BC782F41C137748D8F1B5A36AD62A127EF5E87EFB25C209A66BCEE9925CE09631BF2271E81123E93438646625080FF04F4F2CF532B077E3E390486DF40E7586F0AE522C873F33170222F46BDB6084F55DE6B7031E55DBE7";
        return $modulus;
    }

    /**
     * Desc 随机生成Code
     * User: Xlong
     * Date: 2022/06/17
     * Time: 08:08
     * @return string
     */
    public static function getRandom(){
        $modulus = self::getModulus();
        $key = '';
        for ($i=0; $i<66; $i++){
            $key .= $modulus[mt_rand(0,255)];
        }
        return $key;
    }

    /**
     * 加密 Code
     * User: Xlong
     * Date: 2022/06/17
     * Time: 08:08
     * @param $str
     * @return bool|string
     */
    public static function encrypt_public($str){
        $public_key = file_get_contents(getenv("RSA_PUBLIC_KEY_PATH"));
        /* 判断公钥是否是可用的 */
        $ex_public_key = openssl_pkey_get_public($public_key);

        if ($ex_public_key == FALSE) {
            return FALSE;
        } else {
            $encrypted = "";
            openssl_public_encrypt($str, $encrypted, $ex_public_key);//公钥加密
            $encrypted = base64_encode($encrypted);
            return $encrypted;
        }
    }


}
