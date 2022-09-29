<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "applicant_appeal".
 *
 * @property int $id
 * @property int $applicant_id
 * @property int $vacancy_id
 * @property int|null $source_id
 * @property string $call_date
 * @property int|null $call_type
 * @property int|null $employee_id
 * @property int $city_id
 * @property string $comment
 * @property int $status
 */
class Appeal extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['applicant_id', 'call_date'], 'required'],
            [['applicant_id', 'vacancy_id', 'source_id', 'call_type', 'employee_id', 'city_id', 'status'], 'integer'],
            [['call_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'applicant_id' => 'Applicant ID',
            'vacancy_id' => 'Vacancy ID',
            'source_id' => 'Source ID',
            'call_date' => 'Call Date',
            'call_type' => 'Call Type',
            'employee_id' => 'Employee ID',
            'city_id' => 'City ID',
            'comment' => 'Comment',
            'status' => 'Status'
        ];
    }
}
