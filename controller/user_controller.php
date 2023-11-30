<!-- model eke normally get set method use krnne
    if else dnna ba model part eke ekai ewa karnne controller part eke
-->

<?php

session_start();

require_once("../model/user_model.php");  // nikn extend krata madi userController class eka dnne na user kohend awe kiyala e hinda user class eka thiyena thana link krnwa userController kiynne user class eke child kenek


$conn = $db_obj->getConnection();

class userController extends user  // user extend kare user_model eke class user kiyana eka
{
 
    public function addNewuser($id,$fname, $lname,$email,$con,$nic, $gender , $add1, $add2, $add3, $uimg,$pos){
        $result = $this->setNewuser($id,$fname, $lname,$email,$con,$nic, $gender , $add1, $add2, $add3, $uimg,$pos);
        
    if($result)
    {
        $response="User Added Successfully";
    }
    else
    {
        $response="Something went wrong. Task fail !!";
    }
        return $response;


    }

 
}

$userCont_obj = new userController($conn);  //object hadanawa uda hadapu usercontroller eke value eliyata denna methana $conn kiynne constructor eka haraha thama user_model eke  public function __construct($conn) methanata denne

///////////////////////////////////////// Switch Status /////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : ""; // $request kiyala variable ekak hadala ena requset eka anuwa wena de cases wala danwa   isset kiynne requset ekak awilla thiye nm kiyana eka

switch ($request) {
    

    case 'adduser':
        $id= trim($_POST["id"]);          
        $fname = trim($_POST["fname"]);
        $lname = trim($_POST["lname"]);
        $email = trim($_POST["email"]);  // trim eken krnne input wala white spaces in karana eka
        $con = "0" . trim($_POST["con"]);
        $nic = trim($_POST["nic"]);
        $gender = trim($_POST["gender"]);
        
        $add1 = trim($_POST["add1"]);
        $add2 = trim($_POST["add2"]);
        $add3 = trim($_POST["add3"]);
        $pos= trim($_POST["pos"]);
        
        

        $pw = sha1($pw); // pw eka admintwth blnna bari wenna(pw encryption) hadanna ekata hash method ganne hash method dekai sha1 or md5

        //img eka mehema gnne na

        ////////////////////// File Uploading ///////////////////
        if ($_FILES["uimg"]["name"] != "") {  //uming kiynne form eke dapu eka anith eka name ma thama //  uimg ekt img ekak upload krl thiyeda kiyla blanne eken
            $uimg = $_FILES["uimg"]["name"];
            $uimg = time() . "_" . $uimg;  // time eka dnwa mkd ekm file name eken user img ekakata wada thiyen hinda
        } else {
            $uimg="default_img.jpg";
            //$uimg = ($gender == "M") ? "defaultImageM.jpg" : "defaultImageF.jpg";
        }

        $tmp_location = $_FILES["uimg"]["tmp_name"]; //tmp_name : tempory location eke name eka5
        $permenent = "../image/userimg/$uimg";

        move_uploaded_file($tmp_location, $permenent);

        $response = $userCont_obj->addNewuser($id,$fname, $lname,$email,$con,$nic, $gender , $add1, $add2, $add3, $uimg,$pos); 

        header("Location:../view/registration.php?response=$response");

        
        break;

   
    



        break;
}
