<?php

namespace frontend\models\managerEngine;

use frontend\models\Applicant as ActiveRecordApplicant;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\swiftmailer\Message;

class Applicant extends Manager
{
    public $id;

    public $name;

    public $surname;

    public $patronymic;

    public $phone;

    /**
     * @param $id
     * @param $name
     * @param $surname
     * @param $patronymic
     * @param $phone
     */
    public function __construct($params = [])
    {
        $this->id = (isset($params['applicantId']) && !empty($params['applicantId'])) ? $params['applicantId'] : null;
        $this->name = (isset($params['name']) && !empty($params['name'])) ? $params['name'] : null;
        $this->surname = (isset($params['surname']) && !empty($params['surname'])) ? $params['surname'] : null;
        $this->patronymic = (isset($params['patronymic']) && !empty($params['patronymic'])) ? $params['patronymic'] : null;
        $this->phone = (isset($params['phone']) && !empty($params['phone'])) ? $params['phone'] : null;
    }

    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[А-Яа-я]{2,}$/iu', 'message' => 'Поле имя, фамилия, отчество на русском языке должно состоять из букв и содержать не менее двух символов'],
            ['phone', 'match', 'pattern' => '/^9[\d]{9}$/iu', 'message' => 'Телефон должен начинаться с 9, состоять из цифр и содержать 10 символов!']
        ];
    }

    public static function getList()
    {
        $query = ActiveRecordApplicant::find()
            ->select(["CONCAT_WS(' ', surname,' ', name,' ', patronymic) AS fio", 'phone']);

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'fio'
                ]
            ]
        ]);
    }

    public function create()
    {
        try{
            $this->saveApplicantData();
        }catch (Exception $exception){

        }

        try{
            $this->createLog();
        }catch (Exception $exception){

        }
    }

    private function saveApplicantData()
    {
        $model = empty($this->id) ? new ActiveRecordApplicant() : ActiveRecordApplicant::findOne(['id' => $this->id]);

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

    private function createLog()
    {

    }

}