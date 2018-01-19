<?php

namespace backend\controllers;

use Yii;
use app\models\OaUser;
use backend\models\OaRole;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for OaUser model.
 */
class UserController extends StoploginController
{
    /**
     * @inheritdoc
     */
    
    /**
     * Lists all OaUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = OaUser::find()->where(['oa_status' => 1])->orwhere(['oa_status' => 0])->all();
        //print_r($query);die();
        return $this->render('index', [
            'query' => $query,
        ]);
    }

    /**
     * Displays a single OaUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OaUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->request->post()) {
            $aaa = Yii::$app->request->post();//echo "<pre>";print_r($aaa);echo $aaa['oa_uname'];
            $abc =new OaUser;
            $abc->oa_uname = $aaa['oa_uname'];
            $abc->oa_pwd = md5($aaa['oa_pwd']);
            $abc->oa_emil = $aaa['oa_emil'];
            $abc->role_id = $aaa['role_id'];
            $abc->oa_status = $aaa['oa_status'];
            $abc->save();
            if($abc->save()>0){
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        //$model = $this->findModel($id);
        $query1 = OaRole::find()->asarray()->all();
        return $this->render('create', [
                'query1' => $query1,
            ]);
    }

    /**
     * Updates an existing OaUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post()) {
            $aaa = Yii::$app->request->post();//echo "<pre>";print_r($aaa);echo $aaa['oa_uname'];
            $abc=OaUser::findOne($id);
            $abc->oa_uname = $aaa['oa_uname'];
            $abc->oa_pwd = md5($aaa['oa_pwd']);
            $abc->oa_emil = $aaa['oa_emil'];
            $abc->role_id = $aaa['role_id'];
            $abc->oa_status = $aaa['oa_status'];
            $abc->save();
        }
        //$model = $this->findModel($id);
        $query1 = OaRole::find()->asarray()->all();
        $query2 = OaUser::find()->where(['oa_uid' => $id])->asarray()->one();//echo"<pre>";print_r($query2);die();
        return $this->render('update', [
                'query1' => $query1,
                'query2' => $query2,
            ]);
        // if ($aaa = Yii::$app->request->post()) {
        //     $pwd=Yii::$app->request->post()['OaUser']['oa_pwd'];
        //     $model->oa_pwd=md5($pwd);
        //     $model->save();
        //     return $this->redirect(['index', 'id' => $model->oa_uid]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing OaUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $abc=OaUser::findOne($id);
        $abc->oa_status = 0;
        $abc->save();
        return $this->redirect(['index']);
    }
    public function actionStatus($id)
    {
        $abc=OaUser::findOne($id);
        $abc->oa_status = 0;
        $abc->save();
        return $this->redirect(['index']);
    }
    /**
     * Finds the OaUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
