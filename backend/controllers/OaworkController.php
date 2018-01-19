<?php

namespace backend\controllers;

use Yii;
use app\models\OaWork;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\bootstrap\Alert;

/**
 * OaworkController implements the CRUD actions for OaWork model.
 */
class OaworkController extends StoploginController
{

    /**
     * Lists all OaWork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query= OaWork::find();
        $query->andWhere(['w_status'=>'1']);
        $countries = OaWork::find()->orderBy('w_id','asc')->all();
        if(Yii::$app->request->post('user'))
        {
            $list1=Yii::$app->request->post('user');
            $query->where(['w_teacher'=>$list1]);
        }
        $pagesize="15";
        $pages = new Pagination([  
                'totalCount' => $query->count(),'pageSize' => $pagesize,
            ]);

        $countries = $query
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('index', [
            'pagesize'=>$pagesize,
            'countries' => $countries,
            'pages'=>$pages
        ]);
    }

    /**
     * Displays a single OaWork model.
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
     * Creates a new OaWork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaWork();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if($model->save())
            {
                \Yii::$app->getSession()->setFlash('success', '添加成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '添加失败');    
            }
            return $this->redirect(['index', 'id' => $model->w_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if($model->save())
            {
                \Yii::$app->getSession()->setFlash('success', '修改成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '修改失败');    
            }
            return $this->redirect(['index', 'id' => $model->w_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /*
     *软删除
     */
    public function actionRdelete()
    {
        $id = Yii::$app->request->get('id');
        $User = OaWork::findOne($id);
        $User->w_status = "0";
        $res=$User->save();
        if($res)
        echo $User->w_id;
    }
    /**
     * Deletes an existing OaWork model.
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
     * Finds the OaWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaWork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
