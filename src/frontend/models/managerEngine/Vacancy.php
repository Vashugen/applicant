<?php

namespace frontend\models\managerEngine;

use yii\data\ActiveDataProvider;

class Vacancy extends Manager
{
    public static function getList()
    {
        $query = \frontend\models\Vacancy::find()->where(['status' => 1]);

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