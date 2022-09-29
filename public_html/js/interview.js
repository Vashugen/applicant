//Вывести отчёт
function getInterviewList(url) {

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
   getInterviewList("get-list");
   return false;
});

$("#interviewForm").on("submit", function (){

   //var params = $(this).serialize();
   $("#errorMessage").empty();

   $.ajax({
      type: "POST",
      url: "save-interview",
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

   switch (action){
      case 'edit':
         $.ajax({
            type: "POST",
            url: "get-interview",
            data: {
               'id': object,
            },
            dataType: "json",
            success: function (response) {
               if (response.success) {

                  $("#interviewModal").modal("show");
                  $("#interviewModal").on("shown.bs.modal", function (e) {

                     $("#interviewForm")[0].reset();
                     $("#interviewForm #kafeId").val(null);
                     $("#interviewForm #date").val(null);
                     $("#interviewForm #comment").val(null);
                     $("#interviewForm #errorMessage").empty();
                     $(".selectpicker").selectpicker("refresh");

                     $("#interviewForm #interviewId").val(response.data.id);
                     $("#interviewForm #kafeId").val(response.data.kafe_id);
                     $("#interviewForm #date").val(response.data.date);
                     $("#interviewForm #comment").val(response.data.comment);

                  });
               } else {
                  $("#errorMessage").html(response.message);
               }
            }
         });
         break;

      case 'remove':
         if (confirm("Установить неявку?")) {
            $("#interviewStatusModal").modal("show");
            $("#interviewStatusModal").on("shown.bs.modal", function (e) {
               $("#interviewStatusForm")[0].reset();
               $("#interviewStatusForm #interviewId").val(object);
               $("#interviewStatusForm #comment").val(null);
            });
         }
         break;

      case 'internship':
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

$("#interviewStatusForm").on("submit", function (){

   var params = $(this).serialize();
   $("#interviewStatusForm #errorMessage").empty();

   $.ajax({
      type: "POST",
      url: "set-interview-status",
      data: params,
      dataType: "json",
      success: function (response) {
         if (response.success) {
            alert(response.message);
            $("#interviewStatusModal").modal("hide");
            location.reload();
         } else {
            $("#interviewStatusForm #errorMessage").html(response.message);
         }
      }
   });

   return false;

});

$("#interviewForm").on("submit", function (){

   var params = $(this).serialize();
   $("#interviewForm #errorMessage").empty();

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