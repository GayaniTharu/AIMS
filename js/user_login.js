


$("#pw_append").on("click", function (e) {
  if ($("#pw1").prop("type") == "pw1") 
  {
    $("#pw1").prop("type", "text");
  } 
  else 
  {
    $("#pw1").prop("type", "pw1");
  }

  $("#pw_icon").toggleClass("fa-eye fa-eye-slash");
});
   
  
  
    /*//////////////////////// Check Email /////////////////
    $("#id").on("keyup", function (e) {
      let id = $(this).val();
  
      if (id != "") {
        $.ajax({
          url: "../controller/user_controller.php?type=checkIdExistence",
          type: "POST",
          cache: false,
          data: { id: id },
          success: function (res) {
            if (res == "yes") {
              $("#email_response").html("Email already has been taken");
              $("#nemail").css("border-color", "red");
              $("#registerBtn").prop("disabled", true);
            } else {
              $("#email_response").html("");
              $("#nemail").css("border-color", "");
              $("#registerBtn").prop("disabled", false);
            }
          },
          error: function () {
            console.log("Ajax Error");
          },
        });
      }
    });*/

  