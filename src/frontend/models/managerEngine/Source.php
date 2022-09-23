<?php

namespace frontend\models\managerEngine;

use frontend\models\AppealSource;
use yii\data\ActiveDataProvider;

class Source extends Manager
{
    public static function getList()
    {
        $query = AppealSource::find()->where(['status' => 1]);

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