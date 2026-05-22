<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;

class RegionController extends Controller
{
    public $layout = '@app/views/layouts/location_layout';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Demo index
     */
    public function actionIndex()
    {
        $dataProvider = [
            [
                'id' => 1,
                'description' => 'Central Region',
                'country' => 'Uganda',
                'status' => 'Active',
            ],
            [
                'id' => 2,
                'description' => 'Western Region',
                'country' => 'Uganda',
                'status' => 'Active',
            ],
            [
                'id' => 3,
                'description' => 'Eastern Region',
                'country' => 'Kenya',
                'status' => 'Inactive',
            ],
        ];

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => null,
            'pages' => null,
            'sort' => null,
        ]);
    }

    /**
     * Demo view
     */
    public function actionView($id)
    {
        $model = [
            'id' => $id,
            'description' => 'Central Region',
            'country' => 'Uganda',
            'status' => 'Active',
            'created_on' => date('Y-m-d H:i:s'),
        ];

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Demo create
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {

            Yii::$app->session->setFlash(
                'success',
                'Demo region created successfully.'
            );

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => [],
        ]);
    }

    /**
     * Demo update
     */
    public function actionUpdate($id)
    {
        $model = [
            'id' => $id,
            'description' => 'Central Region',
            'country_id' => 1,
        ];

        if (Yii::$app->request->isPost) {

            Yii::$app->session->setFlash(
                'success',
                'Demo region updated successfully.'
            );

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Demo delete
     */
    public function actionDelete($id)
    {
        Yii::$app->session->setFlash(
            'success',
            'Demo region deleted successfully.'
        );

        return $this->redirect(['index']);
    }

    /**
     * Demo upload
     */
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {

            Yii::$app->session->setFlash(
                'success',
                'Demo Excel uploaded successfully.'
            );

            return $this->redirect(['index']);
        }

        return $this->render('upload', [
            'model' => [],
        ]);
    }

    /**
     * Demo model finder
     */
    protected function findModel($id)
    {
        if ($id) {
            return [
                'id' => $id,
                'description' => 'Central Region',
                'country' => 'Uganda',
            ];
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
