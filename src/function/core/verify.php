<?php
/*
 * Author: Dahir Muhammad Dahir
 * Date: 26-April-2020 5:44 PM
 * About: identification and verification
 * will be carried out in this file
 */

namespace fingerprint;

require_once("./helpers/helpers.php");
require_once("./querydb.php");

if(!empty($_POST["data"])) {
    $user_data = json_decode($_POST["data"]);

    $enrolled_id = $user_data->input;
  
    //this is not necessarily index_finger it could be
    //any finger we wish to identify
    $pre_reg_fmd_string = $user_data->sample[0];



    $hand_data = json_decode(getUserFmds($enrolled_id));

   
    $enrolled_fingers = [
        "fingerscan" => $hand_data[0]->fingerscan, 
    ];

    $json_response = verify_fingerprint($pre_reg_fmd_string, $enrolled_fingers);
    $response = json_decode($json_response);



    if($response === "match"){
        // echo getUserDetails($enrolled_id);
        echo json_encode([
            "status" => "success",
            "data" => getUserDetails($enrolled_id)
        ]);
    }
    else{
        echo json_encode([
            "status" => "failed",
            "data" => []
        ]);
    }
}

else{
    echo "post request with 'data' field required";
}
