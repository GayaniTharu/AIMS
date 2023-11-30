

  /* user ge athin wena waradi hadnne meke*/

/*mulinm krnne submit eke tika balanwa 
    nic eke pattern eka harida blnwa-nic duplicate wenna dennath ba ekath balanwa eka krnne submit krnna kalin 
    contact number 9 numbers thiyeda blanwa
    pw ekai confirm pw ekai match wenwada blnwa
    gender eken ekak hari select krlada blnwa */

$(document).ready(function () {
    $("#far_reg").on("submit", function (e) {    /*#signupform kiynne registration eke thina form eke nama, meken krnne form eka submit krddi mulinma krnna ona dewal tika*/ 
      let con = $("#con").val();    /* contact,nic ewa registrion eke id dnwa*/ 
      let nic = $("#nic").val();
      
  
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
      else if ( nic.match(nic_patt_old) == null && nic.match(nic_patt_new) == null ) 
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
  
    });

    //submit chek end //////////////////////////
  
    ////////////////////////////// Check User Existence ////////////////////

    /// nic eka kalin db eke save welada balala ema thiye nm e nic eka valid nowenna hadnna/////////////
    $("#nic").on("keyup", function () {  ////nic balanwa
      let nic = $(this).val(); /// nic user input eka gnnwa
  
      if (nic != "") // nic emptyda balala empty nattm meka wenwa
      {   
        $.ajax({ // form ekakata ajax dnne na realtime data check krnna ajax gnne
           
          url: "../controller/farmer_controller.php?type=checkfarExistence",
          type: "POST", // method eka data ekak pass krddi dnne post reg eke thiye nic eke
          cache: false, // cache file gnna epa iyala kiynne eken
          data: { nic: nic }, //yawana data eka {} object lakuna athule dnne     mulinm thiyena nic eka server side eke access karana eka dewani eka nic != ""/// thwa data ekak dnna onnm , dala fname :fname ewage dnna
          success: function (res) {  // request eka hariyata server ekata gihin response eka arn dena eka thma res kiynne eka manually krnna one na ajax waladi
            if (res == 1) {  //res kiynne echo krla ena eka controller eken
              $("#far_response").html("This user NIC already has been registered");
              $("#submit").prop("disabled", true); // user kenek innwanm submit krnna bari wenna button eka disable krnwa
              $("#nic").css("border-color", "red");
            } else {
              $("#far_response").html("");
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
  
