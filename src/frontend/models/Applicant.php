<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "applicant".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $phone
 * @property int $vacancy_id
 * @property int $status
 */
class Applicant extends \yii\db\ActiveRecord
{
    public $fio;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applicant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
            [['vacancy_id', 'status'], 'integer'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'phone' => 'Phone',
            'vacancy_id' => 'Vacancy ID',
            'status' => 'Status',
        ];
    }
}
