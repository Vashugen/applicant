<?php

namespace frontend\models\managerEngine;

use frontend\models\AppealCallType;
use yii\data\ActiveDataProvider;

class CallType extends Manager
{
    public static function getList()
    {
        $query = AppealCallType::find()->where(['status' => 1]);

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