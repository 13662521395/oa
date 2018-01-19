<?php
namespace backend\controllers;

use Yii;
use app\models\OaMission;
use app\models\OaMissionLog;
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
 * MissionController implements the CRUD actions for OaMission model.
 */
class MissionController extends StoploginController
{
    /**
     * 显示任务申请
     * @return mixed
     */
    public function actionIndex()
    {
        $model = OaMission::find();

        $session = Yii::$app->session;

        $uid = $session->get('uid');

        $countQuery = clone $model;
        $pages = new Pagination(['totalCount' =>$countQuery->count(),'pageSize' => 15]);

        if($session->get('uid') == 1){
            $data = $model->offset($pages->offset)->where('m_status=1')
                      ->andwhere('m_complete='.'0')
                      ->andwhere('m_fid='.'0')
                      ->orderby('m_creat_time desc')
                      ->limit($pages->limit)
                      ->all();
            $mission = $model->offset($pages->offset)->where('m_status=1')
                ->andwhere('m_complete='.'1')
                ->andwhere('m_fid='.'0')
                ->orderby('m_creat_time desc')
                ->limit($pages->limit)
                ->all();
        }else{
            $data = $model->offset($pages->offset)->where('m_status=1')
                      ->andwhere('m_complete='.'0')
                      ->andwhere('m_fid='.'0')
                      ->andwhere('m_user'.'='.$uid)
                      ->orderby('m_creat_time desc')
                      ->limit($pages->limit)
                      ->all();
            $mission = $model->offset($pages->offset)->where('m_status=1')
                ->andwhere('m_complete='.'1')
                ->andwhere('m_fid='.'0')
                ->andwhere('m_user'.'='.$uid)
                ->orderby('m_creat_time desc')
                ->limit($pages->limit)
                ->all();
        }
       
        return $this->render('index', [
            'mission' => $mission,
            'page' => $pages,
            'data' => $data,
            'id' => 1
        ]);
    }
    /**
     * 修改任务状态
     * @param integer $id
     * @return mixed
     */
    /*点击开始任务后改变任务状态*/
    public function actionComplete()
    {
       $session = Yii::$app->session;
       $session->open();
       $a=$session->get('uid');
       $mis_id = Yii::$app->request->get('mis_id');
       $yuj = Yii::$app->request->get('yuj');
       $model = OaMission::findOne($mis_id);

      if($model){
        $model->m_complete = 1;
        $model->m_estima = $yuj;
        $a2=$model->save();
          if($a2)
          {
          $model2 = OaMission::find()->where(['m_id'=>$mis_id])->asarray()->one();
      
          $models = new OaMissionLog();/*增加日志*/
          $models->mlog_name = $model2['m_name'];
          $models->oa_uid = $a;
          $models->mlog_creattime = time();
          $models->mlog_user = $model2['m_joinusers'];
          $models->mlog_type = '开始任务';
          $models->mlog_status = '0';
          $aa=$models->save();
           if($aa){
            echo "成功";
           }
         }
       } 
    }
    /*点击警告框时ajax修改阅读状态*/
    public function actionStatus()
    {
      $clos = Yii::$app->request->get('clos');
      $clos2 = Yii::$app->request->get('clos2');
      if($clos){
         $model = OaMissionLog::findOne($clos);
      $model->mlog_status=1;
      $a=$model->save();
      }
      if($clos2){
         $model = OaMissionLog::findOne($clos2);
      $model->mlog_status=1;
      $a=$model->save();
      }
    }
    /*向main.php传值*/
    public function actionView()
    {
       $a=OaMission::find()->where(['m_complete'=>1])->asArray()->orderBy('m_id desc')->all();
      foreach($a as $aa){
          
      }
    }
    /**
     * 查看任务
     * @param integer $id
     * @return mixed
     */
    public function actionAjax()
    {
        $m_id = Yii::$app->request->get('user_id');

        $model = OaMission::find()->where('m_id='.$m_id)->asarray()->one();

        return json_encode($model);
    }

    /**
     * 任务审核通过
     * @param integer $id
     * @return mixed
     */
    public function actionPlay()
    {
        $m_id = Yii::$app->request->get('userId');

        $remark = Yii::$app->request->get('command');

        $command = OaMission::find()->where('m_id='.$m_id)->one();

        if($command['m_big_check'] == '')
        {
            $model = OaMission::findOne($m_id);
            $model->m_big_check = 1;
            $model->m_big_command = $remark;
            $model->save();
        }else{
            $model = OaMission::findOne($m_id);
            $model->m_biger_check = 1;
            $model->m_biger_command = $remark;
            $model->save();
        }
    }

    /**
     * 任务审核拒绝
     * @param integer $id
     * @return mixed
     */
    public function actionPlayer()
    {
        $m_id = Yii::$app->request->get('userId');
        $remark = Yii::$app->request->get('command');

        $command = OaMission::find()->where('m_id='.$m_id)->one();

        if($command['m_big_check'] == '')
        {
            $model = OaMission::findOne($m_id);
            $model->m_big_check = 2;
            $model->m_big_command = $remark;
            $model->save();
        }else{
            $model = OaMission::findOne($m_id);
            $model->m_biger_check = 2;
            $model->m_biger_command = $remark;
            $model->save();
        }
    }

