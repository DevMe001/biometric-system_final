<?php
/**
 * this file uses the enrollment class to
 * enroll users
 * @authors Dahir Muhammad Dahir (dahirmuhammad3@gmail.com)
 * @date    2020-04-18 14:28:39
 */

require_once("../coreComponents/basicRequirements.php");

if (!empty($_POST["data"])) {
    $user_data = json_decode($_POST["data"]);

    $fingerTemplate = $user_data->finger_template;
  

    $enrolled_fingerprint_template = enroll_fingerprint($fingerTemplate);
 

    if ($enrolled_fingerprint_template !== "enrollment failed"){
        # todo: return the enrolled fmds instead
        $output = ["enrolled_fingerprint_template"=> $enrolled_fingerprint_template];
        echo json_encode($output);
    }
    else {
        echo json_encode("enrollment failed!");
    }
} else {
    echo json_encode("error! no data provided in post request");
}

