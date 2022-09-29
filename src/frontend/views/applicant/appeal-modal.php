<?php
/* @var \frontend\models\City $citys */
/* @var \frontend\models\Vacancy $vacancy */
/* @var \frontend\models\Employee $employee */
/* @var \frontend\models\managerEngine\CallType $call_type */
/* @var \frontend\models\AppealSource $source */

?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="appealModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Данные обращения</h4>
            </div>
            <form id="appealForm">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="appealId" id="appealId">
                    <input type="hidden" class="form-control" name="applicantId" id="applicantId">
                    <div class="row">
                        <div class="col-md-6">
                            Фамилия соискателя
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="фамилия">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Имя соискателя
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="имя">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Отчество соискателя
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="patronymic" id="patronymic" placeholder="отчество">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Телефон соискателя
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="9101234567">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Вакансия
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="vacancyId" id="vacancyId">
                                    <option value="">--Выберите вакансию--</option>
                                    <?php foreach ($vacancy as $item) { ?>
                                        <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Город
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="cityId" id="cityId">
                                    <option value="">--Выберите город--</option>
                                    <?php foreach ($citys as $item) { ?>
                                        <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Предпочитаемая торговая точка
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="kafeId" id="kafeId" disabled>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Сотрудник
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="employeeId" id="employeeId">
                                    <option value="">--Выберите сотрудника--</option>
                                    <?php foreach ($employee as $item) { ?>
                                        <option value="<?= $item->id; ?>"><?= $item->fio; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Тип звонка
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="callType" id="callType">
                                    <option value="">--Выберите тип звонка--</option>
                                    <?php foreach ($call_type as $item) { ?>
                                        <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Источник
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="source" id="source">
                                    <option value="">--Выберите источник звонка--</option>
                                    <?php foreach ($source as $item) { ?>
                                        <option value="<?= $item->id; ?>"><?= $item->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Дата звонка
                        </div>
                        <div class="col-md-6">
                            <div class='input-group date'>
                                <input type="date" placeholder="Дата звонка" id="callDate" name="callDate" autocomplete="off" class="datepicker"/>
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