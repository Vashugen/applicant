<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $searchModel \frontend\models\search\UserSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'email:email',
/*            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'status',
                'enum' => User::getStatuses(),
                'filter' => User::getStatuses()
            ],*/
/*            'created_at:datetime',
            'logged_at:datetime',*/
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
