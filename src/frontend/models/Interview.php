<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "interview".
 *
 * @property int $id
 * @property int $appeal_id
 * @property int $kafe_id
 * @property string $date
 * @property string $comment
 */
class Interview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appeal_id', 'kafe_id', 'date'], 'required'],
            [['appeal_id', 'kafe_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'appeal_id' => 'Appeal ID',
            'kafe_id' => 'Kafe ID',
            'date' => 'Date',
            'comment' => 'Comment'
        ];
    }
}
