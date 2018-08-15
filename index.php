<?php
/**
 * epmoeid
 *
 * @package  epmoeid
 * @file     index.php
 * @author   LixWorth
 * @datatime 2018/8/15 23:12
 */

session_start();

define("APP_ID","3313eb4e");
define("APP_KEY","17001aad28cb2c10752e10120483749b");


if(isset($_SESSION["token"])){
    //已登录
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.boxmoe.cn/user/profile?".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $output = curl_exec($curl);
    curl_close($curl);

    if ($output === FALSE) {
        die("拉取用户信息错误");
    } else {
        $data = json_decode($output);
        if(isset($data->error)){
            die($data->content);
        }else{
            echo "<pre>";
            print_r($data);//用户信息
        }
    }
}else{
    header("Location:https://api.boxmoe.cn/oauth/authorize?app_id=".APP_ID."&scope=default");
}
