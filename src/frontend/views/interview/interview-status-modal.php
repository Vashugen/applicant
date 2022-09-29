<?php
/* @var \frontend\models\InterviewStatus $interview_status */
?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="interviewStatusModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Данные интервью</h4>
            </div>
            <form id="interviewStatusForm">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="interviewId" id="interviewId">
                    <div class="row">
                        <div class="col-md-6">
                            Причина
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="status" id="status">
                                    <option value="">--Выберите причину--</option>
                                    <?php foreach ($interview_status as $item) { ?>
                                        <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                    <?php }?>
                                </select>
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
                    <button type="submit" class="btn btn-primary">Выбрать</button>
                </div>
            </form>
        </div>
    </div>
</div>