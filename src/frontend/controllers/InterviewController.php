<?php

namespace frontend\controllers;

use common\enum\MessageEnum;
use frontend\models\City;
use frontend\models\engine\Common;
use frontend\models\interviewEngine\Interview;
use frontend\models\interviewEngine\InterviewList;
use frontend\models\InterviewStatus;
use frontend\models\Kafe;
use frontend\models\Vacancy;
use yii\base\Exception;
use yii\caching\DummyCache;
use yii\web\Controller;
use yii\web\Response;

class InterviewController extends Controller
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

    public function actionIndex()
    {
        $citys = City::findAll(['status' => 1]);
        $kafe = Kafe::findAll(['status' => 1]);
        $vacancy = Vacancy::findAll(['status' => 1]);
        $interview_status = InterviewStatus::findAll(['status' => 1]);

        $interview_list = new InterviewList();

        try{
            $interview_list->create();
        }catch (Exception $exception){
            return $this->render('/engine/error', ['error' => $exception->getMessage()]);
        }

        return $this->render('index', ['citys' => $citys, 'vacancy' => $vacancy, 'kafe' => $kafe, 'interview_status' => $interview_status, 'content' => $interview_list->getArrayDataProvider()]);

    }

    public function actionGetList()
    {
        $applicant_list = new InterviewList();

        try{
            $applicant_list->create();
        }catch (Exception $exception){
            return $this->renderAjax('/engine/error', ['error' => $exception->getMessage()]);
        }

        return $this->renderAjax('appeal-list', ['content' => $applicant_list->getActiveDataProvider()]);
    }

    public function actionGetInterview()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try{
            $data = \frontend\models\Interview::findOne(['id' => \Yii::$app->request->post('id')]);
        }catch (\yii\db\Exception $exception){
            return ['success' => true, 'message' => $exception->getMessage()];
        }

        return ['success' => true, 'data' => $data];
    }

    public function actionSetInterview()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $interview = new Interview(\Yii::$app->request->post());
print_r($interview); exit;
        if(!$interview->validate()){
            $message = Common::prepareValidateError($interview->getErrors());
            return ["success" => false, "message" => $message];
        }

        try{
            $interview->create();
        }catch (Exception $exception){
            return ["success" => true, "message" => $exception->getMessage()];
        }

        return ["success" => true, "message" => MessageEnum::SAVE_SUCCESS];
    }

    public function actionSetInterviewStatus()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $interview = new Interview(\Yii::$app->request->post());

        try{
            $interview->setStatus();
        }catch (Exception $exception){
            return ["success" => true, "message" => $exception->getMessage()];
        }

        return ["success" => true, "message" => MessageEnum::SAVE_SUCCESS];
    }
}