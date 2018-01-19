<?php

namespace backend\controllers;

use Yii;
use app\models\OaRacord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;


/**
 * RacordController implements the CRUD actions for OaRacord model.
 */
class RacordController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OaRacord models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query = OaRacord::find();

        $pagination = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $query->count(),
        ]);

        $data = $query->orderBy('racord_time DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        $dataProvider = new ActiveDataProvider([
            'query' => OaRacord::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'data'         =>$data,
            'pagination'  =>$pagination
        ]);
    }

    /**
     * Displays a single OaRacord model.
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
     * Creates a new OaRacord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaRacord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->racord_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaRacord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->racord_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaRacord model.
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
     * Finds the OaRacord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaRacord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaRacord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
    public function actionTuncatetable()
    {
        $request = Yii::$app->request;
        if(!empty($request->get('del')))
        {
            Yii::$app->db->createCommand('truncate TABLE oa_racord')->queryAll();
        }
    }
    */
}
