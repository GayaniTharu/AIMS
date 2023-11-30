                                                                       <!--farmer_model------>


<!--database ekka ganudenu karana dewal krnne meke-->

<?php

require_once("../common/db_connection.php");  // db connection eka methanata gannwa
   
class farmer
{
    private $conn; // connection eka
    private $table = "far_reg";  //table eka
   
    
    

    public function __construct($conn) // uda nikan db eka gattata ba mekath one aniwa   //$conn db connection eken gnna eka constructor para meter ekakin danwa
    {
        $this->conn = $conn; // gatta eka mekata assign kara gnnwa
    }



    // form eke data db ekata add krna wada krnne meke
    protected function setNewfarmer($fname, $lname, $nic,$gender, $con, $acc,$add1, $add2, $add3, $uimg)
    {

        $sql = "INSERT INTO $this->table(far_fname,far_lname,far_con,far_nic,far_gender,far_acc,far_add1,far_add2,far_add3,far_img) " .
            "VALUES('$fname', '$lname', '$con','$nic','$gender',$acc, '$add1', '$add2', '$add3', '$uimg')";
       
       $result   = $this->conn->query($sql);

    
        return $result;
    }

    
  }

?>