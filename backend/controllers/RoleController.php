<?php

namespace backend\controllers;

use Yii;
use app\models\OaUser;
use app\models\OaModular;
use app\models\OaBigmodelar;
use backend\models\OaRole;
use app\models\OaPower;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\Session;
use yii\web\UploadedFile;
use yii\bootstrap\Alert;

/**
 * RoleController implements the CRUD actions for OaRole model.
 */
class RoleController extends StoploginController
{
    /**
     * @inheritdoc
     */
    
    /**
     * Lists all OaRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = OaRole::find()->where(['isdel' => 1])->all();
        return $this->render('index', [
            'query'   =>  $query,
        ]);
    }

    /**
     * Displays a single OaRole model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    var $action;
   
    /**
     * Creates a new OaRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有添加角色的权限'); 
            return $this->redirect(['index']);
        }
        $model = new OaRole();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } 
        else {
            return $this->render('create', [
            'model' => $model,
        ]);
        }
    }

    /**
     * Updates an existing OaRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有修改角色的权限'); 
            return $this->redirect(['index']);
        }
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } 
        else {
            return $this->render('update', [
            'model' => $model,
        ]);
        }
    }

    /**
     * Deletes an existing OaRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有删除角色的权限'); 
            return $this->redirect(['index']);
        }
        $abc=OaRole::findOne($id);
        $abc->isdel = 0;
        $abc->save();
        return $this->redirect(['index']);
    }
    /**
     * 权限
     * @return [type] [description]
     */
    public function actionPower($id)
    {
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有权限去设置'); 
            return $this->redirect(['index']);
        }
        $havepower=$this->nowpower();


        $query=OaBigmodelar::find()->joinWith('oaModular')->joinWith('oaModular.oaPower')->asarray()->all();
        // echo "<pre>";print_r($query);die();
        return $this->render('power', [
            'query' => $query,
        ]);
    }

    //禁用
    public function actionStatus($id)
    {
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有此权限'); 
            return $this->redirect(['index']);
        }
        $abc=OaRole::findOne($id);
        $abc->status = 0;
        $abc->save();
        return $this->redirect(['index']);
    }
    /**
     * Finds the OaRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return OaRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaRole::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
