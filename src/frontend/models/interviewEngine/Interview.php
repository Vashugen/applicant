<?php

namespace frontend\models\appealEngine;

use yii\db\Exception;

class Interview extends \yii\base\Model
{

    public $id;

    public $appeal_id;

    public $kafe_id;

    public $date;

    public $comment;

    /**
     * @param $id
     * @param $appeal_id
     * @param $kafe_id
     * @param $date
     * @param $comment
     */
    public function __construct($params = [])
    {
        print_r($params); exit;
        $this->id = (isset($params['id']) && !empty($params['id'])) ? $params['id'] : null;
        $this->appeal_id = (isset($params['appealId']) && !empty($params['appealId'])) ? $params['appealId'] : null;
        $this->kafe_id = (isset($params['kafeId']) && !empty($params['kafeId'])) ? $params['kafeId'] : null;
        $this->date = (isset($params['date']) && !empty($params['date'])) ? $params['date'] : null;
        $this->comment = (isset($params['comment']) && !empty($params['comment'])) ? $params['comment'] : null;
    }

    public function create()
    {
        try{
            $this->prepareParams();
        }catch (\yii\base\Exception $exception){
            throw $exception;
        }

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

}