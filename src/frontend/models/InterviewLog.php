<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "interview_log".
 *
 * @property int $id
 * @property int $interview_id
 * @property int $appeal_id
 * @property int $kafe_id
 * @property string $date
 * @property string|null $comment
 * @property int|null $edit_by
 * @property string|null $edit_at
 */
class InterviewLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interview_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['interview_id', 'appeal_id', 'kafe_id', 'date'], 'required'],
            [['interview_id', 'appeal_id', 'kafe_id', 'edit_by'], 'integer'],
            [['date', 'edit_at'], 'safe'],
            [['comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'interview_id' => 'Interview ID',
            'appeal_id' => 'Appeal ID',
            'kafe_id' => 'Kafe ID',
            'date' => 'Date',
            'comment' => 'Comment',
            'edit_by' => 'Edit By',
            'edit_at' => 'Edit At',
        ];
    }
}
