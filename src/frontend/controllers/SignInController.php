<?php

namespace frontend\controllers;

use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SignInController extends Controller
{

    public $defaultAction = 'login';
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

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        $this->redirect('/');
    }

}
