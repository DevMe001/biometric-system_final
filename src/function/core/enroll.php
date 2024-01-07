<?php
/**
 * this file uses the enrollment class to
 * enroll users
 * @authors Dahir Muhammad Dahir (dahirmuhammad3@gmail.com)
 * @date    2020-04-18 14:28:39
 */


namespace fingerprint;

require("./querydb.php");
require_once("./helpers/helpers.php");


if(!empty($_POST["data"])){
    $user_data = json_decode($_POST["data"]);

    $finger_template= $user_data->sample;
    $enrolled_id = $user_data->input;
    $type =$user_data->type;




    // var_dump($finger_template);
     // make sure fingerprint is 4 attempt
    $pre_reg_fmd_array = [
        "finger_template" => $finger_template
       
    ];


 

    // this check for duplicate is not necessary, only required if you want to
    // avoid duplicate enrollment of the same finger, also you might have to improve it
    // a bit to make it more robust, considering this is just a proof of concept and we
    // are only checking a single finger
    if ((isDuplicate($finger_template[0]) || isDuplicate($finger_template[1]) || isDuplicate($finger_template[2]) || isDuplicate($finger_template[3])) && $type != 'edit') {
        echo "existed";
    }
    else{
        
        $json_response = enroll_fingerprint($pre_reg_fmd_array);
        $response = json_decode($json_response);


    //    var_dump($response); 
   
     
        if ($response !== "enrollment failed"){
            $enrolled_fingerprint_template = $response->enrolled_fingerprint_template;


               

              $check = json_decode(getUserFmds($enrolled_id));

                 if($check != null){
                    echo "existed";
                  
                 }else{

                    if($type == 'edit'){
                        echo modifyUserFmds($enrolled_id, $enrolled_fingerprint_template);

                }else{
                    
                        echo setUserFmds($enrolled_id, $enrolled_fingerprint_template);

                }

                 }
            
          
        }
        else{
            echo "$response";
        }
    }
}
else{
    echo "post request with 'data' field required";
}

function isDuplicate($fmd_to_check_string){

    $allFmds = json_decode(getAllFmds());

    if (!$allFmds){ // there is nothing here, so nothing to do
        return false;
    }

    $enrolled_hand_array = $allFmds;




    $json_response = is_duplicate_fingerprint($fmd_to_check_string, $enrolled_hand_array);
    $response = json_decode($json_response);


  

    if($response){
        return true;
    }
    else{
        return false;
    }
}
