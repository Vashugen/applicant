<?php
?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="applicantModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Данные соискателя</h4>
            </div>
            <form id="applicantForm">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="applicantId" id="applicantId">
                    <div class="row">
                        <div class="col-md-6">
                            Фамилия
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="фамилия">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Имя
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="имя">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Отчество
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="patronymic" id="patronymic" placeholder="отчество">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Телефон
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="9011234567">
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