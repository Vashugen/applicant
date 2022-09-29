
function onShowManagerModal(title, type){
    $("#title").html(title);
    $("#type").val(type);
    $("#id").val(null);
    $("#name").val(null);

    $("#errorMessage").empty();
}

$("#createApplicant").on("click", function (){
    $("#applicantModal").modal("show");
    $("#applicantModal").on("shown.bs.modal", function (e) {
        $("#applicantForm")[0].reset();
        $("#applicantId").val(null);
        $("#errorMessage").empty();
    });
});

$("#createEmployee").on("click", function (){
    $("#employeeModal").modal("show");
    $("#employeeForm").on("shown.bs.modal", function (e) {
        $("#employeeForm")[0].reset();
        $("#employeeId").val(null);
        $("#errorMessage").empty();
    });
});

$("#createVacancy").on("click", function (){
    $("#managerModal").modal("show");
    $("#managerModal").on("shown.bs.modal", function (e) {
        onShowManagerModal("Данные вакансии", "vacancy");
    });
});

$("#createSource").on("click", function (){
    $("#managerModal").modal("show");
    $("#managerModal").on("shown.bs.modal", function (e) {
        onShowManagerModal("Данные источника", "source");
    });
});

$("#createCallType").on("click", function (){
    $("#managerModal").modal("show");
    $("#managerModal").on("shown.bs.modal", function (e) {
        onShowManagerModal("Данные типа звонка", "callType");
    });
});

$("#createAppealStatus").on("click", function (){
    $("#managerModal").modal("show");
    $("#managerModal").on("shown.bs.modal", function (e) {
        onShowManagerModal("Данные статуса звонка", "appealStatus");
    });
});

$("#createInterviewStatus").on("click", function (){
    $("#managerModal").modal("show");
    $("#managerModal").on("shown.bs.modal", function (e) {
        onShowManagerModal("Данные статуса интервью", "interviewStatus");
    });
});

$("#applicantForm").on("submit", function (){

    var params = $(this).serialize();
    $("#errorMessage").empty();

    $.ajax({
        type: "POST",
        url: "save-applicant",
        data: params,
        dataType: "json",
        success: function (response) {
            if (response.success) {
                alert(response.message);
                $("#applicantModal").modal("hide");
                location.reload();
            } else {
                $("#errorMessage").html(response.message);
            }
        }
    });

    return false;
});

$("#employeeForm").on("submit", function (){

    var params = $(this).serialize();
    $("#errorMessage").empty();

    $.ajax({
        type: "POST",
        url: "save-employee",
        data: params,
        dataType: "json",
        success: function (response) {
            if (response.success) {
                alert(response.message);
                $("#employeeModal").modal("hide");
                location.reload();
            } else {
                $("#errorMessage").html(response.message);
            }
        }
    });

    return false;
});

$("#managerForm").on("submit", function (){

    var params = $(this).serialize();
    $("#errorMessage").empty();

    $.ajax({
        type: "POST",
        url: "save",
        data: params,
        dataType: "json",
        success: function (response) {
            if (response.success) {
                alert(response.message);
                $("#managerModal").modal("hide");
                location.reload();
            } else {
                $("#errorMessage").html(response.message);
            }
        }
    });

    return false;

});

$("#content").on("click", ".action", function (){

    var element = $(this);
    var action = element.data("action");
    var object = element.data("object");
    var type = element.data("type");

    switch (action){
        case 'edit':
            $.ajax({
                type: "POST",
                url: "get-data",
                data: {
                    'id': object,
                    'type': type
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {

                        $("#managerModal").modal("show");
                        $("#managerModal").on("shown.bs.modal", function (e) {
                            onShowManagerModal("Редактирование данных", type);
                            $("#id").val(response.data.id);
                            $("#name").val(response.data.name);
                        });
                    } else {
                        $("#errorMessage").html(response.message);
                    }
                }
            });
            break;

        case 'remove':
            if (confirm("Удалить запись?")) {
                $.ajax({
                    type: "POST",
                    url: "change-status-employee",
                    data: {
                        "user_id": userId
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.success == true) {
                            alert(response.message);
                            if (response.errors != "") {
                                $("#errorMessage").html(response.errors);
                            }
                            $(element).parents("tr").remove();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }

            break;
    };

    return false;

});

$("#contentEmployee").on("click", ".action", function (){

    var element = $(this);
    var action = element.data("action");
    var object = element.data("object");
    var type = element.data("type");

    switch (action){
        case 'edit':
            $.ajax({
                type: "POST",
                url: "get-data",
                data: {
                    'id': object,
                    'type': type
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {

                        $("#employeeModal").modal("show");
                        $("#employeeModal").on("shown.bs.modal", function (e) {
                            $("#employeeForm")[0].reset();
                            $("#employeeId").val(null);
                            $("#errorMessage").empty();

                            $("#employeeId").val(response.data.id);
                            $("#fio").val(response.data.fio);
                            $("#externalId").val(response.data.external_id);

                        });
                    } else {
                        $("#errorMessage").html(response.message);
                    }
                }
            });
            break;

        case 'remove':
            if (confirm("Удалить запись?")) {
                $.ajax({
                    type: "POST",
                    url: "change-status-employee",
                    data: {
                        "user_id": userId
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.success == true) {
                            alert(response.message);
                            if (response.errors != "") {
                                $("#errorMessage").html(response.errors);
                            }
                            $(element).parents("tr").remove();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }

            break;
    };

    return false;

});

$("#contentApplicant").on("click", ".action", function (){

    var element = $(this);
    var action = element.data("action");
    var object = element.data("object");
    var type = element.data("type");

    switch (action){
        case 'edit':
            $.ajax({
                type: "POST",
                url: "get-data",
                data: {
                    'id': object,
                    'type': type
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {

                        $("#applicantModal").modal("show");
                        $("#applicantModal").on("shown.bs.modal", function (e) {
                            $("#applicantForm")[0].reset();
                            $("#applicantId").val(null);
                            $("#errorMessage").empty();

                            $("#applicantId").val(response.data.id);
                            $("#surname").val(response.data.surname);
                            $("#name").val(response.data.name);
                            $("#patronymic").val(response.data.patronymic);
                            $("#phone").val(response.data.phone);

                        });
                    } else {
                        $("#errorMessage").html(response.message);
                    }
                }
            });
            break;

        case 'remove':
            if (confirm("Удалить запись?")) {
                $.ajax({
                    type: "POST",
                    url: "change-status-employee",
                    data: {
                        "user_id": userId
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.success == true) {
                            alert(response.message);
                            if (response.errors != "") {
                                $("#errorMessage").html(response.errors);
                            }
                            $(element).parents("tr").remove();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }

            break;
    };

    return false;

});