<?php
/**
 * epmoeid
 *
 * @package  epmoeid
 * @file     callback.php
 * @author   LixWorth
 * @datatime 2018/8/15 23:40
 */
session_start();

define("APP_ID","3313eb4e");
define("APP_KEY","17001aad28cb2c10752e10120483749b");

if(isset($_SESSION["token"])){
    header("Location:/");
}
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://api.boxmoe.cn/oauth/access_token?app_id=".APP_ID."&app_key=".APP_KEY."&code=" . $_GET["code"]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁止 curl 验证对等证书

$output = curl_exec($curl);
curl_close($curl);
if ($output === FALSE) {
    die("获取token错误");
} else {
    $data = json_decode($output);
    if ($data->error == 0) {
        $token = $data->data;
        $_SESSION["token"] = $token;
        echo "登录成功";
    } else {
        die($data->content);
    }
}
