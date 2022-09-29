function onShowAppealModal(){
   $("#appealForm")[0].reset();
   $("#appealId").val(null);
   $("#applicantId").val(null);
   $("#errorMessage").empty();
   $(".selectpicker").deselectAll();
   $(".selectpicker").selectpicker("refresh");
}

//Вывести отчёт
function getAppealList(url) {

   var request = $("#formFilter").serialize();

   $("#info-modal-body").html('<h4><center>Ждите загрузки отчёта!</center></h4>');
   $("#info-modal").modal("show");

   $.ajax({
      type: "POST",
      url: url,
      data: request,
      dataType: "html",
      success: function (response) {
         $("#info-modal").modal("hide");
         $("#content").html(response);
      }
   });

   return false;
}

//onClick Вывести отчёт
$("#formFilter").on("submit", function (){
   getAppealList("get-list");
   return false;
});

//пагинация

//onClick Создать соискателя
$("#createAppeal").on("click", function (){
   $("#appealModal").modal("show");
   $("#appealModal").on("show.bs.modal", function (e){
      onShowAppealModal();
   });
});


$("#appealForm").on("submit", function (){

   //var params = $(this).serialize();
   $("#errorMessage").empty();

   $.ajax({
      type: "POST",
      url: "check-applicant",
      data: {
         "phone" : $("#phone").val()
      },
      dataType: "json",
      success: function (response) {
         if (!response.success) {
            //соискатель с таким номером уже есть
            if(confirm("Соискатель с таким номером телефона уже присутствует в базе - " + response.data.fio + " . Использовать его?")){
               $("#applicantId").val(response.data.id);
            }else {
               $("#applicantId").val(null);
            }
         }

         var params = $("#appealForm").serialize();

         $.ajax({
            type: "POST",
            url: "save-appeal",
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
      }
   });

   return false;

});

$("#content").on("click", ".action", function (){

   var element = $(this);
   var action = element.data("action");
   var object = element.data("object");

   switch (action){
      case 'edit':
         $.ajax({
            type: "POST",
            url: "get-appeal-data",
            data: {
               'appealId': object,
            },
            dataType: "json",
            success: function (response) {
               if (response.success) {

                  $("#appealModal").modal("show");
                  $("#appealModal").on("shown.bs.modal", function (e) {
                     //onShowAppealModal();
                     $('.modal-body input[name="appealId"]').val(response.data.id);
                     $('.modal-body input[name="applicantId"]').val(response.data.applicant_id);
                     $('.modal-body input[name="surname"]').val(response.data.surname);
                     $('.modal-body input[name="name"]').val(response.data.name);
                     $('.modal-body input[name="patronymic"]').val(response.data.patronymic);
                     $('.modal-body input[name="phone"]').val(response.data.phone);
                     $('.modal-body input[name="vacancyId"]').val(response.data.vacancy_id);
                     $('.modal-body input[name="cityId"]').val(response.data.city_id);
                     $('.modal-body input[name="employeeId"]').val(response.data.employee_id);
                     $('.modal-body input[name="callType"]').val(response.data.call_type);
                     $('.modal-body input[name="source"]').val(response.data.source);
                     $('.modal-body input[name="callDate"]').val(response.data.call_date);
                     $('.modal-body input[name="comment"]').val(response.data.comment);
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
               url: "remove-appeal",
               data: {
                  "appealId": object
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

      case 'interview':
         $.ajax({
            type: "POST",
            url: "get-interview",
            data: {
               'appealId': object,
            },
            dataType: "json",
            success: function (response) {
               if (response.success) {
                  $("#interviewModal").modal("show");
                  $("#interviewModal").on("shown.bs.modal", function (e) {
                     $("#interviewForm #interviewId").val(null);
                     $("#interviewForm #appealId").val(object);
                     $("#interviewForm #kafeId").val(null);
                     $("#interviewForm #date").val(null);
                     $("#interviewForm #comment").val(null);
                     $("#interviewForm #errorMessage").empty();

                     if(response.data !== null){
                        $("#interviewForm #interviewId").val(response.data.id);
                        $("#interviewForm #kafeId").val(response.data.kafe_id);
                        $("#interviewForm #date").val(response.data.date);
                        $("#interviewForm #comment").val(response.data.comment);
                     }
                  });
               } else {
                  $("#errorMessage").html(response.message);
               }
            }
         });
         break;
   };

   return false;

});

$("#interviewForm").on("submit", function (){

   var params = $(this).serialize();
   $("#errorMessage").empty();

   $.ajax({
      type: "POST",
      url: "set-interview",
      data: params,
      dataType: "json",
      success: function (response) {
         if (response.success) {
            alert(response.message);
            $("#interviewModal").modal("hide");
            location.reload();
         } else {
            $("#errorMessage").html(response.message);
         }
      }
   });

   return false;

});