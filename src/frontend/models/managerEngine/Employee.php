<?php

namespace frontend\models\managerEngine;

use frontend\models\Employee as ActiveRecordEmployee;

use yii\data\ActiveDataProvider;
use yii\db\Exception;

class Employee extends Manager
{
    public $id;

    public $fio;

    public $external_id;

    /**
     * @param $id
     * @param $fio
     * @param $external_id
     */
    public function __construct($params = [])
    {
        $this->id = (isset($params['employeeId']) && !empty($params['employeeId'])) ? $params['employeeId'] : null;
        $this->fio = (isset($params['fio']) && !empty($params['fio'])) ? $params['fio'] : null;
        $this->external_id = (isset($params['externalId']) && !empty($params['externalId'])) ? $params['externalId'] : null;
    }

    public static function getList()
    {
        $query = ActiveRecordEmployee::find()->where(['status' => 1]);

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
            $this->saveEmployeeData();
        }catch (Exception $exception){

        }

        try{
            $this->createLog();
        }catch (Exception $exception){

        }
    }

    private function saveEmployeeData()
    {
        $model = empty($this->id) ? new ActiveRecordEmployee() : ActiveRecordEmployee::findOne(['id' => $this->id]);
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