<?php
/* @var \frontend\models\Kafe $kafe */
?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="interviewModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Данные интервью</h4>
            </div>
            <form id="interviewForm">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="interviewId" id="interviewId">
                    <input type="hidden" class="form-control" name="appealId" id="appealId">
<!--                    <div class="row">
                        <div class="col-md-6">
                            Город
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="cityId" id="cityId">
                                    <option value="">--Выберите город--</option>
                                    <?php /*foreach ($citys as $item) { */?>
                                        <option value="<?/*= $item->id; */?>"><?/*= $item->name; */?></option>
                                    <?php /*} */?>
                                </select>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-6">
                            Торговая точка
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="kafeId" id="kafeId">
                                    <option value="">--Выберите торговую точку--</option>
                                    <?php foreach ($kafe as $item) { ?>
                                        <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Дата собеседования
                        </div>
                        <div class="col-md-6">
                            <div class='input-group date'>
                                <input type="date" placeholder="Дата звонка" id="date" name="date" autocomplete="off" class="datepicker"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Комментарий
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="comment" id="comment" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div id="errorMessage" class="text-center" style="margin-top:10px; color: red">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>