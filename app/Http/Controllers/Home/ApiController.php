<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    public function weather()
    {
        $url = 'http://v.juhe.cn/weather/index?format=1&cityname=上海&key=331aec2bd696e59ded0915a9f344e9f0';
        // curl 初始化
        $curl = curl_init();
        // curl 设置
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  // 查看ssl 证书节点
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  // 查看ssl 证书主机
        // 判断有没有 data 如果有data 我们就是post
        if ( !empty($data) ) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // 执行
        $res = curl_exec($curl);
        curl_close($curl);
//        dd($res);
        $a=json_decode($res,true);

       dump($a['result']['today']);


    }
}
