<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $content
 * @var string $type
 */

$this->registerJsFile(
    '/js/manager.js',
    [
        'depends' => \yii\web\JqueryAsset::className(),
        'position' => yii\web\View::POS_END
    ]
);

?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <button type="button" id="createAppealStatus" class="btn btn-info">Создать статус звонка</button>
            </div>
        </div>
    </div>

    <div id="content">
        <?= $this->render('list', ['content' => $content, 'type' => $type]) ?>
    </div>

<?= $this->render('create'); ?>
<?= $this->render('/common/_info'); ?>