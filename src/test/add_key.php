<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 9:48
 */
header('Content-type:text/html;charset=utf-8');

// 获取用户Key
require ('../Keys/UserKeys.php');
$key_obj = new UserKeys();
$user_keys = $key_obj::getKeys();
echo "<pre>";

//$user_code = trim($_POST['user_code']);
//$user_code = $key_obj->encrypt_public(trim($_POST['user_code']));
$str = $key_obj::getRandom();
$user_code= base64_encode(substr(base64_encode($str), rand(0,25), 62).'==');
var_dump('公钥加密字符串：'.$key_obj->encrypt_public($user_code));
$user_code= $user_code;
$user_id = trim($_POST['user_id']);
$new_keys = $user_keys;

$new_keys[$user_id] = $user_code;

echo "<pre>";
($new_keys);
var_dump(1111);

unlink('../Keys/keys.json');

// 追加内容
file_put_contents('../Keys/keys.json',json_encode($new_keys),FILE_APPEND | LOCK_EX);

//echo "<pre>";
//print_r($new_keys);

//$content = file_get_contents('./Keys/UserKeys.php');
//var_dump($content);
//exit();

//$myfile = fopen('./Keys/keys.txt', "w") or die("Unable to open file!");
//file_put_contents('./Keys/UserKeys.php',$user_keys,FILE_APPEND | LOCK_EX);
//$content = str_replace('hello world','hello baidu',$content);
//fclose($myfile);