    /**
     * 申请新任务
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaMission();
        $date = new Date();
        $session = Yii::$app->session;
        $data = OaUser::findOne($session->get('uid'));

        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());die;
            $time = Yii::$app->request->post()['OaMission']['m_creat_time'];
            $model->m_name = Yii::$app->request->post()['OaMission']['m_name'];
            $model->m_import = Yii::$app->request->post()['OaMission']['m_import'];
            $model->m_estima = Yii::$app->request->post()['OaMission']['m_estima'];
            $model->m_user = $data->oa_uid;
            $model->m_creat_time = Yii::$app->request->post()['OaMission']['m_creat_time'];
            $model->m_content = $_POST['content'];
            $model->m_endtime = $_POST['endtime'];
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
     * 修改自己的任务申请
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = OaMission::findOne($id);
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {
            $model->m_import = Yii::$app->request->post()['OaMission']['m_import'];
            $model->m_content = $_POST['content'];
//            $addTime = $_POST['OaMission']['m_creat_time'];
//            $model->m_creat_time =$addTime;
            $editTime = $_POST['OaMission']['m_edit_time'];
            $model->m_edit_time = $editTime;
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
     * 删除任务申请（软删除）
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = OaMission::findOne($id);
        $model->m_status = 2;
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
      $model = OaMission::find();
      $session = Yii::$app->session;

      if(empty($_GET['id'])){
          $id = $session->get('id');
      }else{
          $id = $_GET['id'];
      }
      $session->set('id',$id);

      $countQuery = clone $model;
      $pages = new Pagination(['totalCount' =>$countQuery->count(),'pageSize' => 5]);

      $data = $model->offset($pages->offset)->where('m_status=1')
            ->andwhere('m_complete='.'0')
            ->andwhere('m_fid='.$id)
            ->orderby('m_creat_time desc')
            ->limit($pages->limit)
            ->all();

        $mission = $model->offset($pages->offset)->where('m_status=1')
            ->andwhere('m_complete='.'1')
            ->andwhere('m_fid='.$id)
            ->orderby('m_creat_time desc')
            ->limit($pages->limit)
            ->all();

      //$data = OaMission::find()->where('m_fid='.$id)->all();
      $son = OaMission::findOne($id);

      return $this->render('indexson',[
            'mission' => $mission,
            'data' => $data,
            'page' => $pages,
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
        $model =new OaMission;
        $date = new Date();
        $session = Yii::$app->session;
        $data = OaMission::find()->select('m_user')
                                 ->where('m_id='.$session->get('id'))
                                 ->column();
        if($model->load(Yii::$app->request->post())){
          $str = '';
          foreach($_POST['joinusers'] as $val){
              $str.= $val.','; 
          }
          $user = trim($str,',');
          $model->m_name = Yii::$app->request->post()['OaMission']['m_name'];
          $model->m_creat_time = Yii::$app->request->post()['OaMission']['m_creat_time'];
          $model->m_import = Yii::$app->request->post()['OaMission']['m_import'];
          $model->m_user = $data[0];
          $model->m_endtime = $_POST['endtime'];
          $model->m_fid = $session->get('id');
          $model->m_joinusers = $user;
          $model->m_content = $_POST['content'];
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
        $model = OaMission::findOne($id);
        $date = new Date();
        $session = Yii::$app->session;
        $data = OaMission::find()->select('m_user')
                                 ->where('m_id='.$session->get('id'))
                                 ->column();
        
        if($model->load(Yii::$app->request->post())){
          $str = '';
          foreach($_POST['joinusers'] as $val){
              $str.= $val.','; 
          }
          $user = trim($str,',');
          $model->m_name = Yii::$app->request->post()['OaMission']['m_name'];
          $model->m_creat_time = Yii::$app->request->post()['OaMission']['m_creat_time'];
          $model->m_edit_time = Yii::$app->request->post()['OaMission']['m_edit_time'];
          $model->m_import = Yii::$app->request->post()['OaMission']['m_import'];
          $model->m_endtime = $_POST['endtime'];
          $model->m_user = $data[0]; 
          $model->m_fid = $session->get('id');
          $model->m_joinusers = $user;
          $model->m_content = $_POST['content'];
          //print_r(Yii::$app->request->post());
          $model->save();
          return $this->redirect(['indexson']);
        }else{ 
          $data = OaMission::find()->where('m_fid='.$session->get('id'))
          						   ->andwhere('m_id='.$id)
          						   ->One();
   		  $arr = explode(',',$data->m_joinusers);
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
        $model = new OaMission();
        //OaMission::find()->where('m_fid='.$id)->delete();
        $data = OaMission::findOne($id);
        $model->status = 2;
        $model->save();
    }

    public function actionMission()
    {
        header("Content-type: text/html; charset=utf-8");
        $model = new OaMission();
        $racords = new OaRacord();
        $joinusers = OaUser::find()->all();
        $rs = $model->find()->where(['m_status'=>1])->orderBy('m_creat_time DESC')->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->m_creat_time = time();
            $a = Yii::$app->request->post()['OaMission']['m_joinusers'];
            $model->m_joinusers =implode(',',$a);
            $model->m_son = 0;
            $model->m_content = Yii::$app->request->post()['OaMission']['m_content'];
            $model->m_user = Yii::$app->request->post()['OaMission']['m_user'];
            //print_r(Yii::$app->request->post()['OaMission']);
            $x = $model->save();
            if($x)
            {
                $nickname = OaUser::find()->where(['oa_uid'=>$model->m_user])->one();
                $nickname = $nickname->oa_nickname;
                $str = $model->m_content;
                $str = mb_substr($str,0,10,'utf-8').'...';
                $con = $this->message($nickname.' 申请任务 "'.$str.'"');

                $racords->racord_name = $nickname.' 申请任务 "'.$str.'"' ;
                $racords->racord_user = $model->m_user;
                $racords->racord_time = time();
                $rss = $racords->save();
                if($rss)
                {
                    return $this->redirect(['mission']);
                }

            }

        } else {
            return $this->render('mission', [
                'model' => $model,
                'rs'    => $rs,
                'joinusers'=>$joinusers,
            ]);
        }

    }
}
