<?php

namespace app\controllers;

use Yii;
use app\models\Bin;
use app\models\BinSearch;
use app\models\Stuff;
use app\models\StuffSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;


/**
 * BinController implements the CRUD actions for Bin model.
 */
class BinController extends Controller
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
     * Lists all Bin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bin model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['binstuff', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Bin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionStuffdelete($id, $bin_id)
    {
        $newStuffModel = Stuff::findOne($id);
        $newStuffModel->delete();

        return $this->redirect(['binstuff', 'id' => $bin_id]);
    }

    /**
     * Finds the Bin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function getStuffs()
    {
        return $this->hasOne(StuffSearch::className(), ['id' => 'bin_id']);
    }

    /**
     * Creates a new Bin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBinstuff($id)
    {
        $model = $this->findModel($id);
        $newStuffModel = new Stuff();

        Yii::trace('start calculating average revenue');

        if (Yii::$app->request->post('Stuff')) {
            $newStuff = new Stuff();
            if ($newStuff->load(Yii::$app->request->post()) && $newStuff->save()) {
                return $this->redirect(['binstuff', 'id' => $model->number]);
            }
        }

        if ($model->load(Yii::$app->request->post()) ) {
            return $this->redirect(['binstuff', 'id' => $model->number]);
        };

	$items = ArrayHelper::map(Bin::find()->all(), 'id', 'number');

	$query = Stuff::find()->where(['bin_id' => $id]);
        $stuffs = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('binstuff', [
            'model' => $this->findModel($id),
            'items'=>$items,
            'stuffs'=>$stuffs,
            'newStuffModel'=>$newStuffModel,
            'number'=>$id,
        ]);
    }

}
