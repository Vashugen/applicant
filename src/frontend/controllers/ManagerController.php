<?php

namespace frontend\controllers;

use common\enum\MessageEnum;
use frontend\models\AppealCallType;
use frontend\models\AppealSource;
use frontend\models\engine\Common;
use frontend\models\managerEngine\AppealStatus;
use frontend\models\managerEngine\Applicant;
use frontend\models\managerEngine\CallType;
use frontend\models\managerEngine\Employee;
use frontend\models\managerEngine\InterviewStatus;
use frontend\models\managerEngine\Manager;
use frontend\models\managerEngine\Source;
use frontend\models\managerEngine\Vacancy;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;

class ManagerController extends Controller
{
    public $layout;

    public function init()
    {
        parent::init();

        $this->layout = 'main';
    }

    public function actionApplicant(){

        try{
            $list = Applicant::getList();
        }catch (Exception $exception){
            $list = [];
        }

        return $this->render('applicant', ['content' => $list, 'type' => Manager::APPLICANT]);
    }

    public function actionEmployee()
    {
        print_r(\Yii::$app->user); exit;
        try{
            $list = Employee::getList();
        }catch (Exception $exception){
            $list = [];
        }

        return $this->render('employee', ['content' => $list, 'type' => Manager::EMPLOYEE]);
    }

    public function actionVacancy()
    {
        try{
            $list = Vacancy::getList();
        }catch (Exception $exception){
            $list = [];
        }

        return $this->render('vacancy', ['content' => $list, "type" => Manager::VACANCY]);
    }

    public function actionSource()
    {
        try{
            $list = Source::getList();
        }catch (Exception $exception){
            $list = [];
        }

        return $this->render('source', ['content' => $list, "type" => Manager::SOURCE]);
    }

    public function actionCallType()
    {
        try{
            $list = CallType::getList();
        }catch (Exception $exception){
            $list = [];
        }

        return $this->render('call-type', ['content' => $list, "type" => Manager::CALL_TYPE]);
    }

    public function actionAppealStatus()
    {
        try{
            $list = AppealStatus::getList();
        }catch (Exception $exception){
            $list = [];
        }

        return $this->render('appeal-status', ['content' => $list, "type" => Manager::APPEAL_STATUS]);
    }

    public function actionInterviewStatus()
    {
        try{
            $list = InterviewStatus::getList();
        }catch (Exception $exception){
            $list = [];
        }

        return $this->render('interview-status', ['content' => $list, "type" => Manager::INTERVIEW_STATUS]);
    }

    public function actionGetData()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Manager(\Yii::$app->request->post());

        try{
            $data = $model->get();
        }catch (\yii\db\Exception $exception){
            return ['success' => false, 'message' => "Объект не распознан. " . MessageEnum::IT];
        }

        return ['success' => true, 'data' => $data];
    }

    public function actionSave()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $manager = new Manager(\Yii::$app->request->post());

        try{
            $manager->create();
        }catch (Exception $exception){
            return ["success" => false, "message" => $exception->getMessage()];
        }

        return ["success" => true, "message" => MessageEnum::SAVE_SUCCESS];
    }

    public function actionSaveApplicant()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $applicant = new Applicant(\Yii::$app->request->post());

        if(!$applicant->validate()){
            $message = Common::prepareValidateError($applicant->getErrors());
            return ["success" => false, "message" => $message];
        }

        try{
            $applicant->create();
        }catch (Exception $exception){
            return ["success" => false, "message" => $exception->getMessage()];
        }

        return ["success" => true, "message" => MessageEnum::SAVE_SUCCESS];
    }

    public function actionSaveEmployee()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $employee = new Employee(\Yii::$app->request->post());

        try{
            $employee->create();
        }catch (Exception $exception){
            return ["success" => false, "message" => $exception->getMessage()];
        }

        return ["success" => true, "message" => MessageEnum::SAVE_SUCCESS];
    }
}