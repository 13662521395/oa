<?php

namespace backend\controllers;

use Yii;
use app\models\OaAffiche;
use app\models\OaUser;
use app\models\OaDepartment;
use app\models\OaPosition;
use app\models\OaElec;
use app\models\OaRacord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\ArrayHelper; 

/**
 * OaAfficheController implements the CRUD actions for OaAffiche model.
 */
class OaafficheController extends StoploginController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }
    public function actionToggle()
    {
      $query=OaAffiche::find();
       $model2 =$query->where(['aff_status'=>1])->with('oaUser')->asArray()->orderBy('aff_id desc')->one();
       $id = $model2['aff_id'];

        if($model2['aff_rstate']==1){
            $abc=OaAffiche::findOne($id);
            $abc->aff_rstate = 2;
            $abc->save();
           
       }else{
        $abc=OaAffiche::findOne($id);
            $abc->aff_rstate = 1;
            $abc->save();
       }
    }
    public function actionIndex()
    {
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        $sess=OaUser::find()->where(['oa_uid'=>$a])->one();
        //print_r($sess);die();
        if($sess['oa_uid']==1)//判断权限
        {
            $query=OaAffiche::find();
            $countQuery = clone $query;
        }
        else
        {
            $query=OaAffiche::find()->where(["oa_uid"=>$sess['oa_uid']]);
        }

        $model   = $query->where(['aff_status'=>1])->all();
        $models  = $query->where(['oa_uid'=>$a])->andWhere(['aff_status'=>1])->all();//$sess
        $model2 =$query->where(['aff_status'=>1])->with('oaUser')->asArray()->orderBy('aff_id desc')->one();//echo "<pre>";print_r($model2);die();



        return $this->render('index', [

            'model' => $model,
            'models' => $models,
            'model2' => $model2,

            'sess' => $sess,
        ]);
    }
    /**
     * Lists all OaAffiche models.
     * @return mixed
     * 我发布的公告
     */
    public function actionDindex()
    {
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        $sess=OaUser::find()->where(['oa_uid'=>$a])->one();
        if($sess['oa_uid']==1)//判断权限
        {
            $query=OaAffiche::find();

            $list=Yii::$app->request->get('list');
            $user=Yii::$app->request->get('user');
            if($list)
            {
                $query =OaAffiche::find()->andFilterWhere(['like', 'aff_pos', $list]);//检索方法
            }

            if($user)
            {
                $query =OaAffiche::find()->andFilterWhere(['like', 'aff_title', $user]);//检索方法
            }
            if($list && $user)
            {
                $query =OaAffiche::find()->andFilterWhere(['like', 'aff_pos', $list])->andFilterWhere(['like', 'aff_title', $user]);//检索方法
            }

        }
        else
        {
            $query=OaAffiche::find()->where(["oa_uid"=>$sess['oa_uid']]);
            $list=Yii::$app->request->get('list');
            $user=Yii::$app->request->get('user');
            if($list)
            {
                $query =OaAffiche::find()->where(["oa_uid"=>$sess['oa_uid']])->andFilterWhere(['like', 'aff_pos', $list]);//检索方法
            }

            if($user)
            {
                $query =OaAffiche::find()->where(["oa_uid"=>$sess['oa_uid']])->andFilterWhere(['like', 'aff_title', $user]);//检索方法
            }
            if($list && $user)
            {
                $query =OaAffiche::find()->where(["oa_uid"=>$sess['oa_uid']])->andFilterWhere(['like', 'aff_pos', $list])->andFilterWhere(['like', 'aff_title', $user]);//检索方法
            }
        }
        $pagesize=15;
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => $pagesize]);
        $models = $query->andFilterWhere(['aff_status'=>1])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('dindex', [
            'pagesize'=>$pagesize,
            'models' => $models,
            'pages' => $pages,
            'sess' => $sess,
        ]);
    }
    /*
    *我接受的公告
     */
    public function actionBindex()
    {
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        $sess=OaUser::find()->where(['oa_uid'=>$a])->one();//搜索判断
        $query=OaElec::find()->where(["aff_public"=>$a]);
        $list=Yii::$app->request->get('list');
        if($list)
        {
            $query =OaElec::find()->where(["aff_public"=>$a])->andFilterWhere(['like', 'aff_pos', $list]);//检索方法
        }
        $pagesize=6;
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => $pagesize]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('bindex', [
            'pagesize'=>$pagesize,
            'models' => $models,
            'pages' => $pages,
            'sess' => $sess,
        ]);
    }

    /**
     * Displays a single OaAffiche model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $model=$this->findModel($id);
        $pub=$model['aff_publication'];
        
          $pub2=explode(',',$pub);
          $user=new OaUser;
          $arr=[];
          foreach($pub2 as $mod=>$key)
          { 
              $aa=$user->find()->where(['oa_uid'=>$key])->one();
              $arr[]=$aa['oa_nickname'];
          }
        return $this->render('view', [
            'model' => $model,
            'arr'=>$arr,
        ]);
    }
    /*
    
    */
    public function actionAjax1()
    {
      $a=Yii::$app->request->get('a');

      $dindex= new OaAffiche();
      $c=array();
      $aa=$dindex->find()->where(["aff_id"=>$a])->one();
       foreach ($aa as $key => $v) {

            $c[$key]=$v;
        # code...
      }
     $c['oa_uid']=$aa['oaUser']['oa_nickname'];
    //echo $aa['oaUser']['oa_nickname'];
        //echo $aa['school_id'];
       // echo "<meta charset='utf-8'>";
        //print_r($aa);
      echo json_encode($c);
    }
    /**
     * Creates a new OaAffiche model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaAffiche();
        $models = new OaElec();
        $racords = new OaRacord();
        if ($model->load(Yii::$app->request->post()))
        {
           //print_r(Yii::$app->request->post());die;
            $title=Yii::$app->request->post()['OaAffiche']['aff_title'];
            $content=Yii::$app->request->post()['OaAffiche']['aff_content'];
            $time=Yii::$app->request->post()['OaAffiche']['aff_creattime'];
            $uid=Yii::$app->request->post()['OaAffiche']['oa_uid'];
            $pos=Yii::$app->request->post()['Oaaffiche']['aff_pos'];

            $pub=Yii::$app->request->post()['Oaaffiche']['aff_publication'];
            $pubf=implode(',',$pub);//组合接收的数组

            $model->aff_title=$title;
            $model->aff_content=$content;
            $model->oa_uid=$uid;
            $model->aff_pos=$pos;
            $model->aff_publication=$pubf;
            $model->aff_creattime=$time;
            $a=$model->save();
            if($a)//判断并添加到公告中间表
            {
                foreach($pub as $key=>$p)
                {
                    $aa=Yii::$app->db->createCommand()->batchInsert('oa_elec', ['elec_id','oa_uid','aff_public','aff_pos'],
                        [['',$uid,$p,$pos]])->execute();
                }

            }
            return $this->redirect(['index', 'id' => $model->aff_id]);


        }
        else
        {
            $session = Yii::$app->session;//设置session
            $session->open();
            $a=$session->get('uid');
            $user=new OaUser;
            $user=$user->find()->where(["oa_uid"=>$a])->all();
            $dep=new OaPosition;
            $dep=$dep->find()->where(["pos_id"=>$user[0]['pos_id']])->one();
            return $this->render('create', [
                'model' => $model,
                'user'=>$user,
                'dep'=>$dep,
            ]);
        }
    }
    
    /*所有人公告*/
    public function actionAjax()
    {
           $qpos = Yii::$app->request->get('qpos');//input接收的是ajax第二个值的名字
           if($qpos == 1)
           {
              $user=OaUser::find()->all();
              $str="";
              foreach ($user as $key =>$rs)
              { 
                 $str.="<input type=\"checkbox\" id=\"oaaffiche-aff_publication\" name=\"Oaaffiche[aff_publication][]\" checked=\"checked\"value='".$rs['oa_uid']."'>".$rs['oa_nickname'];
              }
              echo $str;
           } 
    }
     /*指定部门公告*/
     public function actionAjax2()
    {
           $pos = Yii::$app->request->get('pos');//input接收的是ajax第二个值的名字
           if($pos == 2)
           {
              $dep=OaDepartment::find()->all();
              $str="";
              foreach ($dep as $key =>$rs)
              { 
                 $str.="<input type=\"checkbox\" id=\"aaa\" name=\"Oaaffiche[aff_publication][]\" value='".$rs['dep_id']."'>".$rs['dep_name'];
              }
              echo $str;
           } 
    }
    /*指定部门下的人员*/
    public function actionAjax3()
    {
        $str = Yii::$app->request->get('str');//input接收的是ajax第二个值的名字
        $str=explode(',',$str);//分割字符串
        $us="";
        foreach ($str as $key =>$rs)
        { 
          $user=OaUser::find()->where(['dep_id'=>$rs])->all();
          foreach($user as $u=>$uu)
          {
           $us.="<input type=\"checkbox\" id=\"oaaffiche-aff_publication\" name=\"Oaaffiche[aff_publication][]\" value='".$uu['oa_uid']."'>".$uu['oa_nickname'];
          }
        }
        echo $us;
    }
    /*领导公告*/
    public function actionAjax4()
    {
        $lpos = Yii::$app->request->get('lpos');//input接收的是ajax第二个值的名字
        if($lpos == 3)
           {
              $user=OaUser::find()->where(['<','pos_id',3])->all();
              $str="";
              foreach ($user as $key =>$rs)
              { 
                 $str.="<input type=\"checkbox\" id=\"oaaffiche-aff_publication\" name=\"Oaaffiche[aff_publication][]\" value='".$rs['oa_uid']."'>".$rs['oa_nickname'];
              }
              echo $str;
           } 
    }

    /*
     * 模态框
     */
    public function actionAjax5()
    {
        $a = Yii::$app->request->get('a');//input接收的是ajax第二个值的名字
        $oaaffiche=new OaAffiche();
        $aa=$oaaffiche->find()->where(["aff_id"=>$a])->asarray()->one();
        //echo $aa['school_id'];
        // echo "<meta charset='utf-8'>";
        //print_r($aa);
        echo json_encode($aa);
    }
    /**
     * Updates an existing OaAffiche model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          $title=Yii::$app->request->post()['OaAffiche']['aff_title'];
           $content=Yii::$app->request->post()['OaAffiche']['aff_content'];
           $uid=Yii::$app->request->post()['OaAffiche']['oa_uid'];
           $pos=Yii::$app->request->post()['Oaaffiche']['aff_pos'];
           $pub=Yii::$app->request->post()['Oaaffiche']['aff_publication'];
           $pubf=implode(',',$pub);
           $model->aff_title=$title;
           $model->aff_content=$content;
           $model->oa_uid=$uid;
           $model->aff_pos=$pos;
           $model->aff_publication=$pubf;
           $model->aff_creattime=time();
           $model->save();
            return $this->redirect(['view', 'id' => $model->aff_id]);
        } else {
          $session = Yii::$app->session;//设置session
            $session->open();
            $a=$session->get('oa_uid');
            $a="1";
            $user=new OaUser;
            $user=$user->find()->where(["oa_uid"=>$a])->all();
            return $this->render('create', [
                'model' => $model,
                'user'=>$user,
            ]);
        }
    }

    /**
     * Deletes an existing OaAffiche model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * 软删除
     */
    public function actionDelete($id)
    {
        //echo $id;die();
        $abc=OaAffiche::findOne($id);
        $abc->aff_status = 4;
        $abc->save();
        return $this->redirect(['dindex']);

//        $this->findModel($id)->delete();
//
//        return $this->redirect(['dindex']);
    }
    /*
     * 撤回
     */
    public function actionRecall($id)
    {
        //echo $id;die();
        $abc=OaAffiche::findOne($id);
        $abc->aff_status = 3;
        $abc->save();
        return $this->redirect(['dindex']);

//        $this->findModel($id)->delete();
//
//        return $this->redirect(['dindex']);
    }
    /**
     * Finds the OaAffiche model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaAffiche the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaAffiche::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
