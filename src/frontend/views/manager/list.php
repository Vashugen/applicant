<?php

/* @var \yii\data\ActiveDataProvider $content */
/* @var string $type */

use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $content,
    'id' => 'manager-list',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'name',
            'label' => 'Название',
            'format' => 'raw',
        ],
        [
            'attribute' => 'action',
            'label' => 'Действия',
            'format' => 'raw',
            'value' => function ($data) use ($type) {
                return '<a href="" class="action" data-action="edit" data-object="' . $data->id . '" data-type="' .$type . '"><span class="glyphicon glyphicon-pencil"></span></a> 
                                <a href="" class="action" data-action="remove" data-object="' . $data->id . ' "data-type="' .$type . '"><span class="glyphicon glyphicon-remove text-danger"></span></a>';
            }
        ],
    ],
]);
?>
