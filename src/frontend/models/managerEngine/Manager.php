<?php

namespace frontend\models\managerEngine;

use common\enum\MessageEnum;
use frontend\models\AppealCallType;
use frontend\models\AppealSource;
use frontend\models\Vacancy as ActiveRecordVacancy;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Exception;

class Manager extends Model
{
    const VACANCY = "vacancy";

    const SOURCE = "source";

    const CALL_TYPE = "callType";

    const EMPLOYEE = "employee";

    const APPLICANT = "applicant";

    const APPEAL_STATUS = "appealStatus";

    const INTERVIEW_STATUS = "interviewStatus";

    public $id;

    public $type;

    public $name;

    /**
     * @param $name
     */
    public function __construct($params = [])
    {
        $this->id = (isset($params['id']) && !empty($params['id'])) ? $params['id'] : null;
        $this->type = (isset($params['type']) && !empty($params['type'])) ? $params['type'] : null;
        $this->name = (isset($params['name']) && !empty($params['name'])) ? $params['name'] : null;
    }

    public function rules()
    {
        return [
            [['name'], 'required', 'message' => "Поле наименование не может быть пустым"],
        ];
    }

    public static function getList(){}

    public function get()
    {
        switch ($this->type) {
            case self::VACANCY:
                return ActiveRecordVacancy::findOne(['id' => $this->id]);
            case self::SOURCE:
                return AppealSource::findOne(['id' => $this->id]);
            case self::CALL_TYPE:
                return AppealCallType::findOne(['id' => $this->id]);
            case self::EMPLOYEE:
                return \frontend\models\Employee::findOne(['id' => $this->id]);
            case self::APPLICANT:
                return \frontend\models\Applicant::findOne(['id' => $this->id]);
            case self::APPEAL_STATUS:
                return \frontend\models\AppealStatus::findOne(['id' => $this->id]);
            case self::INTERVIEW_STATUS:
                return \frontend\models\InterviewStatus::findOne(['id' => $this->id]);
            default:
                return null;
        }
    }

    public function create()
    {
        try{
            $this->checkDuplicate();
        }catch (\yii\base\Exception $exception){
            throw $exception;
        }

        try{
            $this->saveManagerData();
        }catch (Exception $exception){
            throw $exception;
        }

        try{
            $this->saveLog();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    public function getActiveDataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->query,
            'sort' => [
                'attributes' => [
                    'name'
                ]
            ]
        ]);
    }

    private function checkDuplicate()
    {
        switch ($this->type){
            case self::VACANCY:
                $query = ActiveRecordVacancy::find();
                break;
            case self::SOURCE:
                $query = AppealSource::find();
                break;
            case self::CALL_TYPE:
                $query = AppealCallType::find();
            case self::APPEAL_STATUS:
                $query = \frontend\models\AppealStatus::find();
            case self::INTERVIEW_STATUS:
                $query = \frontend\models\InterviewStatus::find();
                break;
        }

        $data = $query->where(['name' => $this->name])
            ->andFilterWhere(['!=', 'id', $this->id])->all();

        if(!empty($data)){
            throw new \yii\base\Exception("Объект с таким наименованием уже существует!");
        }
    }

    private function saveManagerData()
    {
        try{
            $model = $this->getModel();
        }catch (Exception $exception){
            throw $exception;
        }

        $model->name = $this->name;
        try{
            $model->save();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    private function getModel()
    {
        switch ($this->type){
            case self::VACANCY:
                return empty($this->id) ? new ActiveRecordVacancy() : ActiveRecordVacancy::findOne(['id' => $this->id]);
            case self::SOURCE:
                return empty($this->id) ? new AppealSource() : AppealSource::findOne(['id' => $this->id]);
            case self::CALL_TYPE:
                return empty($this->id) ? new AppealCallType() : AppealCallType::findOne(['id' => $this->id]);
            case self::APPEAL_STATUS:
                return empty($this->id) ? new \frontend\models\AppealStatus() : \frontend\models\AppealStatus::findOne(['id' => $this->id]);
            case self::INTERVIEW_STATUS:
                return empty($this->id) ? new \frontend\models\InterviewStatus() : \frontend\models\InterviewStatus::findOne(['id' => $this->id]);
            default:
                throw new Exception("Не удалось сохранить объект, " . MessageEnum::IT);
        }

    }

    private function saveLog(){

    }
}