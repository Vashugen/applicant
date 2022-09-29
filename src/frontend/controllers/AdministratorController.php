<?php

namespace frontend\controllers;

use frontend\models\administratorEngine\UserForm;
use frontend\models\administratorEngine\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AdministratorController extends Controller
{
    public $layout;

    public function init()
    {
        parent::init();

        $this->layout = 'main';

    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionUser()
    {
        var_dump(\Yii::$app->user->isGuest); exit;
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new UserForm();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user']);
        }

        return $this->render('create', [
            'model' => $model,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    public function actionSynchronization()
    {

    }
}