<?php

namespace backend\controllers;

use Yii;
use app\models\OaSchool;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\bootstrap\Alert;
use app\models\OaDepartment;
use app\models\OaPosition;
use app\models\OaUser;
use app\models\OaTree;
/**
 * OaschoolController implements the CRUD actions for OaSchool model.
 */
class OaschoolController extends StoploginController
{
    /**
     * Lists all OaSchool models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query= OaSchool::find();
        $query->andWhere(['school_softdel'=>'1']);
        $countries = OaSchool::find()->orderBy('school_id','asc')->all();
        if(Yii::$app->request->post('user'))
        {
            $list1=Yii::$app->request->post('user');
            $query->where(['school_name'=>$list1]);
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
     * Displays a single OaSchool model.
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
     * Creates a new OaSchool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return m9ixed
     */
    public function actionCreate()
    {
        $model = new OaSchool();
        $session = Yii::$app->session;
        $session->open();
        $a=$session->get('nickname');
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有添加校区的权限'); 
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           $tree=new OaTree();
           $tree->name=Yii::$app->request->post('OaSchool')['school_name'];
           $scid=Yii::$app->request->post('OaTree')['id'];
           $scname=OaSchool::find()->select('school_name')->where(['school_id'=>$scid])->asarray()->one();
           $scname=$scname['school_name'];
           $fid=OaTree::find()->select('id')->where(['name'=>$scname])->asarray()->one();
            if($model->save())
            {
              $tree->fid=1;
              $ww=$model->primaryKey;
                $tree->school_id=$ww;
                $tree->status='1'; 
                $tree->save();
                \Yii::$app->getSession()->setFlash('success', '添加成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '添加失败');    
            }
            
             return $this->redirect(['index', 'id' => $model->school_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'a'=>$a,
            ]);
        }
    }
    public function actionPower()
    {
      return $this->render('power');
    }
    /*
     *树状结构循环
     */
    public function actionPowers()
    {
      header("content-type:text/html;charset=utf-8");
      $data= OaTree::find()->joinwith('oaposition')->joinwith('oaschool')->joinwith('oadepartment')->andwhere(['status'=>'1'])->asarray()->all();
          // 将数据按照所属关系封装  
          function arr2tree($tree, $rootId = 0) {  
              $return = array();  
              foreach($tree as $leaf) {  
                  if($leaf['fid'] == $rootId) {  
                      foreach($tree as $subleaf) {  
                          if($subleaf['fid'] == $leaf['id']) {  
                              $leaf['children'] = arr2tree($tree, $leaf['id']);  
                              break;  
                          }  
                      }  
                      $return[] = $leaf;  
                  }  
              }  
              return $return;  
          }  
            
            
            $tree= arr2tree($data);
          // 将数据使用HTML再次展现  
          function tree2html($tree) {  
              echo '<ul>';  
              foreach($tree as $leaf) {
                  echo '<li>'.$leaf['name'];
                 
                   //echo '<li>' .$leaf['oaschool']['school_name'];
                   
              
              
                  if(! empty($leaf['children'])) tree2html($leaf['children']);  
                  echo '</li>'; 

              } 

              echo '</ul>';  
          }  
          
          tree2html($tree); 
          
    }
    public function actionAjax()
    {
       $a = Yii::$app->request->get('a');//input接收的是ajax第二个值的名字
        $school=new OaSchool;
        $aa=$school->find()->where(["school_id"=>$a])->asarray()->one();
        //echo $aa['school_id'];
       // echo "<meta charset='utf-8'>";
        //print_r($aa);
        echo json_encode($aa);
    }
    /**
     * Updates an existing OaSchool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	header("content-type:text/html;charset=utf-8");
        $model = $this->findModel($id);
        $session = Yii::$app->session;
        $session->open();
        $a=$session->get('nickname');
        //获取当前控制器和action名称
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $not=$this->whether($controller,$action);
        if($not!='yes')
        {
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有修改校区的权限'); 
            return $this->redirect(['index']);
        }
        $t=OaTree::find()->where(['school_id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	 $t->name=Yii::$app->request->post('OaSchool')['school_name'];
        	 $t->save();
            if($model->save())
            {
                \Yii::$app->getSession()->setFlash('success', '修改成功'); 
            }
            else
            {
                  \Yii::$app->getSession()->setFlash('error', '修改失败');    
            }
            return $this->redirect(['index', 'id' => $model->school_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'a'=>$a,
            ]);
        }
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
            \Yii::$app->getSession()->setFlash('success', '对不起，您没有删除校区的权限'); 
            return $this->redirect(['index']);
        }
        header("content-type:text/html;charset=utf-8");
        $id = Yii::$app->request->get('id');
       	$school=new OaSchool;
       	$pos= new OaPosition;
        $user= new OaUser;
       	$tre= new OaTree;
        $oadepartment=new OaDepartment;
        $sc=$oadepartment->find()->where(['school_id'=>$id])->andwhere(['dep_softdel'=>'1'])->asarray()->all();
        $oaposition=$pos->find()->where(['school_id'=>$id])->andwhere(['pos_softdel'=>'1'])
            ->asarray()->all();
        $use=$user->find()->where(['school_id'=>$id])->andwhere(['oa_status'=>'1'])
            ->asarray()->all();
       $tree=$tre->find()->where(['school_id'=>$id])->andwhere(['status'=>'1'])->asarray()->all();
 		
        if(!empty($sc) || !empty($oaposition) || !empty($use)){
        	echo "当前校区包含其他数据，不能删除";
        }else{
        	$sch = $school->find()->where(['school_id'=>$id])->one();
        	$te = $tre->find()->where(['school_id'=>$id])->one();
        	$sch->school_softdel = "0";
        	$te->status = "0";
        	$te->save();
        	$num = $sch->save();

        	if($num==1){
        		echo '删除成功';
        	}
        }
        
    }
    /**
     * Deletes an existing OaSchool model.
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
     * Finds the OaSchool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaSchool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaSchool::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
