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
            'attribute' => 'appeal_comment',
            'label' => 'комментарий звонка',
            'format' => 'raw',
        ],
        [
            'attribute' => 'interview_comment',
            'label' => 'комментарий интервью',
            'format' => 'raw',
        ],
/*        [
            'attribute' => 'result',
            'label' => 'статус',
            'format' => 'raw',
            'value' => function($data){
                return $data['interview'] ? '<span class="glyphicon glyphicon-ok text-success"></span></a>' : '<span class="glyphicon glyphicon-remove text-danger"></span></a>';
            }
        ],*/
        [
            'attribute' => 'action',
            'label' => 'Действия',
            'format' => 'raw',
            'value' => function ($data) {
                return '<a href="" class="action" data-action="edit" data-object="' . $data['id'] . '"><span class="glyphicon glyphicon-pencil" title="редактировать"></span></a> 
                                <a href="" class="action" data-action="remove" data-object="' . $data['id'] . '"><span class="glyphicon glyphicon-remove text-danger" title="удалить"></span></a>
                                <a href="" class="action" data-action="internship" data-object="' . $data['id'] . '"><span class="glyphicon glyphicon-user" title="назначить стажировку"></span></a>';
            }
        ],
    ],
]);
?>
