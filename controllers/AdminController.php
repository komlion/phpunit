<?php

namespace app\controllers;

use app\models\Cartridge;
use app\models\Category;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class AdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->identity->isAdmin();
                        }
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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Products::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $count = Cartridge::find()->one();

        return $this->render('index', compact('dataProvider', 'count'));
    }

    public function actionView($id, $status = null)
    {
        $model = Products::findOne($id);
        return $this->render('view', compact('model'));
    }

    public function actionSuccess($id)
    {
        $model = Products::findOne($id);
        $model->status = 1;
        $model->save(false);
        return $this->redirect(['/admin/view?id=' . $id]);
    }

    public function actionCancel($id)
    {
        $model = Products::findOne($id);
        $model->status = 2;
        $model->save(false);
        return $this->redirect(['/admin/view?id=' . $id]);
    }

    public function actionCategory()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        return $this->render('category', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-category', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionViewCategory($id)
    {
        return $this->render('view-category', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdateCategory($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-category', 'id' => $model->id]);
        }

        return $this->render('update-category', [
            'model' => $model,
        ]);
    }

    public function actionDeleteCategory($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['admin/category']);
    }

    public function actionCartri()
    {
        $model = Cartridge::findOne(1);

        if ($model->load(\Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['admin/index']);
        }
        return $this->render('cartri', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
