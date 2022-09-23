<?php

namespace frontend\controllers;

use frontend\models\appealEngine\InterviewList;
use frontend\models\City;
use frontend\models\Kafe;
use frontend\models\Vacancy;
use yii\web\Controller;

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

    public function index()
    {
        $citys = City::findAll(['status' => 1]);
        $kafe = Kafe::findAll(['status' => 1]);
        $vacancy = Vacancy::findAll(['status' => 1]);

        $interview_list = new InterviewList();

        try{
            $interview_list->create();
        }catch (Exception $exception){
            print_r($exception->getMessage()); exit;
        }

        return $this->render('index', ['citys' => $citys, 'vacancy' => $vacancy, 'kafe' => $kafe, 'content' => $interview_list->getActiveDataProvider()]);

    }
}