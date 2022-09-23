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

class AppealList extends Model
{
    private $fio;

    private $phone;

    private $point_id;

    private $city_id;

    private $position_id;

    private $query = null;

    private $data;

    private $result = null;

    /**
     * @param $fio
     * @param $phone
     * @param $point_id
     * @param $city_id
     * @param $position_id
     */
    public function __construct($params = [])
    {
        $this->fio = (isset($params['searchFio']) && !empty($params['searchFio'])) ? $params['searchFio'] : null;
        $this->phone = (isset($params['searchPhone']) && !empty($params['searchPhone'])) ? $params['searchPhone'] : null;
        $this->point_id = (isset($params['searchKafe']) && !empty($params['searchKafe'])) ? $params['searchKafe'] : null;
        $this->city_id = (isset($params['searchCity']) && !empty($params['searchCity'])) ? $params['searchCity'] : null;
        $this->position_id = (isset($params['searchPosition']) && !empty($params['searchPosition'])) ? $params['searchPosition'] : null;
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
        $this->result = ApplicantAppeal::find()
            ->alias('a')
            /*->select(['a.*', "CONCAT_WS(' ', applicant.surname,' ', applicant.name,' ', applicant.patronymic) AS fio", 'vacancy.name as vacancy', 'call_date', 'applicant.phone', 'call_type.name', 'source.name', 'city.name as city', 'comment'])*/
            ->select(['a.*', "CONCAT_WS(' ', applicant.surname,' ', applicant.name,' ', applicant.patronymic) AS fio", 'vacancy.name as vacancy', 'call_date', 'applicant.phone', 'call_type.name', 'source.name', 'city.name as city', 'a.comment',
                new Expression('CASE WHEN interview.id IS NULL THEN 0 ELSE 1 END AS interview')])
            ->leftJoin('applicant', 'applicant.id = a.applicant_id')
            ->leftJoin('city', 'city.id = a.city_id')
            ->leftJoin('vacancy', 'vacancy.id = a.vacancy_id')
            ->leftJoin('interview', 'interview.appeal_id = a.id')
            ->leftJoin(['call_type' => AppealCallType::tableName()], 'call_type.id = a.call_type')
            ->leftJoin(['source' => AppealSource::tableName()], 'source.id = a.source_id')
            ->leftJoin('employee', 'employee.id = a.employee_id')
            ->where(['a.status' => 1])->asArray()->all();
    }

    private function prepareList()
    {
    }

}