<!-- model eke normally get set method use krnne
    if else dnna ba model part eke ekai ewa karnne controller part eke
-->

<?php

session_start();

require_once("../model/land_model.php");  // nikn extend krata madi userController class eka dnne na user kohend awe kiyala e hinda user class eka thiyena thana link krnwa userController kiynne user class eke child kenek


$conn = $db_obj->getConnection();

class landController extends land  // user extend kare user_model eke class user kiyana eka
{
 
    public function addNewland($nic,$farname, $landnumber,$landsize ,$landlocation){
        $result = $this->setNewland($nic,$farname, $landnumber,$landsize ,$landlocation);
        
    if($result)
    {
        $response="land Added Successfully";
    }
    else
    {
        $response="Something went wrong. Task fail !!";
    }
        return $response;


    }

 
}

$userCont_obj = new landController($conn);  //object hadanawa uda hadapu usercontroller eke value eliyata denna methana $conn kiynne constructor eka haraha thama user_model eke  public function __construct($conn) methanata denne

///////////////////////////////////////// Switch Status /////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : ""; // $request kiyala variable ekak hadala ena requset eka anuwa wena de cases wala danwa   isset kiynne requset ekak awilla thiye nm kiyana eka

switch ($request) {
    

    case 'addland':
        $nic=trim($_POST["nic"]);   
        $farname=trim($_POST["farname"]);   
        $landnumber=trim($_POST["landnumber"]);   
        $landsize=trim($_POST["landsize"]);   
        $landlocation=trim($_POST["landlocation"]);   
        

        $response = $userCont_obj->addNewland($nic,$farname, $landnumber,$landsize ,$landlocation); 

        header("Location:../view/lands.php?response=$response");

        
        break;

   
    



}
