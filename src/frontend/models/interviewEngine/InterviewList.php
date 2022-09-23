<?php

namespace frontend\models\appealEngine;

use frontend\models\ApplicantAppeal;
use frontend\models\AppealCallType;
use frontend\models\AppealSource;
use frontend\models\Interview;
use yii\base\Exception;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Expression;

class InterviewList extends Model
{

    public $city_id;

    public $kafe_id;

    public $vacancy_id;

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

    /**
     * @return null
     */
    public function getResult()
    {
        return $this->result;
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
        $this->data = ApplicantAppeal::find()
            ->alias('i')
            ->select(['i.*', "CONCAT_WS(' ', applicant.surname,' ', applicant.name,' ', applicant.patronymic) AS fio", 'vacancy.name as vacancy', 'call_date', 'applicant.phone', 'call_type.name', 'source.name', 'city.name as city', 'comment'])
                //, new Expression('CASE ')])
            ->leftJoin('applicant', 'applicant.id = i.applicant_id')
            ->leftJoin('applicant', 'applicant.id = i.applicant_id')
            ->leftJoin('city', 'city.id = a.city_id')
            ->leftJoin('vacancy', 'vacancy.id = a.vacancy_id')
            //->leftJoin('vacancy', 'vacancy.id = a.vacancy_id')
            ->leftJoin(['call_type' => AppealCallType::tableName()], 'call_type.id = a.call_type')
            ->leftJoin(['source' => AppealSource::tableName()], 'source.id = a.source_id')
            ->leftJoin('employee', 'employee.id = a.employee_id')
            ->where(['a.status' => 1])->asArray()->all();
    }

}