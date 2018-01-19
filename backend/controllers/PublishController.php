<?php
namespace backend\controllers;

use Yii;
use app\models\OaPublish;
use app\models\OaRacord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Date;
use app\models\OaUser;
use yii\data\Pagination;

$session = Yii::$app->session;

$session->open();
/**
 * PublishController implements the CRUD actions for OaPublish model.
 */
class PublishController extends StoploginController
{
    /**
     * 显示任务发布
     * @return mixed
     */
    public function actionIndex()
    {
        $model = OaPublish::find();

        $session = Yii::$app->session;
        $uid = $session->get('uid');

        $countQuery = clone $model;
        $pages = new Pagination(['totalCount' =>$countQuery->count(),'pageSize' => 5]);

        if($session->get('uid') == 1){
            $data = $model->offset($pages->offset)->where('p_status='.'1')
                      ->andwhere('p_complete='.'0')
                      ->andwhere('p_fid='.'0')
                      ->orderby('p_create_time desc')
                      ->limit($pages->limit)
                      ->all();
            $publish = $model->offset($pages->offset)->where('p_status='.'1')
                ->andwhere('p_complete='.'1')
                ->andwhere('p_fid='.'0')
                ->orderby('p_create_time desc')
                ->limit($pages->limit)
                ->all();
        }else{
            $data = $model->offset($pages->offset)->where('p_status='.'1')
                      ->andwhere('p_complete='.'0')
                      ->andwhere('p_fid='.'0')
                      ->andwhere('p_user'.'='.$uid)
                      ->orderby('p_create_time desc')
                      ->limit($pages->limit)
                      ->all();
            $publish = $model->offset($pages->offset)->where('p_status='.'1')
                ->andwhere('p_complete='.'1')
                ->andwhere('p_fid='.'0')
                ->orderby('p_create_time desc')
                ->limit($pages->limit)
                ->all();
        }
       
        return $this->render('index', [
            'publish' => $publish,
            'page' => $pages,
            'data' => $data,
            'id' => 1
        ]);
    }

    public function actionAjax()
    {
        $p_id = Yii::$app->request->get('user_id');

        $model = OaPublish::find()->where('p_id='.$p_id)->asarray()->one();

        return json_encode($model);
    }

    /**
     * 查看任务申请详情
     * @param integer $id
     * @return mixed
     */
    public function actionComplete($id)
    {
        $model = OaPublish::findOne($id);
        $model->p_complete = 1;
        $model->save();
        echo "<script>window.history.back();</script>";
    }

