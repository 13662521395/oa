<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 2017/12/1
 * Time: 15:18
 */

namespace backend\controllers;
use yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Request;
use yii\captcha;
use app\models\OaUser;
use app\models\OaDepartment;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
header("Content-type: text/html; charset=utf-8");
class LoginController extends Controller
{
    public $request;
    public function actionIndex()
    {    
        $model = new OaUser();
        if ($model->load(Yii::$app->request->post())) {
            
                $this->request = Yii::$app->request->post();
                $this->request['OaUser'];//提交的用户名密码存放在数组里
                $this->request['OaUser']['oa_pwd'] = md5($this->request['OaUser']['oa_pwd']);
                $rs = $model::find()->where($this->request['OaUser'])->one();
                if(count($rs)!=0) {
                    //echo '成功';
                    $session = Yii::$app->session;
                    $session->open();
                    //开启用户各种session
                    $session->set('uid',$rs->oa_uid);
                    $session->set('uname',$rs->oa_uname);
                    $session->set('nickname',$rs->oa_nickname);
                    $session->set('dep_id',$rs->dep_id);
                    $session->set('pos_id',$rs->pos_id);
                    $session->set('duty_id',$rs->duty_id);

                    $this->redirect(['oaaffiche/index']);
                }
                else {
                    return $this->redirect(['login/index']);
                }
            
        }

        return $this->renderPartial('index', [
            'model' => $model,
        ]);
    }
    public function actionRegister()
    {
        header("Content-type: text/html; charset=utf-8");

        $model = new OaUser();
        $department = new OaDepartment();
        $dep = $department::find()->all();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $this->request = Yii::$app->request->post();
                $this->request['OaUser'];//提交的用户名密码存放在数组里
                switch ($this->request['OaUser']['dep_id'])
                {
                    case 1:
                            $d = 'T';
                        break;
                    case 2:
                            $d = 'S';
                        break;
                    case 3:
                            $d = 'B';
                        break;
                    case 4:
                            $d = 'M';
                        break;
                    case 5:
                            $d = 'O';

                }
                $rs = $model->find()->where(['dep_id'=>$this->request['OaUser']['dep_id']])->count();
                $num = empty($rs) ? '001'  : str_pad($rs+1,3,"0",STR_PAD_LEFT);
                $pwd = $this->request['OaUser']['oa_pwd'];
                $model->oa_uname = $d.date('Y',time()).$num;
                $model->oa_nickname = $this->request['OaUser']['oa_uname'];
                $model->oa_pwd   = md5($pwd);
                $model->dep_id   = $this->request['OaUser']['dep_id'];
                $rs = $model->save();
                if($rs==true) {
                    //名字存入cookie
                    $cookie_uname = new \yii\web\Cookie([
                        'name' => 'uname',
                        'expire' => time()+31104000,
                        'value' => $model->oa_uname,
                    ]);
                    \Yii::$app->response->getCookies()->add($cookie_uname);
                    //密码存入cookie
                    $cookie_pwd = new \yii\web\Cookie([
                        'name' => 'upwd',
                        'expire' => time()+31104000,
                        'value' => $pwd,
                    ]);
                    \Yii::$app->response->getCookies()->add($cookie_pwd);
                    //生成头像
                    $info = ['name'=>$model->oa_nickname,'filename'=>$model->oa_uname];
                    $this->head($info);

                    return $this->redirect(['login/index']);
                }
                else{
                    return $this->redirect(['login/middle']);
                }

            }
        }
        return $this->renderPartial('register',[
            'model' => $model,
            'dep'   =>$dep,
            ]);
    }
    public function actionMiddle()
    {

        return $this->renderPartial('middle');
    }
    public function actionLoginout()
    {
        $session = Yii::$app->session;//设置session
        $session->open();
        
       if ($session->isActive)//判断session是否开启
        {
       
           $session->close();// 关闭session
           $session->remove('uid');//删除session变量
           $session->remove('uname');
           $session->remove('nickname');
           $session->remove('dep_id');
           $session->remove('pos_id');
           $session->remove('duty_id');
        }
        return $this->redirect(['login/index']);
    }
    public function head($info)
    {

        header("Content-type:image/jpg");
        $myImage = imagecreatefromjpeg ("assets/head/ui-sam.jpg");
        $black=ImageColorAllocate($myImage, 0, 0, 0);
        $font = "assets/head/simhei";
        $fontSize = 25;
        $name = $info['name'];
        $filename = $info['filename'];
        $time = date('ymd',time());
        $width = imagesx ( $myImage );
        $height = imagesy ( $myImage );
        $fontBox = imagettfbbox($fontSize, 0, $font, $name);
        imagettftext($myImage, $fontSize, 0, ceil(($width - $fontBox[2]) / 2), 70, $black, $font,$name);
//imagettftext($myImage, $fontSize, 0, ceil(($width - $fontBox[2]) / 2), 100, $black, $font,$time);
        ImagePng($myImage);
        imagepng($myImage,"assets/head/creat/".$filename.".jpg");
    }

}