<?php

namespace app\controllers;

use app\models\Letters;
use Yii;
use app\models\Tasks;
use app\models\TasksSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
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
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {

        if( ! \Yii::$app->user->can('TaskListView')){
            return $this->goHome();
        };
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCurrent(){

        if( ! \Yii::$app->user->can('TaskListCurrentView')){
            return $this->goHome();
        };

        if (!isset(Yii::$app->request->queryParams['date'])){
            $CurrentDate = date("Y-M-d");
            $DateBegin = date("Y-M-01");
            $DateEnd = date("Y-M-t");
        }else{
            $CurrentDate = strtotime(Yii::$app->request->queryParams['date']);
            $DateBegin = date("Y-M-01", $CurrentDate);
            $DateEnd = date("Y-M-t", $CurrentDate);

        }

        $user_id = Yii::$app->user->id;
        $cache = \yii::$app->cache;
        $key = "taskCurrent_".$user_id.$DateBegin.$DateEnd;

        if($cache->exists($key)){

            $model = $cache->get($key);

        }else{

            $searchModel = new TasksSearch();
            $params = [
                        'TasksSearch' => ['user_id' => $user_id],
                        'r'=>'tasks'
                      ];

            $dataProvider = $searchModel->search($params);
            $dataProvider->query
                ->andFilterWhere(['>=', 'date',  $DateBegin])
                ->andFilterWhere(['<=', 'date',  $DateEnd]);

            $model = [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'currentDate' => $CurrentDate,
            ];

            $cache->set($key,$model,100);


        }

        //$model['currentDate'][] = $CurrentDate;
        return $this->render('current', $model);
    }
    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if( ! \Yii::$app->user->can('TaskView')){
            return $this->goHome();
        };

        $model = $this->findModel($id);
        $model->file = "/img/".$model->file;
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if( ! \Yii::$app->user->can('TaskUpdate')){
            return $this->goHome();
        };

        $model = new Tasks();


        $model->on(Tasks::EVENT_AFTER_INSERT, function ($event){
            $Lt = new Letters();
            $Lt->text = 'new task '.$event->sender->name;
            $Lt->user_id = $event->sender->user_id;
            $Lt->save();
        });


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if( ! \Yii::$app->user->can('TaskUpdate')){
            return $this->goHome();
        };

        $model = $this->findModel($id);

        if (Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');

            $fileName = $model->file->getBaseName().".".$model->file->getExtension();
            $model->saveUploadedFile($fileName);
            $model->file = $fileName;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if( ! \Yii::$app->user->can('TaskDelete')){
            return $this->goHome();
        };

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
