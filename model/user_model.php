<!--database ekka ganudenu karana dewal krnne meke-->

<?php

require_once("../common/db_connection.php");  // db connection eka methanata gannwa
   
class user
{
    private $conn; // connection eka
    private $table = "user_reg";  //table eka
   // private $table_log="loginn" ; //login table eka 
    
    

    public function __construct($conn) // uda nikan db eka gattata ba mekath one aniwa   //$conn db connection eken gnna eka constructor para meter ekakin danwa
    {
        $this->conn = $conn; // gatta eka mekata assign kara gnnwa
    }


    // form eke data db ekata add krna wada krnne meke
    protected function setNewuser($id,$fname, $lname, $email,$con,$nic,$gender , $add1, $add2, $add3, $uimg,$pos)
    {

        $sql = "INSERT INTO $this->table(user_id,user_fname,user_lname,user_email,user_con,user_nic,user_gender,user_add1,user_add2,user_add3,user_img,pos) " .
            "VALUES('$id','$fname', '$lname', '$email','$con','$nic','$gender' , '$add1', '$add2', '$add3', '$uimg','$pos')";
       
       $result   = $this->conn->query($sql);

    
        return $result;
    }

    


    
}

