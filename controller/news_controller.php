<!-- model eke normally get set method use krnne
    if else dnna ba model part eke ekai ewa karnne controller part eke
-->

<?php

session_start();

require_once("../model/news_model.php");  // nikn extend krata madi userController class eka dnne na user kohend awe kiyala e hinda user class eka thiyena thana link krnwa userController kiynne user class eke child kenek


$conn = $db_obj->getConnection();

class newsController extends news  // user extend kare user_model eke class user kiyana eka
{
 
    public function addNewnews($title,$descriptions,$uimg){
        $result = $this->setNewnews($title,$descriptions,$uimg);
        
    if($result)
    {
        $response="News Added Successfully";
    }
    else
    {
        $response="Something went wrong. Task fail !!";
    }
        return $response;


    }

 
}

$newsCont_obj = new newsController($conn);  //object hadanawa uda hadapu usercontroller eke value eliyata denna methana $conn kiynne constructor eka haraha thama user_model eke  public function __construct($conn) methanata denne

///////////////////////////////////////// Switch Status /////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : ""; // $request kiyala variable ekak hadala ena requset eka anuwa wena de cases wala danwa   isset kiynne requset ekak awilla thiye nm kiyana eka

switch ($request) {
    

    case 'addnews':
        $title= trim($_POST["title"]);
        $descriptions= trim($_POST["descriptions"]);
        $uimg= trim($_POST["uimg"]);

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
        $permenent = "../image/newsimg/$uimg";

        move_uploaded_file($tmp_location, $permenent);

        $response = $newsCont_obj->addNewnews($title,$descriptions,$uimg); 

        header("Location:../view/addnews.php?response=$response");

        
        break;

   
    




}
