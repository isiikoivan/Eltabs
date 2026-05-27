<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * CountryController dummy version
 */
class CountryController extends Controller
{
//    public $layout = '@app/views/layouts/location_layout';

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

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    /**
     * Dummy index
     */
    public function actionIndex()
    {
        $dataProvider = [
            [
                'id' => 1,
                'description' => 'Uganda',
                'code' => 'UG',
                'status' => 'Active',
            ],
            [
                'id' => 2,
                'description' => 'Kenya',
                'code' => 'KE',
                'status' => 'Active',
            ],
            [
                'id' => 3,
                'description' => 'Tanzania',
                'code' => 'TZ',
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
     * Dummy view
     */
    public function actionView($id)
    {
        $model = [
            'id' => $id,
            'description' => 'Uganda',
            'code' => 'UG',
            'status' => 'Active',
            'created_on' => date('Y-m-d H:i:s'),
        ];

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Dummy create
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {

            Yii::$app->session->setFlash(
                'success',
                'Dummy country created successfully.'
            );

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => [],
        ]);
    }

    /**
     * Dummy update
     */
    public function actionUpdate($id)
    {
        $model = [
            'id' => $id,
            'description' => 'Dummy Country',
        ];

        if (Yii::$app->request->isPost) {

            Yii::$app->session->setFlash(
                'success',
                'Dummy country updated successfully.'
            );

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Dummy delete
     */
    public function actionDelete($id)
    {
        Yii::$app->session->setFlash(
            'success',
            'Dummy country deleted successfully.'
        );

        return $this->redirect(['index']);
    }

    /**
     * Dummy upload
     */
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {

            Yii::$app->session->setFlash(
                'success',
                'Dummy Excel uploaded successfully.'
            );

            return $this->redirect(['index']);
        }

        return $this->render('upload', [
            'model' => [],
        ]);
    }

    /**
     * Dummy model finder
     */
    protected function findModel($id)
    {
        if ($id) {
            return [
                'id' => $id,
                'description' => 'Dummy Country',
            ];
        }

        throw new NotFoundHttpException('Item not found.');
    }
}
