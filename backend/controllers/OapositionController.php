<?php

namespace backend\controllers;

use Yii;
use app\models\OaPosition;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\bootstrap\Alert;
use app\models\OaSchool;
use app\models\OaDepartment;
use app\models\OaTree;
/**
 * OapositionController implements the CRUD actions for OaPosition model.
 */
class OapositionController extends StoploginController
{

    /**
     * Lists all OaPosition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query= OaPosition::find();
        $query->andWhere(['pos_softdel'=>'1']);
        $countries = OaPosition::find()->orderBy('pos_id','asc')->all();
        if(Yii::$app->request->post('user'))
        {
            $list1=Yii::$app->request->post('user');
            $query->where(['pos_name'=>$list1]);
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
     * Displays a single OaPosition model.
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
     * Creates a new OaPosition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaPosition();
        $oaposition=OaSchool::find()->andWhere(['school_softdel'=>'1'])->all();
        $oadepartment=OaDepartment::find()->andWhere(['dep_softdel'=>'1'])->all();
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有删除校区的权限'); 
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
           $tree=new OaTree();
           $tree->name=Yii::$app->request->post('OaPosition')['pos_name'];
           $scid=Yii::$app->request->post('OaPosition')['dep_id'];
           $scname=OaTree::find()->select('id')->where(['dep_id'=>$scid])->asarray()->one();
            if($model->save())
            {    
                $ww=$model->primaryKey;
                $tree->fid=$scname['id']; 
                $tree->pos_id=$ww;
                $tree->status='1';
                $tree->save();
                \Yii::$app->getSession()->setFlash('success', '添加成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '添加失败');    
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'oaposition'=>$oaposition,
                'oadepartment'=>$oadepartment,
            ]);
        }
    }

    /**
     * Updates an existing OaPosition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oadepartment=OaDepartment::find()->andWhere(['dep_softdel'=>'1'])->all();
        $oaposition=OaSchool::find()->andWhere(['school_softdel'=>'1'])->all();
        $t=OaTree::find()->where(['pos_id'=>$id])->one();
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有删除校区的权限'); 
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $t->name=Yii::$app->request->post('OaPosition')['pos_name'];
            $t->save();
            if($model->save())
            {
        
                \Yii::$app->getSession()->setFlash('success', '修改成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '修改失败');    
            }
            return $this->redirect(['index', 'id' => $model->pos_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'oaposition'=>$oaposition,
                'oadepartment'=>$oadepartment,
            ]);
        }
    }

    /**
     * Deletes an existing OaPosition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /*
     *软删除
     */
    public function actionRdelete($id)
    {
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有删除校区的权限'); 
            return $this->redirect(['index']);
        }
        $id = Yii::$app->request->get('id');
        $tre= new OaTree;
        $User = OaPosition::findOne($id);
        $User->pos_softdel = 0;
        $te = $tre->find()->where(['pos_id'=>$id])->one();
        $te->status = 0;
        $te->save();
        $res=$User->save();
        if($res)
        echo $User->pos_id;
    }
    /**
     * Finds the OaPosition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaPosition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaPosition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
