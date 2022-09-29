<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "appeal_request".
 *
 * @property int $id
 * @property int $applicant_id
 * @property int|null $city_id
 * @property int|null $kafe_id
 */
class AppealRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appeal_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['applicant_id'], 'required'],
            [['applicant_id', 'city_id', 'kafe_id'], 'integer'],
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
            'city_id' => 'City ID',
            'kafe_id' => 'Kafe ID',
        ];
    }
}
