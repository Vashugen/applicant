<?php

namespace frontend\models\applicantEngine;

use yii\db\Exception;

class Applicant extends \yii\base\Model
{

    public $id;

    public $surname;

    public $name;

    public $patronymic;

    public $phone;

    public $city_id;

    public $vacancy_id;

    public $employee_id;

    /**
     * @param $id
     * @param $surname
     * @param $name
     * @param $patronymic
     * @param $phone
     * @param $city_id
     * @param $vacancy_id
     * @param $employee_id
     */
    public function __construct($params = [])
    {
        $this->id = (isset($params['applicantId']) && !empty($params['applicantId'])) ? $params['applicantId'] : null;
        $this->surname = (isset($params['surname']) && !empty($params['surname'])) ? $params['surname'] : null;
        $this->name = (isset($params['name']) && !empty($params['name'])) ? $params['name'] : null;
        $this->patronymic = (isset($params['patronymic']) && !empty($params['patronymic'])) ? $params['patronymic'] : null;
        $this->phone = (isset($params['phone']) && !empty($params['phone'])) ? $params['phone'] : null;
        $this->city_id = (isset($params['cityId']) && !empty($params['cityId'])) ? $params['cityId'] : null;
        $this->vacancy_id = (isset($params['vacancyId']) && !empty($params['vacancyId'])) ? $params['vacancyId'] : null;
        $this->employee_id = (isset($params['employeeId']) && !empty($params['employeeId'])) ? $params['employeeId'] : null;
    }


    public function create()
    {

        try{
            $this->createApplicant();
        }catch (Exception $exception){
            throw $exception;
        }

        //TODO ЛОГИ, когда будет система пользователей (update: то есть никогда блеать!!!)

    }

    private function createApplicant(){

        $model = empty($this->id) ? new \frontend\models\Applicant() : \frontend\models\Applicant::findOne(['id' => $this->id]);

        foreach ($this->getAttributes() as $key => $item){
            if(array_key_exists($key, $model->getAttributes())){
                $model->$key = $item;
            }
        }

        try{
            $model->save();
        }catch (Exception $exception){
            throw $exception;
        }
    }

}