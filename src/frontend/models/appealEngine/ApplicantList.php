<?php

namespace frontend\models\applicantEngine;

use frontend\models\Applicant;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ApplicantList extends Model
{
    private $fio;

    private $phone;

    private $point_id;

    private $city_id;

    private $position_id;

    private $query = null;

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
    }

    private function createList()
    {
        //TODO вынести вакансию в отдельную таблицу
        $this->query = Applicant::find()
            ->alias('a')
            ->select(['a.*', 'city.name as city', 'vacancy.name as vacancy', 'employee.fio as employee'])
            ->leftJoin('city', 'city.id = a.city_id')
            ->leftJoin('vacancy', 'vacancy.id = a.vacancy_id')
            ->leftJoin('employee', 'employee.id = a.employee_id')
            ->where(['a.status' => 1]);
    }

}