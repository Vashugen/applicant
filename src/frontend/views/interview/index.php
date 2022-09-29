<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $content
 * @var \frontend\models\City $citys
 * @var \frontend\models\Kafe $kafe
 * @var \frontend\models\Vacancy $vacancy
 * @var \frontend\models\InterviewStatus $interview_status
 */

$this->registerCssFile('/static/bootstrap-select/bootstrap-select.min.css');
$this->registerCssFile('/static/datetimepicker/css/bootstrap-datepicker.css');


$this->registerJsFile('/static/bootstrap-select/bootstrap-select.min.js',
    [
        'depends' => \yii\web\JqueryAsset::className(),
        'position' => yii\web\View::POS_END
    ]);



$this->registerJsFile(
        '/js/interview.js',
        [
            'depends' => \yii\web\JqueryAsset::className(),
            'position' => yii\web\View::POS_END
        ]
);

?>
<form id="formFilter">
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Начало фильтра -->
            <p><a href="#spoiler-1" data-toggle="collapse" class="btn btn-primary">Фильтр</a>
            <div class="collapse" id="spoiler-1">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Выбор города:</div>
                            <div class="panel-body">
                                <select id="searchCity" name="searchCity[]" class="selectpicker" data-width="100%" multiple title="Один или несколько">
                                    <?php foreach ($citys as $item): ?>
                                        <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Выбор города:</div>
                            <div class="panel-body">
                                <select id="searchKafe" name="searchKafe[]" class="selectpicker" data-width="100%" multiple title="Одно или несколько">
                                    <?php foreach ($kafe as $item): ?>
                                        <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Выбор вакансии:</div>
                            <div class="panel-body">
                                <select id="searchVacancy" name="searchVacancy[]" class="selectpicker" data-width="100%" multiple title="Один или несколько">
                                    <?php foreach ($vacancy as $item): ?>
                                        <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">ФИО:</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ФИО" autocomplete="off" id="searchFio" name="searchFio">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Номер телефона:</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="searchPhone" name="searchPhone" placeholder="номер телефона" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" id="recount" class="btn btn-success">Вывести отчет</button>
                    <!--<button type="button" id="createAppeal" class="btn btn-info">Назначить собеседование</button>-->
                </div>
            </div>
        </div>
    </div>
</form>

<div id="content">
    <?= $this->render('interview-list', ['content' => $content])?>
</div>

<?= $this->render('interview-modal', ['kafe' => $kafe]);?>
<?= $this->render('interview-status-modal', ['interview_status' => $interview_status]);?>
<?= $this->render('/common/_info'); ?>
