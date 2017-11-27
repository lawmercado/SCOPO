<?php

namespace app\modules\base\controllers;

use Yii;
use app\modules\base\models\Produtor;
use app\modules\base\models\Pessoa;
use app\modules\base\models\ProdutorSearch;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\base\components\BaseAccessRule;
use app\modules\base\models\Usuario;

/**
 * ProdutorController implements the CRUD actions for Produtor model.
 */
class ProdutorController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => BaseAccessRule::className(),
                ],
                'only' => ['index','create','update','view', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Usuario::PAPEL_ADMINISTRADOR],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Produtor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdutorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produtor model.
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
     * Creates a new Produtor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produtor();
        $pessoa = new Pessoa();
        
        if ($model->load(Yii::$app->request->post()) && $pessoa->load(Yii::$app->request->post())) {
            $pessoa->save();
            
            $model->pessoa_id = $pessoa->pessoa_id;
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->produtor_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'pessoa' => $pessoa
            ]);
        }
    }

    /**
     * Updates an existing Produtor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pessoa = $model->pessoa;
        
        if ($model->load(Yii::$app->request->post()) && $pessoa->load(Yii::$app->request->post())) {
            $pessoa->save();
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->produtor_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'pessoa' => $pessoa
            ]);
        }
    }

    /**
     * Deletes an existing Produtor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->pessoa->delete();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produtor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produtor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produtor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
