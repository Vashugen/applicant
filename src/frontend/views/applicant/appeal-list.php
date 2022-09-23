<?php

/* @var \yii\data\ArrayDataProvider $content */

use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $content,
    'id' => 'appeal-list',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'fio',
            'label' => 'Соискатель',
            'format' => 'raw',
        ],
        [
            'attribute' => 'phone',
            'label' => 'Телефон',
            'format' => 'raw',
        ],
        [
            'attribute' => 'vacancy',
            'label' => 'Вакансия',
            'format' => 'raw',
        ],
        [
            'attribute' => 'city',
            'label' => 'Город',
            'format' => 'raw',
        ],
        [
            'attribute' => 'employee',
            'label' => 'Сотрудник',
            'format' => 'raw',
        ],
        [
            'attribute' => 'interview',
            'label' => 'Собеседование',
            'format' => 'raw',
            'value' => function($data){
                return $data['interview'] ? '<span class="glyphicon glyphicon-ok text-success"></span></a>' : '<span class="glyphicon glyphicon-remove text-danger"></span></a>';
            }
        ],
        [
            'attribute' => 'action',
            'label' => 'Действия',
            'format' => 'raw',
            'value' => function ($data) {
                return '<a href="" class="action" data-action="edit" data-object="' . $data['id'] . '"><span class="glyphicon glyphicon-pencil" title="редактировать"></span></a> 
                                <a href="" class="action" data-action="remove" data-object="' . $data['id'] . '"><span class="glyphicon glyphicon-remove text-danger" title="удалить"></span></a>
                                <a href="" class="action" data-action="interview" data-object="' . $data['id'] . '"><span class="glyphicon glyphicon-briefcase" title="назначить собеседование"></span></a>';
            }
        ],
    ],
]);
?>
