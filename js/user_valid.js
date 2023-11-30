/* user ge athin wena waradi hadnne meke*/

/*mulinm krnne submit eke tika balanwa 
    nic eke pattern eka harida blnwa-nic duplicate wenna dennath ba ekath balanwa eka krnne submit krnna kalin 
    contact number 9 numbers thiyeda blanwa
    pw ekai confirm pw ekai match wenwada blnwa
    gender eken ekak hari select krlada blnwa */

$(document).ready(function () {
    $("#signupform").on("submit", function (e) {    /*#signupform kiynne registration eke thina form eke nama, meken krnne form eka submit krddi mulinma krnna ona dewal tika*/ 
      let con = $("#con").val();    /* contact,nic ewa registrion eke id dnwa*/ 
      let nic = $("#nic").val();
      let pw = $("#pw").val();
      let cpw = $("#cpw").val();
  

      /////////////// regex patters////////////////////
      const con_patt = /^[0-9]{9}$/;  //////^$ me deken kiynne start to end kiyana eka/[0-9]{9}zero to nine wenkn number 9k thiyenna ona
      const nic_patt_old = /^([0-9]{9})([vV])$/; ////([0-9]{9}) zero to nine and numbers 9k thiyenna ona([vV]) vV thiyenna ona
      const nic_patt_new = /^[0-9]{12}$/; /// new nic ekata numbers 12k thiyenna ona
  

      /// submit krddi check krnna ona tika/////////////////////////
      if (con.match(con_patt) == null) 
      {
        Swal.fire("Invalid Contact Number", "", "error");
        $("#con").focus();
        return false;

      } 
      else if (nic.match(nic_patt_old) == null && nic.match(nic_patt_new) == null ) 
      {
        Swal.fire("Invalid N.I.C Number", "", "error");
        $("#nic").focus(); //invalid nm e box eka highlight wenna
        return false; //submit krnna bari krnne methanin nic eka waradinm

      } 
      else if ($("input[name=gender]:checked").length < 1)  //length eka <1 kiynne kakwth select krla nattm
      {
        Swal.fire("Please Select Gender", "", "warning");
        return false; // methana focus one na
      } 
      else if (pw.length < 6)  //pw eke length eka check krnna
      {
        Swal.fire("Password must have at least 6 characters", "", "warning");
        return false;
      } 
      else if (pw != cpw) 
      {
        Swal.fire("Password Confirmation Doesn't Match", "", "error");
        return false;
      }
    });

    //submit chek end //////////////////////////
  
    ////////////////////////////// Check User Existence ////////////////////

    /// nic eka kalin db eke save welada balala ema thiye nm e nic eka valid nowenna hadnna/////////////
    $("#nic").on("keyup", function () {  ////nic balanwa
      let nic = $(this).val(); /// nic user input eka gnnwa
  
      if (nic != "") // nic emptyda balala empty nattm meka wenwa
      {   
        $.ajax({ // form ekakata ajax dnne na realtime data check krnna ajax gnne
           
          url: "../controller/user_controller.php?type=checkUserExistence",
          type: "POST", // method eka data ekak pass krddi dnne post reg eke thiye nic eke
          cache: false, // cache file gnna epa iyala kiynne eken
          data: { nic: nic }, //yawana data eka {} object lakuna athule dnne     mulinm thiyena nic eka server side eke access karana eka dewani eka nic != ""/// thwa data ekak dnna onnm , dala fname :fname ewage dnna
          success: function (res) {  // request eka hariyata server ekata gihin response eka arn dena eka thma res kiynne eka manually krnna one na ajax waladi
            if (res == 1) {  //res kiynne echo krla ena eka controller eken
              $("#user_response").html("This user NIC already has been registered");
              $("#submit").prop("disabled", true); // user kenek innwanm submit krnna bari wenna button eka disable krnwa
              $("#nic").css("border-color", "red");
            } else {
              $("#user_response").html("");
              $("#submit").prop("disabled", false); // user kenek nattan button eka visible wenwa 
              $("#nic").css("border-color", "");
            }
           
          },
          error: function () {  //response eka hariyata wela nattam error function ekakata da gnnawa
            console.log("Ajax Error");
          },
        }); 
      }
    });
  
    ////////////////////////////// Password visibility Toggle /////////////////////////
    
    //pw ekata
    $("#pw_append").on("click", function () {
      if ($("#pw").prop("type") == "password") //type eka(registration eke thiye) 
      {
        $("#pw").prop("type", "text"); // type eka text ekata maru wenna ona
      }
       else 
      {
        $("#pw").prop("type", "password"); // type eka password ekata maru wenna ona
      }
  
      $("#pw_icon").toggleClass("fa-eye fa-eye-slash"); // password eke icon eka change krnna eye eka penne fa-eye eka eye eka kapanne fa-eye-slash dnne
    });
  
    //confirm pw ekata
    $("#cpw_append").on("click", function (e) {
      if ($("#cpw").prop("type") == "password")
      {
        $("#cpw").prop("type", "text");
      } else 
      {
        $("#cpw").prop("type", "password");
      }
  
      $("#cpw_icon").toggleClass("fa-eye fa-eye-slash");
    });
  
    ///////////////////////////////// Password Strength Meter ////////////////////////////
    $("#pw").on("keyup", function (e) {
      let pw = $(this).val(); // password value eka gnnwa
  
      let corr_pw = pw.replace(/\s/g, ""); //aluth variable ekak, enter karana pw eka \s kiynne spaces g kiynne globle ""dnne thiyena replace krnwa empty string walata
      $(this).val(corr_pw); // eka kra pw ekata apply krnwa blnna space type krnna denne na
  
      const pw_weak_1 = /^[a-zA-Z]{6,}$/; // week pw walata alphebatical numbers siple capital dekama 6 kiynne aduma charaters 6k wenna ona
      const pw_weak_2 = /^[0-9]{6,}$/; // meketh e wage ilakkam witharak
      const pw_medium = /(?=.*[a-zA-Z])(?=.*[0-9])(?=.{6,})(^((?![\W\_]).)*$)/; // ilakkam letter dekama tibboth medium thw (^((?![\W\_]).)*$)-not contain part eka special characters and underscore
      const pw_strong = /(?=.*[\W\_])(?=.{6,})/; // pw strong  \w kiynne special characters
  
      if (corr_pw.match(pw_weak_1) != null || corr_pw.match(pw_weak_2) != null)
      {
        $("#progressBar").css({ width: "33.33333%", backgroundColor: "red" }); //progressBar a- ara bar eka
        $("#progressBar").html("Weak");
      } 
      else if (corr_pw.match(pw_medium) != null) 
      {
        $("#progressBar").css({ width: "66.6666%", backgroundColor: "orange" });
        $("#progressBar").html("Medium");
      } 
      else if (corr_pw.match(pw_strong) != null) 
      {
        $("#progressBar").css({ width: "100%", backgroundColor: "green" });
        $("#progressBar").html("Strong");
      } 
      else 
      {
        $("#progressBar").css("width", "0%");
      }
    });
  });
  

  function readURL(input) {
    if (input.files && input.files[0]) {
      let reader = new FileReader();
      reader.onload = function (e) {
        $("#prev_img").attr("src", e.target.result).width(80).height(70);
      };
      reader.readAsDataURL(input.files[0]);
    } else {
      $("#prev_img").attr("src", "");
    }
  }
  