    /**
     * 发布新任务
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaPublish;
        $session = Yii::$app->session;
        $data = OaUser::findOne($session->get('uid'));

        if ($model->load(Yii::$app->request->post())) {
            $time = Yii::$app->request->post()['OaPublish']['p_create_time'];
            $model->p_endtime = $_POST['endtime'];
            $model->p_user = $data->oa_uid;
            $model->p_content = $_POST['content'];
//            print_r(Yii::$app->request->post());
//            die;
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data' => $data
            ]);
        }
    }

    /**
     * 修改自己的任务发布
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = OaPublish::findOne($id);
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {
            $model->p_user = $session->get('uid');
            $model->p_content = $_POST['content'];
            $model->p_endtime = $_POST['endtime'];
            $model->save();
            return $this->redirect(['index']);
        } else {
            $data = OaUser::findOne($session->get('uid'));
            return $this->render('update', [
                'model' => $model,
                'data' => $data
            ]);
        }
    }

    /**
     * 删除任务发布（软删除）
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = OaPublish::findOne($id);
        $model->p_status = 2;
        $model->save();
        return $this->redirect(['index']);
    }
    /**
     * 子任务显示
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionIndexson()
    {
      $session = Yii::$app->session;

      if(empty($_GET['id'])){
          $id = $session->get('id');
      }else{
          $id = $_GET['id'];
      }
      $session->set('id',$id);

      $data = OaPublish::find()->where('p_fid='.$id)
                               ->andwhere('p_status='.'1')
                               ->andwhere('p_complete='.'0')
                               ->orderby('p_create_time desc')
                               ->all();

      $publish = OaPublish::find()->where('p_status='.'1')
        ->andwhere('p_complete='.'1')
        ->andwhere('p_fid='.$id)
        ->orderby('p_create_time desc')
        ->all();

      $son = OaPublish::findOne($id);

      return $this->render('indexson',[
            'publish' => $publish,
            'data' => $data,
            'son' => $son,
            'id' => 1
        ]);
    }
    /**
     * 新添子任务
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionCreateson()
    {
        $model =new OaPublish;
        $session = Yii::$app->session;
        $data = OaPublish::find()->select('p_user')
                                 ->where('p_id='.$session->get('id'))
                                 ->column();
        if($model->load(Yii::$app->request->post())){
          $str = '';
          foreach($_POST['joinusers'] as $val){
              $str.= $val.','; 
          }
          $user = trim($str,',');
          $model->p_name = Yii::$app->request->post()['OaPublish']['p_name'];
          $model->p_import = Yii::$app->request->post()['OaPublish']['p_import'];
          $model->p_user = $data[0];
          $model->p_fid = $session->get('id');
          $model->p_joinusers = $user;
          $model->p_content = $_POST['content'];
          $model->p_endtime = $_POST['endtime'];
          //print_r(Yii::$app->request->post());
          $model->save();
          return $this->redirect(['indexson']);
        }else{
          return $this->render('createson',[
                'model' => $model
            ]);
        }
    }
    /**
     * 修改子任务
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateson($id)
    {
        $model = OaPublish::findOne($id);
        $session = Yii::$app->session;
        $data = OaPublish::find()->select('p_user')
                                 ->where('p_id='.$session->get('id'))
                                 ->column();
        
        if($model->load(Yii::$app->request->post())){
            
          $str = '';
          if(!empty($_POST['joinusers'])){
              foreach($_POST['joinusers'] as $val){
                  $str.= $val.',';
              }
              $user = trim($str,',');
              $model->p_joinusers = $user;
          }

          $model->p_name = Yii::$app->request->post()['OaPublish']['p_name'];
          $model->p_import = Yii::$app->request->post()['OaPublish']['p_import'];
          $model->p_user = $data[0]; 
          $model->p_fid = $session->get('id');
          $model->p_content = $_POST['content'];
          $model->p_endtime = $_POST['endtime'];
          //print_r(Yii::$app->request->post());
          $model->save();
          return $this->redirect(['indexson']);
        }else{
          $data = OaPublish::find()->where('p_fid='.$session->get('id'))
          						   ->andwhere('p_id='.$id)
          						   ->One();
   		  $arr = explode(',',$data->p_joinusers);
		  $users = '';
		  $i=0;
		  foreach($arr as $v){
		      //$v[$i];
		      $user = OaUser::findOne($v[$i]); 
		      $users.= $user->oa_nickname.',';
		  } 
		  $nickname = trim($users,',');
		  $user = OaUser::find()->all();
          return $this->render('updateson',[
                'model' => $model,
                'user' => $user,
                'nickname' => $nickname
            ]);
        }
    }
    /**
     * 删除子任务（软删除）
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteson($id)
    {
        $model = new OaPublish();
        //OaPublish::find()->where('p_fid='.$id)->delete();
        $data = OaPublish::findOne($id);
        $model->status = 2;
        $model->save();
    }

    public function actionPublish()
    {
        header("Content-type: text/html; charset=utf-8");
        $model = new OaPublish();
        $racords = new OaRacord();
        $joinusers = OaUser::find()->all();
        $rs = $model->find()->where(['p_status'=>1])->orderBy('p_creat_time DESC')->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->p_creat_time = time();
            $a = Yii::$app->request->post()['OaPublish']['p_joinusers'];
            $model->p_joinusers =implode(',',$a);
            $model->p_son = 0;
            $model->p_content = Yii::$app->request->post()['OaPublish']['p_content'];
            $model->p_user = Yii::$app->request->post()['OaPublish']['p_user'];
            //print_r(Yii::$app->request->post()['OaPublish']);
            $x = $model->save();
            if($x)
            {
                $nickname = OaUser::find()->where(['oa_uid'=>$model->p_user])->one();
                $nickname = $nickname->oa_nickname;
                $str = $model->p_content;
                $str = mb_substr($str,0,10,'utf-8').'...';
                $con = $this->message($nickname.' 申请任务 "'.$str.'"');

                $racords->racord_name = $nickname.' 申请任务 "'.$str.'"' ;
                $racords->racord_user = $model->p_user;
                $racords->racord_time = time();
                $rss = $racords->save();
                if($rss)
                {
                    return $this->redirect(['Publish']);
                }

            }

        } else {
            return $this->render('Publish', [
                'model' => $model,
                'rs'    => $rs,
                'joinusers'=>$joinusers,
            ]);
        }

    }
}
