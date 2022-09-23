<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "kafe".
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property int|null $external_id
 * @property int $status
 */
class Kafe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kafe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['city_id', 'external_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 150],
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
            'city_id' => 'City ID',
            'external_id' => 'External ID',
            'status' => 'Status',
        ];
    }
}
