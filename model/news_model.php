<!--database ekka ganudenu karana dewal krnne meke-->

<?php

require_once("../common/db_connection.php");  // db connection eka methanata gannwa
   
class news
{
    private $conn; // connection eka
    private $table = "add_news";  //table eka
   // private $table_log="loginn" ; //login table eka 
    
    

    public function __construct($conn) // uda nikan db eka gattata ba mekath one aniwa   //$conn db connection eken gnna eka constructor para meter ekakin danwa
    {
        $this->conn = $conn; // gatta eka mekata assign kara gnnwa
    }


    // form eke data db ekata add krna wada krnne meke
    protected function setNewnews($title,$descriptions,$uimg)
    {

        $sql = "INSERT INTO $this->table(title,descriptions,uimg) " .
            "VALUES('$title', '$descriptions', '$uimg')";
       
       $result   = $this->conn->query($sql);

    
        return $result;
    }

    


    
}

