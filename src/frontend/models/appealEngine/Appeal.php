<?php

namespace frontend\models\appealEngine;

use common\helpers\DateHelper;
use frontend\models\Applicant;
use frontend\models\Applicant as ActiveRecordApplicant;

use frontend\models\Appeal as ActiveRecordAppeal;
use frontend\models\engine\Common;
use frontend\models\Interview;
use yii\base\Model;
use yii\db\Exception;

class Appeal extends Model
{
    public $id;

    public $surname;

    public $name;

    public $patronymic;

    public $phone;

    public $applicant_id;

    public $vacancy_id;

    public $city_id;

    public $employee_id;

    public $call_type;

    public $call_date;

    public $source;

    /**
     * @param $id
     * @param $surname
     * @param $name
     * @param $patronymic
     * @param $phone
     * @param $applicant_id
     * @param $city_id
     * @param $vacancy_id
     * @param $employee_id
     * @param $call_type
     * @param $source
     */
    public function __construct($params = [])
    {
        $this->id = (isset($params['appealId']) && !empty($params['appealId'])) ? $params['appealId'] : null;
        $this->surname = (isset($params['surname']) && !empty($params['surname'])) ? $params['surname'] : null;
        $this->name = (isset($params['name']) && !empty($params['name'])) ? $params['name'] : null;
        $this->patronymic = (isset($params['patronymic']) && !empty($params['patronymic'])) ? $params['patronymic'] : null;
        $this->phone = (isset($params['phone']) && !empty($params['phone'])) ? $params['phone'] : null;
        $this->applicant_id = (isset($params['applicantId']) && !empty($params['applicantId'])) ? $params['applicantId'] : null;
        $this->city_id = (isset($params['cityId']) && !empty($params['cityId'])) ? $params['cityId'] : null;
        $this->vacancy_id = (isset($params['vacancyId']) && !empty($params['vacancyId'])) ? $params['vacancyId'] : null;
        $this->employee_id = (isset($params['employeeId']) && !empty($params['employeeId'])) ? $params['employeeId'] : null;
        $this->call_type = (isset($params['callType']) && !empty($params['callType'])) ? $params['callType'] : null;
        $this->call_date = (isset($params['callDate']) && !empty($params['callDate'])) ? $params['callDate'] : null;
        $this->source = (isset($params['source']) && !empty($params['source'])) ? $params['source'] : null;
    }

    public function rules()
    {
        return [
            [['name', 'phone'], 'required', 'message' => "Поле имя и телефон не могут быть пустыми"],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[А-Яа-я]{2,}$/iu', 'message' => 'Поле имя, фамилия, отчество на русском языке должно состоять из букв и содержать не менее двух символов'],
            ['phone', 'match', 'pattern' => '/^9[\d]{9}$/iu', 'message' => 'Телефон должен начинаться с 9, состоять из цифр и содержать 10 символов!']
        ];
    }

    public function get()
    {
        return ActiveRecordAppeal::find()
            ->alias('appeal')
            ->select(['appeal.*', 'i.id as interview_id', 'a.surname', 'a.name', 'a.patronymic', 'a.phone'])
            ->leftJoin(['i' => Interview::tableName()], 'appeal.id = i.appeal_id')
            ->leftJoin(['a' => Applicant::tableName()], 'appeal.applicant_id = a.id')
            ->where(['appeal.id' => $this->id])
            ->asArray()
            ->one();
    }

    public function create()
    {
        try{
            $this->prepareParams();
        }catch (\yii\base\Exception $exception){
            throw $exception;
        }

        try{
            $this->createApplicant();
        }catch (Exception $exception){
            throw new \yii\base\Exception("Не удалось сохраниеть соискателя, обратитесь в IT-отдел!");
        }

        try{
            $this->saveAppealData();
        }catch (Exception $exception){
            throw $exception;
        }

        try{
            $this->saveLog();
        }catch (Exception $exception){
            throw $exception;
        }

    }

    public function remove()
    {

        try{
            $this->setRemoveStatus();
        }catch (Exception $exception){
            throw $exception;
        }

        try{
            $this->saveLog();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    private function prepareParams(){
        $this->call_date = empty($this->call_date) ? date(DateHelper::DATE_DB_FORMAT, time()) : $this->call_date;
    }

    private function createApplicant()
    {
        if(empty($this->applicant_id)) {

            print_r("here in empty"); exit;

            $model = new ActiveRecordApplicant();
            $model->name = $this->name;
            $model->surname = $this->surname;
            $model->patronymic = $this->patronymic;
            $model->phone = $this->phone;
            try{
                $model->save();
            }catch (Exception $exception){
                throw $exception;
            }
        }
    }

    private function saveAppealData(){

        $model = empty($this->id) ? new ActiveRecordAppeal() : ActiveRecordAppeal::findOne(['id' => $this->id]);

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

    private function setRemoveStatus()
    {
        $model = ActiveRecordAppeal::findOne(['id' => $this->id]);
        $model->status = ActiveRecordAppeal::STATUS_INACTIVE;

        if(!$model->validate()){
            throw new \yii\base\Exception(Common::prepareValidateError($model->getErrors()));
        }

        try{
            $model->save();
        }catch (Exception $exception){
            throw $exception;
        }
    }

    private function saveLog(){

    }

}