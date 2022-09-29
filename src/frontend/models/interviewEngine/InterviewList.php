<?php

namespace frontend\models\interviewEngine;

use frontend\models\Appeal;
use frontend\models\Interview;
use yii\base\Exception;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class InterviewList extends Model
{

    public $city_id;

    public $kafe_id;

    public $vacancy_id;

    private $result;

    /**
     * @param $city_id
     * @param $kafe_id
     * @param $vacancy_id
     */
    public function __construct($params = [])
    {
        $this->city_id = (isset($params['searchCity']) && !empty($params['searchCity'])) ? $params['searchCity'] : null;
        $this->kafe_id = (isset($params['searchKafe']) && !empty($params['searchKafe'])) ? $params['searchKafe'] : null;
        $this->vacancy_id = (isset($params['searchVacancy']) && !empty($params['searchVacancy'])) ? $params['searchVacancy'] : null;
    }

    public function getArrayDataProvider()
    {
        return new ArrayDataProvider([
            'allModels' => $this->result,
            'sort' => [
                'attributes' => [
                    'fio', 'phone'
                ]
            ]
        ]);
    }

    public function getActiveDataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->query,
            'sort' => [
                'attributes' => [
                    'fio', 'phone'
                ]
            ]
        ]);
    }

    public function create()
    {
/*        try {
            $this->prepareParams();
        }catch (\Exception $exception){
            throw $exception;
        }*/

        try{
            $this->createList();
        }catch (\Exception $exception){
            throw $exception;
        }

        try{
            $this->prepareList();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    private function createList()
    {
        $this->result = Interview::find()
            ->alias('i')
            ->select(['i.*', "CONCAT_WS(' ', applicant.surname,' ', applicant.name,' ', applicant.patronymic) AS fio", 'applicant.phone', 'vacancy.name as vacancy', 'appeal.comment AS appeal_comment', 'i.comment AS interview_comment'])
                //, new Expression('CASE ')])
            ->leftJoin(['appeal' => Appeal::tableName()], 'i.appeal_id = appeal.id')
            ->leftJoin('kafe', 'kafe.id = i.kafe_id')
            ->leftJoin('applicant', 'applicant.id = appeal.applicant_id')
            ->leftJoin('vacancy', 'vacancy.id = appeal.vacancy_id')
            ->where(['i.status' => 1])
            //->andWhere(проверка на точки)
            ->asArray()->all();
    }

    private function prepareList()
    {

    }

}