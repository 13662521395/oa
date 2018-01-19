<?php

namespace backend\controllers;

use Yii;
use app\models\OaUser;
use app\models\OaDuty;
use app\models\OaDepartment;
use app\models\OaPosition;
use app\models\OaSchool;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * OauserController implements the CRUD actions for Oauser model.
 */
class OauserController extends StoploginController
{
    /**
     * @inheritdoc
     */
    

    /**
     * Lists all Oauser models.
     * @return mixed
     */
    /*个人中心*/
    public function actionIndex()
    {
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        $models=OaUser::find()->where(['oa_uid'=>$a])->one();
        /*$duty=$models['duty_id'];//获取权限值
        $duty2=explode(',',$duty);//分割
        $du=new OaDuty;
        $arr=[];
        foreach($duty2 as $mod=>$key)//用数组循环输出在视图分割显示
        { 
            $aa=$du->find()->where(['duty_id'=>$key])->one();
            $arr[]=$aa['duty_name'];
        }*/
        return $this->render('index', [
            'models' => $models,
        ]);
    }
     /*所有用户显示*/
    public function actionSindex()
    {
        $query=OaUser::find();
        $pagesize=15;
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => $pagesize]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('sindex', [
            'models' => $models,
            'pages' => $pages,
            'pagesize'=>$pagesize,
        ]);
    }
    /*赋予部门权限*/
    public function actionGindex()
    {
        $query=OaUser::find()->where(['<','pos_id',3]);
        $pagesize=15;
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => $pagesize]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('gindex', [
            'models' => $models,
            'pages' => $pages,
            'pagesize'=>$pagesize,
        ]);
    }
    /**
     * Displays a single Oauser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        $models=OaUser::find()->where(['oa_uid'=>$a])->one();
        /*$duty=$models['duty_id'];//获取权限值
        $duty2=explode(',',$duty);//分割
        $du=new OaDuty;
        $arr=[];
        foreach($duty2 as $mod=>$key)//用数组循环输出在视图分割显示
        { 
            $aa=$du->find()->where(['duty_id'=>$key])->one();
            $arr[]=$aa['duty_name'];
        }*/
        return $this->render('view', [
            'models' => $model,
            //'arr'=>$arr,
        ]);
    }

    /**
     * Creates a new Oauser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*超级管理员添加用户*/
    public function actionCreate()
    {
        $model = new Oauser();

        if ($model->load(Yii::$app->request->post())) {
            $pwd=Yii::$app->request->post()['OaUser']['oa_pwd'];
            //$pubf=implode(',',$po);//组合接收的数组

            $model->oa_pwd=md5($pwd);
            //$model->duty_id=$pubf;

            $model->oa_softdel=1;
            $model->save();
            return $this->redirect(['view','id' => $model->oa_uid]);
        } else {
            $dep=OaDepartment::find()->all();
            $pos=OaPosition::find()->all();
            $school=OaSchool::find()->all();
            return $this->render('create', [
                'model' => $model,
                'dep'=>$dep,
                'pos'=>$pos,
                'school'=>$school,
            ]);
        }
    }
    /*指定校区的部门*/
    public function actionAjax()
    {
        $op = Yii::$app->request->get('op');//input接收的是ajax第二个值的名字
        $dep=OaDepartment::find()->where(['school_id'=>$op])->all();
        $us="<option value=>-请选择- </option>";
        foreach($dep as $d=>$du)
        {
           $us.="<option value='".$du['dep_id']."'>".$du['dep_name']."</option>";
        }
        if($us == '')
        {
           echo "查看校区暂时没有部门";
        }
        else
        {
            echo $us;
        }
    }
    /*指定校区下的职位*/
    public function actionAjax1()
    {
        $op = Yii::$app->request->get('op');//input接收的是ajax第二个值的名字
        $dep=OaPosition::find()->where(['school_id'=>$op])->all();
        $us="<option value=>-请选择- </option>";
        foreach($dep as $d=>$du)
        {
           $us.="<option value='".$du['pos_id']."'>".$du['pos_name']."</option>";
        }
        if($us == '')
        {
           echo "查看校区暂时没有职位";
        }
        else
        {
            echo $us;
        }
    }
    /*指定部门下的职责权限*/
    public function actionAjax2()
    {
        $op = Yii::$app->request->get('op');//input接收的是ajax第二个值的名字
        $dep=OaDuty::find()->where(['dep_id'=>$op])->all();
        $us="";
        foreach($dep as $d=>$du)
        {
           $us.="<input type=\"checkbox\" id=\"oauser-duty_id\" name=\"OaUser[duty_id][]\" 
                  value='".$du['duty_id']."'>".$du['duty_name'];
        }
        if($us == '')
        {
           echo "查看部门暂时没有职责";
        }
        else
        {
            echo $us;
        }
    }
    /**
     * Updates an existing Oauser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['oaaffiche/index']);
        } else {
            $dep=OaDepartment::find()->where(["dep_id"=>$model['dep_id']])->all();
            $pos=OaPosition::find()->where(["pos_id"=>$model['pos_id']])->all();
            $school=OaSchool::find()->where(["school_id"=>$model['school_id']])->all();
            return $this->render('update', [
                'model' => $model,
                'dep'=>$dep,
                'pos'=>$pos,
                'school'=>$school,
            ]);
        }
    }
    /*给所有用户增加权限*/
    public function actionUpdate2($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $po=Yii::$app->request->post()['OaUser']['duty_id'];
            $pubf=implode(',',$po);//组合接收的数组
            
            $model->duty_id=$pubf;

            $model->save();
            return $this->redirect(['index']);
        } else {
            $dep=OaDepartment::find()->where(["dep_id"=>$model['dep_id']])->all();
            $pos=OaPosition::find()->where(["pos_id"=>$model['pos_id']])->all();
            $school=OaSchool::find()->where(["school_id"=>$model['school_id']])->all();
            $duty=OaDuty::find()->all();
            return $this->render('update2', [
                'model' => $model,
                'dep'=>$dep,
                'pos'=>$pos,
                'school'=>$school,
                'duty'=>$duty,
            ]);
        }
    }
    /*给中层设置权限管理所属部门*/
    public function actionUpdate3($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $model->oa_auth=1;
            $model->save();
            return $this->redirect(['gindex']);
        } else{echo "失败";}
    }
    /*修改密码*/
    public function actionUpwd()
    {   
        $model=new OaUser;
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');
        if ($model->load(Yii::$app->request->post())) {
           $password=Yii::$app->request->post()['OaUser']['oa_xpwd'];
           $a=Yii::$app->db->createCommand()->update('oa_user', ['oa_pwd' => md5($password)], "oa_uid = {$a}")->execute();
           if($a)
           {
            return $this->redirect(['index']);
           }
           else
           {
            echo "失败";
           }
            
        }  
        else
        {
            return $this->render('upwd', [
                 'model'=>$model,
                ]);
        }
    }
    /*ajax验证是否是原密码*/
    public function actionPwd()
    {   
        $session = Yii::$app->session;//设置session
        $session->open();
        $a=$session->get('uid');//得到session值
        $pwd = Yii::$app->request->get('pwd');//input接收的是ajax第二个值的名字
        $user=OaUser::find()->where(['oa_uid'=>$a])->one();
        if(md5($pwd) == $user['oa_pwd'])
        {
            //$a="<div id=\"yzz\" style=\"color:green\" value=\"1\">符合</div>";
            $a="<span id=\"yzz\"  value=\"1\" style=\"color:green\">符合</span>";
            echo $a;
        }
        else
        {
            //$a="<div id=\"yzz\" style=\"color:red\" value=\"2\">输入有误</div>";
            $a="<span id=\"yzz\" value=\"2\" style=\"color:red\">输入有误</span>";
            echo $a;
        }
    }
    /**
     * Deletes an existing Oauser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Oauser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Oauser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Oauser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
