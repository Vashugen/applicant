<?php

namespace frontend\models\managerEngine;

use yii\data\ActiveDataProvider;

class InterviewStatus extends Manager
{
    public static function getList()
    {
        $query = \frontend\models\InterviewStatus::find()->where(['status' => 1]);

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'name'
                ]
            ]
        ]);

    }

}