<?php

namespace frontend\controllers;

use common\enum\MessageEnum;
use frontend\models\appealEngine\AppealList;
use frontend\models\appealEngine\Interview;
use frontend\models\AppealSource;
use frontend\models\AppealCallType;
use frontend\models\appealEngine\Appeal;
use frontend\models\Applicant as ActiveRecordApplicant;
use frontend\models\City;
use frontend\models\Employee;
use frontend\models\engine\Common;
use frontend\models\Kafe;
use frontend\models\Vacancy;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;

class ApplicantController extends Controller
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

    public function actionAppealList()
    {
        $citys = City::findAll(['status' => 1]);
        $vacancy = Vacancy::findAll(['status' => 1]);
        $employee = Employee::findAll(['status' => 1]);
        $call_type = AppealCallType::findAll(['status' => 1]);
        $source = AppealSource::findAll(['status' => 1]);
        $kafe = Kafe::findAll(['status' => 1]);

        $applicant_list = new AppealList();

        try{
            $applicant_list->create();
        }catch (Exception $exception){
            print_r($exception->getMessage()); exit;
        }

        return $this->render('index', ['citys' => $citys, 'vacancy' => $vacancy, 'employee' => $employee, 'call_type' => $call_type, 'source' => $source, 'kafe' => $kafe, 'content' => $applicant_list->getArrayDataProvider()]);
    }

    public function actionGetAppealList()
    {
        $applicant_list = new AppealList();

        try{
            $applicant_list->create();
        }catch (Exception $exception){
            print_r($exception->getMessage()); exit;
        }

        return $this->renderAjax('appeal-list', ['content' => $applicant_list->getActiveDataProvider()]);
    }

    public function actionCheckApplicant()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = ActiveRecordApplicant::find()
            ->select(["id", "CONCAT_WS(' ', applicant.surname,' ', applicant.name,' ', applicant.patronymic) AS fio"])
            ->where(['phone' => \Yii::$app->request->post('phone')])
            ->asArray()->one();
        return empty($data) ? ["success" => true] : ["success" => false, "data" => $data];
    }

    public function actionSaveAppeal()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $appeal = new Appeal(\Yii::$app->request->post());

        if(!$appeal->validate()){
            $message = Common::prepareValidateError($appeal->getErrors());
            return ["success" => false, "message" => $message];
        }

        try{
            $appeal->create();
        }catch (Exception $exception){
            return ["success" => true, "message" => $exception->getMessage()];
        }

        return ["success" => true, "message" => MessageEnum::SAVE_SUCCESS];
    }

    public function actionGetInterview()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        try{
            $data =  \frontend\models\Interview::findOne(['id' => \Yii::$app->request->post('appealId')]);
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
}