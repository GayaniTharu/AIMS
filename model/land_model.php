<!--database ekka ganudenu karana dewal krnne meke-->

<?php

require_once("../common/db_connection.php");  // db connection eka methanata gannwa
   
class land
{
    private $conn; // connection eka
    private $table = "lands";  //table eka
   // private $table_log="loginn" ; //login table eka 
    
    

    public function __construct($conn) // uda nikan db eka gattata ba mekath one aniwa   //$conn db connection eken gnna eka constructor para meter ekakin danwa
    {
        $this->conn = $conn; // gatta eka mekata assign kara gnnwa
    }


    // form eke data db ekata add krna wada krnne meke
    protected function setNewland($nic,$farname, $landnumber,$landsize ,$landlocation)
    {

        $sql = "INSERT INTO $this->table(far_nic,far_name,land_number,land_size,land_location) " .
            "VALUES('$nic','$farname', '$landnumber', '$landsize','$landlocation')";
       
       $result   = $this->conn->query($sql);

    
        return $result;
    }

    


    
}

