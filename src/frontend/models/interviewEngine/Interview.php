<?php

namespace frontend\models\interviewEngine;

use frontend\models\Appeal;
use frontend\models\AppealRequest;
use frontend\models\engine\Common;
use frontend\models\Interview as ActiveRecordInterview;

use yii\base\Model;
use yii\db\Exception;

class Interview extends Model
{

    public $id;

    public $appeal_id;

    public $kafe_id;

    public $date;

    public $status;

    public $comment;

    const CREATE_CALL = 10;

    /**
     * @param $id
     * @param $appeal_id
     * @param $kafe_id
     * @param $date
     * @param $comment
     */
    public function __construct($params = [])
    {
        $this->id = (isset($params['interviewId']) && !empty($params['interviewId'])) ? $params['interviewId'] : null;
        $this->appeal_id = (isset($params['appealId']) && !empty($params['appealId'])) ? $params['appealId'] : null;
        $this->kafe_id = (isset($params['kafeId']) && !empty($params['kafeId'])) ? $params['kafeId'] : null;
        $this->date = (isset($params['date']) && !empty($params['date'])) ? $params['date'] : null;
        $this->status = (isset($params['status']) && !empty($params['status'])) ? $params['status'] : null;
        $this->comment = (isset($params['comment']) && !empty($params['comment'])) ? $params['comment'] : null;
    }

    public function rules()
    {
        return [
            [['kafe_id', 'date'], 'required', 'message' => "Поле точка и дата не могут быть пустыми"]
        ];
    }

    public function create()
    {
        try{
            $this->saveInterviewData();
        }catch (Exception $exception){
            throw $exception;
        }

        try{
            $this->saveLog();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    public function setStatus()
    {
        try{
            $this->saveInterviewStatus();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    //create interview start
    private function saveInterviewData()
    {
        print_r($this); exit;
        $model = empty($this->id) ? new ActiveRecordInterview() : ActiveRecordInterview::findOne(['id' => $this->id]);

        foreach ($this->getAttributes() as $key => $item){
            if(array_key_exists($key, $model->getAttributes())){
                $model->$key = $item;
            }
        }

        if(!$model->validate()){
            throw new \yii\base\Exception(Common::prepareValidateError($model->getErrors()));
        }

        try{
            $model->save();
        }catch (Exception $exception){
            throw $exception;
        }
    }
    //create interview finish

    //set status start
    private function saveInterviewStatus()
    {

        $model = ActiveRecordInterview::findOne(['id' => $this->id]);
        $model->status = $this->status;

        if(!$model->validate()){
            throw new \yii\base\Exception(Common::prepareValidateError($model->getErrors()));
        }

        try{
            $model->save();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    private function createCall()
    {
        if($this->status == self::CREATE_CALL){

            $appeal_data = ActiveRecordInterview::find()
                ->alias('i')
                ->select(['appeal.*'])
                ->leftJoin(['appeal' => Appeal::tableName()], 'appeal.id = i.appeal_id')
                ->where(['i.id' => $this->id])->one();

            print_r($appeal_data); exit;

            $model = new AppealRequest();
            $model->applicant_id = 1;
            $model->city_id = 1;
            $model->kafe_id = 1;

            if(!$model->validate()){
                throw new \yii\base\Exception(Common::prepareValidateError($model->getErrors()));
            }

            try{
                $model->save();
            }catch (Exception $exception){
                throw $exception;
            }
        }
    }
    //set status finish

    private function saveLog(){

    }

}