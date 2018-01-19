<?php

namespace backend\controllers;

use Yii;
use app\models\OaDepartment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\bootstrap\Alert;
use app\models\OaSchool;
use app\models\OaUser;
use app\models\OaTree;
/**
 * OadepartmentController implements the CRUD actions for OaDepartment model.
 */
class OadepartmentController extends StoploginController
{
    /**
     * Lists all OaDepartment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = OaDepartment::find()->Where(['dep_softdel'=>'1']);
        if(Yii::$app->request->post('user'))
        {
            $list1=Yii::$app->request->post('user');
            $query->andWhere(['dep_name'=>$list1]);
        }
        $pagesize="15";
        $pages = new Pagination([  
                'totalCount' => $query->count(),'pageSize' => $pagesize,
            ]);

        $countries = $query
                ->orderBy('dep_id','asc')
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
     * Displays a single OaDepartment model.
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
     * Creates a new OaDepartment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        header("content-type:text/html;charset=utf-8");
        $model = new OaDepartment();
        $u= new OaUser();
        $user=$u->find()->orderBy('oa_uid','asc')->andWhere(['oa_status'=>'1'])->all();
        $school=OaSchool::find()->andWhere(['school_softdel'=>'1'])->all();
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有添加部门的权限'); 
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          $tree=new OaTree();
           $tree->name=Yii::$app->request->post('OaDepartment')['dep_name'];
           $scid=Yii::$app->request->post('OaDepartment')['school_id'];
           
           $scnames=OaTree::find()->select('id')->where(['school_id'=>$scid])->asarray()->one();
           
            if($model->save())
            {
                $ww=$model->primaryKey;
                $tree->fid=$scnames['id'];
                $tree->dep_id=$ww;
                $tree->status='1';
                $tree->save();
                \Yii::$app->getSession()->setFlash('success', '添加成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '添加失败');    
            }
            return $this->redirect(['index', 'id' => $model->dep_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'school'=>$school,
                'user'=>$user,
            ]);
        }
    }
    /*
     *ajax判断
     */
    public function actionAjax()
    {
        $model = new OaDepartment();
        if(Yii::$app->request->get('pos')=='教学部')
        {
            $spr=$model->dep_logo=1;     
        }
        if(Yii::$app->request->get('pos')=='学工部')
        {
            $spr=$model->dep_logo=2;
        }
        if(Yii::$app->request->get('pos')=='后勤部')
        {
            $spr=$model->dep_logo=3;
        }
        if(Yii::$app->request->get('pos')=='督察部')
        {
            $spr=$model->dep_logo=4;
        }
        if(Yii::$app->request->get('pos')=='市场部')
        {
            $spr=$model->dep_logo=5;
        }
        
        echo $spr;
    }

    /**
     * Updates an existing OaDepartment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $u= new OaUser();
        $user=$u->find()->orderBy('oa_uid','asc')->andWhere(['oa_status'=>'1'])->all();
        $school=OaSchool::find()->andWhere(['school_softdel'=>'1'])->all();
        $t=OaTree::find()->where(['dep_id'=>$id])->one();
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有修改部门的权限'); 
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $t->name=Yii::$app->request->post('OaDepartment')['dep_name'];
            $t->save();
            if($model->save())
            {
                \Yii::$app->getSession()->setFlash('success', '修改成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '修改失败');    
            }
            return $this->redirect(['index', 'id' => $model->dep_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'school'=>$school,
                'user'=>$user,
            ]);
        }
    }

    /**
     * Deletes an existing OaDepartment model.
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
    public function actionRdelete()
    {
      //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有删除部门的权限'); 
            return $this->redirect(['index']);
        }
        $id = Yii::$app->request->get('id');
        $tre= new OaTree;
        $User = OaDepartment::findOne($id);
        $User->dep_softdel = 0;
        $te = $tre->find()->where(['dep_id'=>$id])->one();
        $te->status = "0";
        $te->save();
        $res=$User->save();
        if($res)
        echo $User->dep_id;
    }
    /**
     * Finds the OaDepartment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaDepartment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaDepartment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
