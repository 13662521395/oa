<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 2017/12/4
 * Time: 9:34
 */

namespace backend\controllers;
use Yii;
use yii\web\Request;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


class CommonController extends Controller
{
    public function message($content)
    {

        $appkey = "BC-bf591efd900c4188b6076611afb6e234";
        //$url = "http://goeasy.io/goeasy/publish";
        $url = "http://rest-hangzhou.goeasy.io/publish";
        $params = array(
            "appkey" => $appkey,
            "channel" => "csdnNotification",//版本，当前：1.0
            "content"=>$content
        );
        $apiurl = http_build_query($params);
        $tip =$this->juhecurl($url,$apiurl);
        return $tip;
    }
    public function juhecurl($url,$params=false,$ispost=1)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }

}
