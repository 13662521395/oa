<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OaUser;
use app\models\OaPower;
use backend\models\OaRole;
use yii\web\Session;

/**
 * JfAdminController implements the CRUD actions for JfAdmin model.
 */
class StoploginController extends Controller
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
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
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
 //    public function __construct($id, $module)
	// {
	// 	parent::__construct($id, $module);
		
	// 	$session = Yii::$app->session;
	// 	$session->open();
	// 	if(!$session->has('uname'))
	// 	{   
	// 	 	/*return $this->redirect(['/login/index']);
	// 	 	die();*/
	// 	 	$this->redirect(['/login/index']);
	// 	}
	// }
	public function beforeAction($action){ //继承之后在所有方法之前执行
		$session = Yii::$app->session;
		$session->open();
		if(!$session->has('uname'))
		{ 
		 	$this->redirect(['//login/index']);
		 	return false;
		}
		return true;
	}

    public function nowpower()
    {
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        //user and power
        $sess=OaUser::find()->joinWith('oaRole')->where(['oa_uid'=>$a])->one();
        //获取当前用户的权限$sess 转化成数组
        $havepower = explode(" ", $sess['oaRole']['role_power']);
        return $havepower;
    }
    /**
     * 判断是否有当前权限
     * 当前方法权限id
     */
    public function whether($controllerid,$actionid)
    {
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        //user and power
        $sess=OaUser::find()->joinWith('oaRole')->where(['oa_uid'=>$a])->one();
        //获取当前用户的权限$sess 转化成数组
        $havepower = explode(" ", $sess['oaRole']['role_power']);
        //
        //
        $power = array("$controllerid","$actionid");
        //转化为字符串
        $p = OaPower::find()->where(['oa_controller'=>implode(" ",$power)])->asarray()->one();
        //print_r($p);
        $powerid=$p['oa_id'];
        if(!in_array($powerid, $havepower))
        {
            $not='no';
            return $not;
        }
        else
        {
            $not='yes';
            return $not;
        }

    }

}
