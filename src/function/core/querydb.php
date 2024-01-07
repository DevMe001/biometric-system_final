<?php
/*
 * Author: Dahir Muhammad Dahir
 * Date: 26-April-2020 12:41 AM
 * About: this file is responsible
 * for all Database queries
 */

namespace fingerprint;
require_once("./Database.php");

function setUserFmds($enrolled_id, $enrolled_fingerprint_template){
    $myDatabase = new Database();
    $sql_query = "insert fingerprint_enroll set enrolled_id=?,fingerscan=?";
    $param_type = "is";
    $param_array = [$enrolled_id, $enrolled_fingerprint_template];
    $affected_rows = $myDatabase->insert($sql_query, $param_type, $param_array);

    if($affected_rows > 0){
        return "success";
    }
    else{
        return "failed in querydb";
    }
}


function modifyUserFmds($attendanceId, $enrolled_fingerprint_template){
    $myDatabase = new Database();
    $sql_query = "update fingerprint_enroll set fingerscan=? WHERE attendance_id=?";
    $param_type = "si";
    $param_array = [$enrolled_fingerprint_template, $attendanceId,];
    $affected_rows = $myDatabase->update($sql_query, $param_type, $param_array);

    if($affected_rows > 0){
        return "success";
    }
    else{
        return "failed in querydb";
    }
}


function getUserFmds($enrolled_id){
    $myDatabase = new Database();
    $sql_query = "select enrolled_id,fingerscan from fingerprint_enroll where enrolled_id=?";
    $param_type = "i";
    $param_array = [$enrolled_id];
    $fmds = $myDatabase->select($sql_query, $param_type, $param_array);
    return json_encode($fmds);
}

function getUserDetails($enrolled_id){
    $myDatabase = new Database();
    $sql_query = "select attendance_id,enrolled_id from fingerprint_enroll where enrolled_id=?";
    $param_type = "i";
    $param_array = [$enrolled_id];
    $user_info = $myDatabase->select($sql_query, $param_type, $param_array);
    return json_encode($user_info);
}

function getAllFmds(){
    $myDatabase = new Database();
    $sql_query = "select fingerscan from fingerprint_enroll where fingerscan != ''";
    $allFmds = $myDatabase->select($sql_query);
    return json_encode($allFmds);
}