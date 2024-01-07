<?php

namespace Biometric\Controller;

require_once(__DIR__ . '/../configuration/database.php');
require_once(__DIR__ . '/helper.php');



use Biometric\Database\DatabaseManager;



class ControllerManager extends DatabaseManager 
{
  private $db;

  public function __construct()
  {
    $this->db = new DatabaseManager();
  }


  // !!!!!!!!!!!!! AUTHEENTICATION !!!!!!!!!!!!!

  public function login($username, $password)
  {

    // sanitize input
    $userName = $this->db->sanitizeInput($username);
    $passWord = $this->db->sanitizeInput($password);
    $where = ['username' => $userName]; //params and where
    $params =[':username' => $userName]; //params and where

    $result = $this->db->getSpecifiQuery('users', ['id','username,password,role'],$where,$params);

   
    // query
    // $query = 'SELECT * FROM users WHERE username= :username';
    // $where = array(':username' => $userName);
    // // execute query
    // $result = $this->db->fetchQuery($query,$where);

    $response=array();

    if($result){
      if(password_verify($passWord,$result['password'])){

      
        // set session
        session_start();


        if ($result['role'] == 2) {
          $getProfile = $this->db->getSpecifiQuery('teacher_credentials', [], $where, $params);

          $_SESSION['users'] = array(
            'id' => $result['id'],
            'username' => $result['username'],
            'role' => $result['role'],
            'profile' => $getProfile['profile']
          );

        }
      else{
          $_SESSION['users'] = array(
            'id' => $result['id'],
            'username' => $result['username'],
            'role' => $result['role']
          );
      }

       

       $response = array('success' => true, 'message' => 'Login successfull');

      }
      else{
      $response = array('success' => false, 'message' => 'Invalid credentials');

      }
    }
    else{ 
      $response = array('success' => false,'message'=> 'Invalid credentials');
    }

    echo json_encode($response);

  }

  // !!!!!!!!!!!!! END AUTHEENTICATION !!!!!!!!!!!!!


// resable crud operation

  public function get($table,$columns,$selectWhere,$params,$multiple = 0){
    $result = $this->db->getSpecifiQuery($table, $columns, $selectWhere, $params, $multiple);

    if ($result) {
      return $result;
    } else {
      return null;
    }

  }

  public function select($table, $columns, $selectWhere, $params, $multiple = 0)
  {
    $result = $this->db->getSpecifiQuery($table, $columns, $selectWhere, $params, $multiple);

    if ($result) {
      echo json_encode($result);
    } else {
      echo json_encode(array('success' => false));
    }

  }


  public function createWithVerify($table, $columns, $field, $where, $params, $successMsg, $errorMsg){
    $insertQuery = $this->db->insertQuery($table, $columns, $field, $where, $params);

    if ($insertQuery) {
      return $insertQuery;

    } else {
      return false;
    }

    
  }


  public function createValid($tableName, $insertColumnField, $insertWhere = []){
      $insertQuery = $this->db->insertQueryValid($tableName, $insertColumnField, $insertWhere);

    if ($insertQuery) {
      return $insertQuery;

    } else {
      return false;
    }
  }

  public function create($table,$columns,$field,$where,$params,$successMsg,$errorMsg){
    $insert = $this->db->insertQuery($table, $columns, $field, $where, $params);

    if ($insert) {
      $response = array('success' => true, 'message' => $successMsg);

    } else {
      $response = array('success' => false, 'message' => $errorMsg);
    }

    echo json_encode($response);
  }



  public function update($table,$id, $columns,$updateField, $successMsg, $errorMsg,$selectWhereClause=[], $selectParamsWhere=[]){

    $selectWhere = count($selectWhereClause) > 0  ? $selectWhereClause :  ['id' => $id];
    $params = count($selectParamsWhere) > 0 ? $selectParamsWhere : [':id' => $id];
    $updateWhere = $selectWhere;

    $update = $this->db->updateQuery($table, $columns, $updateField, $selectWhere, $params, $updateWhere);

    

    if ($update) {
      $response = array('success' => true, 'message' => $successMsg);

    } else {
      $response = array('success' => false, 'message' => $errorMsg);
    }

    echo json_encode($response);
  }

 

  public function updateReqValid($tableName, $updateColumnField, $updateWhere = [])
  {
    $updateQuery = $this->db->updateQueryValid($tableName, $updateColumnField, $updateWhere);

    if ($updateQuery) {
      return $updateQuery;

    } else {
      return false;
    }
  }


  public function deleteReqValid($tableName, $deleteWhere = [])
  {
    $deleteQuery = $this->db->deleteQueryValid($tableName, $deleteWhere);

    if ($deleteQuery) {
      return $deleteQuery;

    } else {
      return false;
    }
  }


  

  public function delete($table,$id,$columns, $successMsg, $errorMsg,$selectWhere = [])
  {


    $selectWhere = count($selectWhere) > 0 ? $selectWhere : ['id' => $id];
    $params = $selectWhere;
    $deleteWhere = $selectWhere;

    $delete = $this->db->deleteQuery($table,$columns, $selectWhere, $params, $deleteWhere);

    if ($delete) {
      $response = array('success' => true, 'message' => $successMsg);

    } else {
      $response = array('success' => false, 'message' => $errorMsg);
    }

    echo json_encode($response);
  

  }


  public function deleteWithCustomKey($table,$key, $id, $columns, $successMsg, $errorMsg, $selectWhere = [])
  {


    $selectWhere = count($selectWhere) > 0 ? $selectWhere : [$key => $id];
    $params = $selectWhere;
    $deleteWhere = $selectWhere;

    $delete = $this->db->deleteQuery($table, $columns, $selectWhere, $params, $deleteWhere);

    if ($delete) {
      $response = array('success' => true, 'message' => $successMsg);

    } else {
      $response = array('success' => false, 'message' => $errorMsg);
    }

    echo json_encode($response);


  }



  // end resable crud

  // atttendance record



  public function getAttendanceRecord()
  {
    return $this->db->getSpecifiQuery('attendance_record', [], [], [], 1);
  }


  public function getRecentArchives()
  {
    return $this->db->getSpecifiQuery('getrecentarchive', [], [], [], 0);
  }


  public function getAttendanceList()
  {
    return $this->db->getSpecifiQuery('attendance_list', [], [], [], 1);
  }


  public function getArchiveList($tablename='attendance_list')
  {
    return $this->db->getSpecificTable($tablename);
  }


  public function getArchiveTableHasValue($columnId,$tablename = 'attendance_list',)
  {
    return $this->db->getSpecificArchiveTable($tablename,$columnId);
  }
  public function getArchiveTables()
  {
    return $this->db->getSpecifiQuery('getarchivetables', [], [], [], 1);
  }


  public function getTeacherAttendanceView($accountId)
  
  {
    $selectWhere = array('account_id' => $accountId);

    return $this->db->getSpecifiQuery('teacher_attendance', [], $selectWhere, $selectWhere, 1);
  }

   public function getCountStudentPerTeacher($accountId)
  
  {
    $selectWhere = array('account_id' => $accountId);

    return $this->db->getSpecifiQuery('distictatttendanceuser', [], $selectWhere, $selectWhere, 1);
  }
// list of students enrolled

  public function getEnrolleUserName()
  {
    return $this->get('enrollment_records', ['enrollment_id','fullName'], [], [], 1);
  }

  public function getEnrolleUserLrn()
  {
    return $this->get('enrollment_records', ['enrollment_id', 'lrn'], [], [], 1);
  }

  // end student enrolled


  // !!!!!!!!!!!!! SECTION !!!!!!!!!!!!!




  public function getClassSection()
  {
    return $this->get('classdetails', [], [], [], 1);
  }


  public function getSections()
  {
    return $this->get('sectionlist', [], [], [], 1);
  }


  public function getSubjects()
  {
    return $this->get('subjectlist', [], [], [], 1);
  }


  public function getUsers(){
    return $this->get('userslist', [], [], [], 1);

  }


  public function getTeachersAccount(){

    $selectWhere = array('role' => '2');
    $params = array(':role' => '2');

    return $this->get('userslist', [], $selectWhere, $params, 1);
  }

  public function decodeRes($data){
    $dataRec = $data['data'];
    $post = json_decode($dataRec,true);

    return $post;
  }



  public function createSection($data){
    
    $post = $this->decodeRes($data);

    $secName = $post['secName'];
    // $secLimit = $post['secLimit'];
    // $secMin = $post['secMin'];
    // $secMax = $post['secMax'];
  

    $selectWhere = ['name' => $secName];
    $params = [':name' => $secName];
    $fields =['name' => $secName];

    // insert level                    table,column, where,params
    return $this->create('section',[],$fields,$selectWhere,$params,'Section has been addedd','Section existed');

   
  }


  public function updateSection($data)
  {

    $post = $this->decodeRes($data);

    $secName = $post['secName'];
    // $secLimit = $post['secLimit'];
    // $secMin = $post['secMin'];
    // $secMax = $post['secMax'];
     $secId = $post['section_id'];

    $selectWhere = array('id' => $secId);
   
    $updateField = ['id' => $secId, 'name' => $secName];


    $updateRec = $this->updateReqValid('section', $updateField, $selectWhere);
    if ($updateRec) {
      echo json_encode(array('success' => true, 'message' => 'Section updated successfully'));
    } else {
      echo json_encode(array('success' => false, 'message' => 'Something went wrong'));

    }


  }




  public function deleteSection($id)
  {
    return $this->delete('section',$id, [], 'Section has been deleted', 'Something went wrong,Please contact administrator');
  }


  // !!!!!!!!!!!!! END SECTION !!!!!!!!!!!!!
 

  ///////////////////////// YEAR LEVEL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


  public function getYearLevel()
  {
  return $this->db->getSpecifiQuery('yearlist', [], [], [], 1);
  }

  //$tableName,$selectFied,$insertColumnField,$where=[],$params=[],,$insertWhere=[]

  public function addYearLevel($name,$type)
  {

    $selectWhere = ['name' => $name];
    $params = $selectWhere;
  
    $fields =['name' => $name,'type' => $type];

    // insert level                    table,column, where,params
    return $this->create('year',[],$fields,$selectWhere,$params, 'Year has been addedd', 'Something went wrong,Please contact administrator');

  }

  public function updateYearLevel($id,$name, $type)
  {

    $updateField = ['id' => $id,'name' => $name, 'type' => $type];
    // insert level                    table,column, where,params
    return  $this->update('year',$id, [], $updateField, 'Year has been addedd', 'Something went wrong,Please contact administrator');

  }


  public function deleteYearLevel($id){
   
      $this->delete('year',$id, [], 'Year has been deleted', 'Something went wrong,Please contact administrator');

  }




  //////////////////// STUDENT RECORDS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

  public function getMasterStudentsRecord()
  {
    return $this->db->getSpecifiQuery('studentmasterlist', [], [], [], 1);
  }


  public function getStudentRecords()
  {
    return $this->db->getSpecifiQuery('enrollment_records', [], [], [],1);
  }

  //$tableName,$selectFied,$insertColumnField,$where=[],$params=[],,$insertWhere=[]

  public function addStudentRecord($lrn,$name,$profile,$gender,$age,$birthdate,$address,$genAve,$contact_name,$relatinship,$phone,$yearType)
  {

    $selectWhere = ['lrn' => $lrn,'name' => $name,'contact_name' => $contact_name,'emergency_contact' => $phone];
    $params = $selectWhere;

    $fields = ['lrn' => $lrn, 'name' => $name, 'profile' => $profile, 'gender' => $gender, 'age' => $age, 'birthdate' => $birthdate, 'address' => $address, 'gwa' => $genAve, 'contact_name' => $contact_name, 'relationship' => $relatinship, 'emergency_contact' => $phone];

    // insert level                    table,column, where,params
    return $this->create('studentsRecord', [], $fields, $selectWhere, $params, 'User has been addedd', 'Something went wrong,Please contact administrator');

  }

  public function validateSection($post)
  {
    $getSection = $this->getSections();
    $sectionId = 'failed'; // Default value

    foreach ($getSection as $section) {
      if ($post['gwa'] >= $section['min_grade'] && $post['gwa'] <= $section['max_grade']) {
        $sectionId = $section['id']; // Set the section ID and exit the loop
        break;
      }
    }

    return $sectionId;
  }


  public function enrollRegularStudents($dataRec){

    date_default_timezone_set('Asia/Manila');

    $jsonData = $dataRec["data"];

    // Decode the JSON string into a PHP array
    $post = json_decode($jsonData, true);


    $response = array();

      $whereClause = array('enrollment_id' => $post['enrollmentId']);
      $bindParams = array(':enrollment_id'=> $post['enrollmentId']);
      $getEnrollmentDate = $this->get('enrollment_records',['date_enrolled'],$whereClause,$bindParams);

        // $startDateStr = $post['startSchoolYear'];
        // $endDateStr = $post['endSchoolYear'];
    

        $getCurrentEnrollDate = date('Y-m-d',strtotime(($getEnrollmentDate['date_enrolled'])));
        $startDateStr = date('Y-m-d',strtotime(($post['startSchoolYear'])));
        $endDateStr = date('Y-m-d',strtotime(($post['endSchoolYear'])));
        // $currentDate ='2024-02-02';
       // $testNextEndYear = '2024-02-02';

        // Parse start and end dates
        
        $dateEnrolled = date_create($getCurrentEnrollDate);
        $startDate = date_create($startDateStr);
        $endDate = date_create($endDateStr);

        $prevEnroll = $post['regLevel'] - 1;


    $getYearEnrolled = $this->get('year', ['name'], ['id' => $prevEnroll], [':id' => $prevEnroll]);



    if ($dateEnrolled >= $startDate->format('Y-m-d') && $dateEnrolled <= $endDate->format('Y-m-d')) {
      $yearEnrolled = $getYearEnrolled['name'];

      $response = array(
      'sucess' => false,
      'message' => "Sorry! school year not end you are currently enrolled $yearEnrolled in this school year"
    );
   }
   else{

    

        $docs = array();

        $credentialType = $post['regCredentialType'];


        $card = isset($post['reg_report_card']) ? '1' : '0';
        $formsf10 = isset($post['reg_formsf10']) ? '1' : '0';
        $birtcertificate = isset($post['reg_birthcert']) ? '1' : '0';
        $certficate_gmoral = isset($post['reg_cert_gmoral']) ? '1' : '0';
        $med_cert = isset($post['med_cert']) ? '1' : '0';
        $let_rec = isset($post['let_rec']) ? '1' : '0';
        $study_permit = isset($post['study_permit']) ? '1' : '0';
        $alien_card = isset($post['alien_card']) ? '1' : '0';
        $passport = isset($post['passport']) ? '1' : '0';
        $auth_rec = isset($post['auth_rec']) ? '1' : '0';
        $studentRec = $post['userStudentId'];

        $docs = array(
          'report_card' => $card,
          'formSf10' => $formsf10,
          'birthCertificate' => $birtcertificate,
          'good_moral' => $certficate_gmoral,
          'medical_cert' => $med_cert,
          'rec_letter' => $let_rec,
          'study_permit' => $study_permit,
          'alien_regcard' => $alien_card,
          'passport_copy' => $passport,
          'auth_school_record' => $auth_rec,
          'type' => $credentialType,
          'student_id' => $studentRec,
        );


        $studentSubmittedId = $this->createValid('student_submitted', $docs, []);


        if ($studentSubmittedId) {


          $receipt = array(
            'typeFee' => $post['reg_typeFee'],
            'miscellanious' => $post['reg_miscellanious'],
            'bookModules' => $post['reg_bookModules'],
            'tuitionFee' => $post['reg_tuitionFee'],
            'totalFee' => $post['reg_totalFee'],
            'fullCashPayment' => $post['reg_fullCashPayment'],
            'student_id' => $studentRec,
          );





          $receiptRecord = $this->createValid('receipt_record', $receipt, []);




          if ($receiptRecord) {




            // create enrollment
            $enrollment = array(
              'gwa' => $post['gwa'],
              'student_id' => $studentRec,
              'section_id' => $post['newRegSection'],
              'year_level' => $post['regLevel'],
              'submit_report' => $studentSubmittedId,
              'receipt_id' => $receiptRecord
            );



            $enrolled = $this->createValid('enrollment_record', $enrollment, []);



            if ($enrolled) {
              $response = array('success' => true, 'message' => 'Student enrolled successfully');
            } else {
              $response = array('success' => false, 'message' => 'Student already generated receipt');
            }


          }
        } else {
          $response = array('success' => false, 'message' => 'Student already submitted the document');

        }




      


    }

    echo json_encode($response);

  }


  public function reEvaluteStudent($files, $post){


    $sectionId = $this->validateSection($post);




  

      $fullName = strtoupper($post['lname']) . ' ' . strtoupper($post['mname']) . ' ' . strtoupper($post['fname']);
   
      $studentId=  $post['studentId'];

      $studentFields = [
        'lrn' => $post['lrn'],
        'lname' => strtoupper($post['lname']),
        'mname' => strtoupper($post['mname']),
        'fname' => strtoupper($post['fname']),
        'fullName' => $fullName,
        'gender' => $post['gender'],
        'age' => $post['age'],
        'birthdate' => $post['birthdate'],
        'pbirth' => $post['pbirth'],
        'studentNumber' => $post['studentNumber'],
        'currentAddress' => $post['address'],
        'nationality' => strtoupper($post['nationality']),
        'fingerprint_upload' => '',
        'year_id' => $post['level'],
      ];


  

      if (isset($_FILES['renameProfile']['name'])) {
        $profileName = $_FILES['renameProfile']['name'];
        $studentFields['profile'] = $profileName;
      }
    

      $updateStudentRecWhere= array('id' => $studentId);

       $updateStudentRec = $this->updateReqValid('student_record', $studentFields, $updateStudentRecWhere);



      $response = array();

      if ($updateStudentRec) {





        $relativesfields = [
          'fatherName' => strtoupper($post['fatherName']),
          'fatherOccupation' => $post['fatherOccupation'],
          'fatherNumber' => $post['fatherNumber'],
          'motherName' => strtoupper($post['motherName']),
          'motherOccupation' => $post['motherOccupation'],
          'motherNumber' => $post['motherNumber'],
          // 'guardianName' => strtoupper($post['guardiansName']),
          // 'guardianNumber' => $post['guardianContactNumber'],
          // 'guardianAddress' => $post['guardianAddress']
        ];




        $contactName = strtoupper($post['contactName']);
        $relation = $post['relationship'];
        $phone = $post['contactNumber'];




        $emergencyFields = [
          'contactName	' => $contactName,
          'relationship' => $relation,
          'phone' => $phone
        ];




       
        $updateQueryWhere = array('student_id' => $studentId);


        $updateRelativeRec = $this->updateReqValid('relative_record', $relativesfields, $updateQueryWhere);


       

        if ($updateRelativeRec) {


          $updateEmergency = $this->updateReqValid('emergency_contact', $emergencyFields, $updateQueryWhere);


          if ($updateEmergency) {



            $docs = array();

            $credentialType = $post['credentialType'];


            $card = isset($post['report_card']) ? '1' : '0';
            $formsf10 = isset($post['formsf10']) ? '1' : '0';
            $birtcertificate = isset($post['birtcertificate']) ? '1' : '0';
            $certficate_gmoral = isset($post['cert_gmoral']) ? '1' : '0';
            $med_cert = isset($post['med_cert']) ? '1' : '0';
            $let_rec = isset($post['let_rec']) ? '1' : '0';
            $study_permit = isset($post['study_permit']) ? '1' : '0';
            $alien_card = isset($post['alien_card']) ? '1' : '0';
            $passport = isset($post['passport']) ? '1' : '0';
            $auth_rec = isset($post['auth_rec']) ? '1' : '0';


            $docs = array(
              'report_card' => $card,
              'formSf10' => $formsf10,
              'birthCertificate' => $birtcertificate,
              'good_moral' => $certficate_gmoral,
              'medical_cert' => $med_cert,
              'rec_letter' => $let_rec,
              'study_permit' => $study_permit,
              'alien_regcard' => $alien_card,
              'passport_copy' => $passport,
              'auth_school_record' => $auth_rec,
              'type' => $credentialType,
            );


            $studentSubmittedId = $this->updateReqValid('student_submitted', $docs, $updateQueryWhere);

            if ($studentSubmittedId) {

        
              $target_profile_dir = '../images/uploads/profile/';
              $target_fingerprint_dir = '../images/uploads/fingerprint/';

              if (!is_dir($target_profile_dir)) {
                mkdir($target_profile_dir, 0755, true); // Create the directory recursively with proper permissions
              }

              if (!is_dir($target_fingerprint_dir)) {
                mkdir($target_fingerprint_dir, 0755, true); // Create the directory recursively with proper permissions
              }

              $profile = $_FILES['renameProfile'] ?? $_FILES['profile'];



              if (isset($_FILES['renameProfile'])) {
                // Handle file upload
                handleFileUpload($profile, $target_profile_dir);

                // If you want to delete a specific file (e.g., to replace it), you can use unlink
                $fileToDelete = $target_profile_dir . $post['oldProfile']; // Specify the file to delete
                if (file_exists($fileToDelete)) {
                    unlink($fileToDelete);
                }
              }
           
        
              $receipt = array(
                'typeFee' => $post['typeFee'],
                'miscellanious' => $post['miscellanious'],
                'bookModules' => $post['bookModules'],
                'tuitionFee' => $post['tuitionFee'],
                'totalFee' => $post['totalFee'],
                'fullCashPayment' => $post['fullCashPayment'],
              );


              $receiptRecord = $this->updateReqValid('receipt_record', $receipt, $updateQueryWhere);


  
             


              if ($receiptRecord) {

            
                $enrollment = array(
                  'gwa' => $post['gwa'],
                  'section_id' => $post['newSection'],
                  'year_level' => $post['level']
                );



                $enrolled = $this->updateReqValid('enrollment_record', $enrollment, $updateQueryWhere);



                if ($enrolled) {
                  $response = array('success' => true, 'message' => 'Student reevaluated successfully');
                } else {
                  $response = array('success' => false, 'message' => 'Student already generated receipt');
                }
              } else {
                $response = array('success' => false, 'message' => 'Student already enrolled');
              }


            } else {
              $response = array('success' => false, 'message' => 'Student already submitted the document');

            }




          } else {

            $response = array('success' => false, 'message' => 'Emergency contact existed input by other student');

          }







        } else {
          $response = array('success' => false, 'message' => 'Relative existed input by other student');



        }







      } else {
        $response = array('success' => false, 'message' => 'Duplicate record entry');



      }







    echo json_encode($response);


  




  }
  


  public function enrollStudent($files,$post){

// first fingerprint
// student id section id year_level,submit_report_receipt_id

    date_default_timezone_set('Asia/Manila');


    $fingerprintName = $_FILES['fingerprint']['name'];
   




      $response = array();



              $target_fingerprint_dir = '../images/uploads/fingerprint/';


              if (!is_dir($target_fingerprint_dir)) {
                mkdir($target_fingerprint_dir, 0755, true); // Create the directory recursively with proper permissions
              }

 
              $fingerprint = $_FILES['fingerprint'];

     
              handleFileUpload($fingerprint, $target_fingerprint_dir);

              // $selectReceiptWhere = array('student_id' => $post['studentId']);
              // $selectReceiptParams = array(':student_id' => $post['studentId']);

              $jsonString = $_POST['paymentFee'];

            $decodedPaymentFee = json_decode($jsonString, true);




              $receipt = array(
                'typeFee' => $decodedPaymentFee['typeFee'],
                'miscellanious' => $decodedPaymentFee['misc'],
                'bookModules' => $decodedPaymentFee['booksModule'],
                'tuitionFee' => $decodedPaymentFee['tuitionFee'],
                'totalFee' => $decodedPaymentFee['totalFee'],
                'fullCashPayment' => $decodedPaymentFee['fullCash'],
                'student_id' => $post['studentId'],
              );




              $receiptRecord = $this->createValid('receipt_record',$receipt,[]);





              if($receiptRecord){



                // create enrollment
                $enrollment = array(
                  'fingerprint_upload' => $fingerprintName,
                  'student_id' => $post['studentId'],
                  'section_id' => $post['newSection'],
                  'submit_report' => $post['submitId'],
                  'receipt_id' => $receiptRecord
                );



                $enrolled = $this->createValid('enrollment_record', $enrollment, []);


                
                if ($enrolled) {




                  $response = array('success' => true, 'message' => 'Student enrolled successfully');
                } else {
                  $response = array('success' => false, 'message' => 'Student already enrolled');
                }
              }
              
              else{
                $response = array('success'=> false, 'message' => 'Student already enrolled');
              }

          


        echo json_encode($response);


    // send record to emergeny


    // send record student record

    //validate gwa of users
    // asssign section for use






  }


  public function updateSchoolYear($dataRes){
    // get data
    $dataRec = $dataRes['data'];

    $post = json_decode($dataRec, true);

    $startDateStr = $post['startDate'];
    $endDateStr = $post['endDate'];
    $id = $post['schoolId'];

    $schoolField = array(
      'start_date' => $startDateStr,
      'end_date' => $endDateStr
    );

    $updateWhere = array('id' => $id);

    $response = array();

    $schoolRec = $this->updateReqValid('schoolYear',$schoolField,$updateWhere);

  
 
    if($schoolRec){
      $response = array('success' => true, 'message' => 'School year updated successfully');
    }
    else{
      $response = array('success' => false, 'message' => 'School year already updated');
    }

    echo json_encode($response);
  
  }



  // public function updateStudentRecord($id, $lrn, $name, $profile, $gender, $age, $birthdate, $address, $genAve,$type)
  // {

  //   $updateField = ['id' => $id, 'lrn' => $lrn, 'name' => $name, 'profile' => $profile, 'gender' => $gender, 'age' => $age, 'birthdate' => $birthdate, 'address' => $address, 'gwa' => $genAve, 'contact_name' => $contact_name, 'relationship' => $relatinship, 'emergency_contact' => $phone, 'year_id' => $yearType];
  //   // insert level                    table,column, where,params
  //   return $this->update('studentsRecord', $id, [], $updateField, 'User has been addedd', 'Something went wrong,Please contact administrator');

  // }


  public function deleteStudentRecord($enrollmentId)
  {
  
    
    $response = array();

    $deleteWhere = ['id' => $enrollmentId];


    $deleteRec = $this->deleteReqValid('enrollment_record', $deleteWhere);



    if ($deleteRec) {
      $response = array('success' => true, 'message' => 'Deleted record successfully');
    } else {
      $response = array('success' => false, 'message' => 'Delete record failed');
    }

    echo json_encode($response);

  }



  public function getYearType($type){

  return $this->select('year',[],['type'=> $type],['type'=> $type],1);

  }


  public function getNextYearLevel($id)
  {

    $id = $id + 1;

    return $this->select('year', [], ['id' => $id], ['type' => $id], 0);

  }
  

  public function getSchoolYear()
  {
    return $this->get('schoolyear', ['id,start_date,end_date'], [], []);

  }


  public function getEnrollmentRec($lrn){

    $response = array();
    $studentReq = $this->get('enrollment_records', [], ['lrn' => $lrn], [':lrn' => $lrn]);

    if($studentReq){
        $response = array('success' => true, 'message' => 'Student record found', 'studentRecord' => $studentReq);
    }
    else{
      $response = array('success' => false, 'message' => 'Student record not found');
    }

    echo json_encode($response);
  }
  


  public function getUserLrn($lrn){


  

   $studentReq = $this->get('student_record', ['id'], ['lrn' => $lrn], [':lrn' => $lrn]);





  
    if($studentReq != NULL){

        $enrollmentReq = $this->get('enrollment_records', ['enrollment_id','fullName','yearLevelId','yearType','yearLevel','date_enrolled'], ['student_id' => $studentReq['id']], [':student_id' => $studentReq['id']]);


      
      if($enrollmentReq){

        date_default_timezone_set('Asia/Manila');
        // get school year
        $getNextId =$enrollmentReq['yearLevelId'] < 14 ? $enrollmentReq['yearLevelId'] + 1 : 0 ;
        if($getNextId > 0){
          $getYearEnrolled = $this->get('year', ['id', 'name'], ['id' => $getNextId], [':id' => $getNextId]);
          $schoolYear = $this->get('schoolYear', ['start_date', 'end_date'], [], []);
          $studentEnroll = date('Y-m-d', strtotime($enrollmentReq['date_enrolled']));


          // Start date and end date in your desired format
          $startDateStr = $studentEnroll;
          $endDateStr = $schoolYear['end_date'];
          $presetYear = date('Y', strtotime($schoolYear['start_date']));
          $nextYear = date('Y', strtotime($schoolYear['end_date']));

          // $currentDate ='2024-02-02';
          // $currentDate = date('Y-m-d');
          // Parse start and end dates
          $startDate = date_create($startDateStr);
          $endDate = date_create($endDateStr);
          $dateEnrolled = date_create($endDateStr);

          $userYearenrolled = $enrollmentReq['yearLevel'];
          $nextLevel = $getYearEnrolled['name'];
          $nextId = $getYearEnrolled['id'];
          $getYearLevelType = $enrollmentReq['yearType'];
          $getName = $enrollmentReq['fullName'];
          $enrollId = $enrollmentReq['enrollment_id'];

          // var_dump($currentDate);
          // var_dump($startDate);
          // var_dump($endDate);

          // echo date_default_timezone_get();
          // Check if the current date is within the date range
          if ($dateEnrolled->format('Y-m-d') >= $startDate->format('Y-m-d') && $dateEnrolled->format('Y-m-d') <= $endDate->format('Y-m-d')) {
            echo json_encode(array('success' => false, 'start' => $presetYear, 'end' => $nextYear, 'message' => "Sorry user enrolled $userYearenrolled  in this school year", 'userId' => $studentReq['id'], 'yearType' => $getYearLevelType, 'fullName' => $getName));
          } else {
            echo json_encode(array('success' => true, 'start' => $presetYear, 'end' => $nextYear, 'message' => 'User able to enroll', 'userId' => $studentReq['id'], 'yearLevel' => $nextLevel, 'yearType' => $getYearLevelType, 'yearId' => $nextId, 'fullName' => $getName,'enrollmentId' => $enrollId));
          }
        }
        else{
          echo json_encode(array('success' => false,  'message' => "Sorry you can't reenrolled cuz you already Grade 12 and this is the last grade level in high school", 'userId' => $studentReq['id']));

        }
      }


      
    }
    else{
      echo json_encode(array('success' => false, 'message' => 'Lrn not found'));
    }

   }


  //////////////////// END STUDENT RECORDS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


  // user credentuals

  public function createUserCredentials($data)
  {
    $data = $data['data'];

    $post = json_decode($data,true);

    $selectWhere = array('username' => $post['usernameAccount']);
    $params = array(':username' => $post['usernameAccount']);
    $hashPassword = password_hash($post['passwordAccount'], PASSWORD_BCRYPT);
    $postField= array(
      'username'=> $post['usernameAccount'],
      'password'=> $hashPassword,
      'role' => $post['roleAccount'],
    );

    $this->create('users',[],$postField, $selectWhere,$params,'New user account registered','Opps Something went wrong');


  }

  public function modifyUserCredentials($data)
  {
    $data = $data['data'];

    $post = json_decode($data, true);

 

    $updateWhere = array('id' => $post['credential_id']);

    $postField = array(
      'username' => $post['usernameAccount'],
      'role' => $post['roleAccount'],
    );

    if (strlen($post['passwordAccount']) > 0) {
      
      $hashPassword = password_hash($post['passwordAccount'], PASSWORD_BCRYPT);

      $postField['password'] = $hashPassword;
    }



  $updateRec =   $this->updateReqValid('users',  $postField, $updateWhere);
  if ($updateRec) {
    echo json_encode(array('success' => true,'message' => 'User updated successfully'));
  }
  else{
      echo json_encode(array('success' => false, 'message' => 'Something went wrong'));

    }

}



public function deleteUserCredentials($id){
    return $this->delete('users', $id, [], 'Users has been removed successfully', 'Something went wrong,Please contact administrator');

  }


  // end user credentials


  // subject


  public function createSubject($data)
  {


    $post = $this->decodeRes($data);

    $subjectName = $post['subjectName'];
 


    $selectWhere = ['name' => $subjectName];
    $params = [':name' => $subjectName];
    $postField = ['name' => $subjectName];

    // insert level                    table,column, where,params
    return $this->create('subject', [], $postField, $selectWhere, $params, 'Subject has been addedd', 'Section existed');


  }


  public function updateSubject($data)
  {

    $post = $this->decodeRes($data);

    $subjectName = $post['subjectName'];
    $subject_id = $post['subject_id'];
 

    $selectWhere = array('id' => $subject_id);

    $updateField = ['id' => $subject_id, 'name' => $subjectName];


    $updateRec = $this->updateReqValid('subject', $updateField, $selectWhere);
    if ($updateRec) {
      echo json_encode(array('success' => true, 'message' => 'Subject updated successfully'));
    } else {
      echo json_encode(array('success' => false, 'message' => 'Something went wrong'));

    }


  }




  public function deleteSubject($id)
  {
    return $this->delete('subject', $id, [], 'Subject has been deleted', 'Something went wrong,Please contact administrator');
  }

  // end subject

  // teacher

  
// teacher
public function getTeacherDetails()
{
  return $this->db->getSpecifiQuery('teacherinfo', [], [], [], 1);


}




public function addTeacher($files,$post){    



  $postTeacherProfile = array(
    'fullName' => strtoupper($post['teach_fullname']),
    'profile' => $files['teacherProfile']['name'],
    'gender' => $post['teacherGender'],
    'age' => $post['teacherAge'],
    'birthdate' => $post['teacherBirthday'],
    'address' => $post['teacherAddress'],
    'course_taken' => $post['courseTaken'],
    'account_id' => $post['accountSelection'],
    
  );

    $where = array('account_id' => $post['accountSelection'],'fullName' => $post['teach_fullname']);
    $params = array(':account_id' => $post['accountSelection'],':fullName' => $post['teach_fullname']);

//  validate user if exist or not
    $teacherProfileRec = $this->createWithVerify('teacher_profile', [], $postTeacherProfile, $where, $params, 'Teacher has been addedd', 'Something went wrong,Please contact administrator');


  $response = array();


  if($teacherProfileRec){

      // insert multiple  
      // $isValid = '';
      
   


      // $subjectJsonString = $post['subject'] ?? [];

      // // Decode the JSON string to an array
      // $subjectArray = json_decode($subjectJsonString, true);

      // // Check if the decoding was successful
      // if ($subjectArray !== null) {
      //   // Loop through each subject
      //   foreach ($subjectArray as $subject) {
      //     // Access the values
      //     $subjectValue = $subject['subject'] ?? '';
      //     $levelValue = $subject['level'] ?? '';

      //     if($subjectValue !== '' && $levelValue !== ''){
      //       $postTeacherSubject = array(
      //         'teacher_id' => $teacherProfileRec,
      //         'subject_id' => $subjectValue,
      //         'year_level' => $levelValue
      //       );

      //       $teacherSubjectRec = $this->createValid('teacher_record', $postTeacherSubject, []);
      //       $isValid = $teacherSubjectRec;
      //     }

      //   }
      // } else {
      //   // Handle the case where decoding fails
      //   echo "Failed to decode JSON string<br>";
      // }




      // if ($isValid) {


        $target_profile_dir = '../images/uploads/teacher-profile/';
      
        if (!is_dir($target_profile_dir)) {
          mkdir($target_profile_dir, 0755, true); // Create the directory recursively with proper permissions
        }
        $teacherProfile = $files['teacherProfile'];
     
        handleFileUpload($teacherProfile, $target_profile_dir);
     

        $response = array('success' => true, 'message' => 'Teacher added successfully');

      } else {

        $response = array('success' => false, 'message' => 'Account already taken');

      }


  // }
  // else{
  //   $response = array('success' => false, 'message' => 'Account already taken');
  // }


  echo json_encode($response);

}



public function updateTeacher($files,$post){


    $postTeacherProfile = array(
      'fullName' => strtoupper($post['teach_fullname']),
      'profile' => $files['teacherProfile']['name'] !== '' ? $files['teacherProfile']['name'] : $post['oldTeacherProfile'],
      'gender' => $post['teacherGender'],
      'age' => $post['teacherAge'],
      'birthdate' => $post['teacherBirthday'],
      'address' => $post['teacherAddress'],
      'course_taken' => $post['courseTaken'],
      'account_id' => $post['accountSelection'],
    );



 
    
    $where = array('id' => $post['teacher_id']);
  
    //  validate user if exist or not
    $teacherProfileRec = $this->updateReqValid('teacher_profile', $postTeacherProfile, $where);


    $response = array();


    if ($teacherProfileRec) {

      // // insert multiple  
      // $isValid = '';




      // $subjectJsonString = $post['subject'] ?? [];

      // // Decode the JSON string to an array
      // $subjectArray = json_decode($subjectJsonString, true);

      // // Check if the decoding was successful
      // if ($subjectArray !== null) {
      //   // Loop through each subject
      //   foreach ($subjectArray as $subject) {
      //     // Access the values
      //     $subjectValue = $subject['subject'] ?? '';
      //     $levelValue = $subject['level'] ?? '';
      //     $ids = $subject['id'] ?? '';

      //     if ($subjectValue !== '' && $levelValue !== '' && $ids !== '') {
      //       $postTeacherSubject = array(
      //         'subject_id' => $subjectValue,
      //         'year_level' => $levelValue
      //       );


            

      //       $whereTeacherRec = array('id' => $ids);


      //       $teacherSubjectRec = $this->updateReqValid('teacher_record', $postTeacherSubject, $whereTeacherRec);

           

      //       $isValid = $teacherSubjectRec;
      //     }

      //   }
      // } else {
      //   // Handle the case where decoding fails
      //   echo "Failed to decode JSON string<br>";
      // }




      // if ($isValid) {

    

        $target_profile_dir = '../images/uploads/teacher-profile/';

        if (!is_dir($target_profile_dir)) {
          mkdir($target_profile_dir, 0755, true); // Create the directory recursively with proper permissions
        }
        $teacherProfile = $files['teacherProfile'];

    
        if ($files['teacherProfile']['name'] !== '') {
          // If you want to delete a specific file (e.g., to replace it), you can use unlink
          $fileToDelete = $target_profile_dir . $post['oldTeacherProfile']; // Specify the file to delete
          if (file_exists($fileToDelete)) {
            unlink($fileToDelete);

          handleFileUpload($teacherProfile, $target_profile_dir);
          }
        }


         $response = array('success' => true, 'message' => 'Teacher updated successfully');

      // } else {

      //   $response = array('success' => false, 'message' => 'Account already taken');

      // }


    } else {
      $response = array('success' => false, 'message' => 'Account already taken');
    }


    echo json_encode($response);
}


public function deleteTeacher($id){
    return $this->delete('teacher_profile', $id, [], 'Record has been deleted', 'Something went wrong,Please contact administrator');

  }
// end teacher


  // end teacher


  // classes

  public function getClassRecords()
  {
    return $this->db->getSpecifiQuery('classdetails', [], [], [], 1);


  }

  public function addClass($data){

    $post = $this->decodeRes($data);

    
      
    $scheduedTime = $post['startClass'] .'-'. $post['endClass'];



    $postField = array(
      'class_name' => $post['classesName'],
      'section_id' => $post['classSectionName'],
      'subject_id' => $post['classSubjectName'],
      'teacher_id' => $post['teacherClassItem'],
      'room_number' => $post['roomNumber'],
      'scheduled_time' => $scheduedTime,
      'timeofDay' => $post['timeofDay'],
      'year_level' => $post['classYearLevel'],
    );


    $where = array('class_name' => $post['classesName'],'room_number' => $post['roomNumber']);
    $params = array(':class_name' => $post['classesName'],':room_number' => $post['roomNumber']);

    $classRec = $this->createWithVerify('classes_record', [], $postField, $where, $params, 'Class has been addedd', 'Forbidden classes already scheduled');

    if($classRec){
      echo json_encode(array('success' => true, 'message' => 'Class added successfully'));
    }
    else{
      echo json_encode(array('success' => false, 'message' => 'Forbidden classes already scheduled'));
    }

  }


    public function editClass($data){

    $post = $this->decodeRes($data);

    
      
    $scheduedTime = $post['startClass'] .'-'. $post['endClass'];



    $postField = array(
      'class_name' => $post['classesName'],
      'section_id' => $post['classSectionName'],
      'subject_id' => $post['classSubjectName'],
      'teacher_id' => $post['teacherClassItem'],
      'room_number' => $post['roomNumber'],
      'scheduled_time' => $scheduedTime,
      'timeofDay' => $post['timeofDay'],
      'year_level' => $post['classYearLevel'],
    );


    $where = array('class_id' => $post['classId']);
    $params = array(':class_id' => $post['classId']);

    $classRec = $this->updateReqValid('classes_record', $postField, $where);

    if($classRec){
      echo json_encode(array('success' => true, 'message' => 'Class updated successfully'));
    }
    else{
      echo json_encode(array('success' => false, 'message' => 'Forbidden classes uppdate failed'));
    }

  }


  public function deleteClass($id){
    $where = array('class_id' => $id);
    return $this->delete('classes_record', $id, [], 'Record has been deleted', 'Something went wrong,Please contact administrator', $where);

  }

  // end classes


  // attendance
  public function addAttendance($data){
    $post = $this->decodeRes($data);




    $getAttendance = $this->get('attendance_record_list', [],[],[],1);


    $isExist = false;


  if($getAttendance != NULL){
      foreach ($getAttendance as $attendance) {

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d', strtotime($attendance['date_created']));
        $dateNow = date('Y-m-d');

        if ($attendance['attendance_id'] == $post['attendance_id'] && $attendance['rec_type'] == $post['clockType'] && $dateNow == $date) {
          $isExist = true;
        }

      }
  }

    if($isExist){

      $clockName = $post['clockType'] == 1 ? 'clock in' : 'clock out';

      echo json_encode(array('success' => false, 'message' => "Attendance ($clockName) already recorded"));
    }
    else{

      $postField = array(
        'attendance_id' => $post['attendance_id'],
        'rec_type' => $post['clockType'],
      );

      $attendanceRec = $this->createValid('attendance_record_list', $postField, []);

      if($attendanceRec){
        echo json_encode(array('success' => true, 'message' => 'Attendance recorded successfully'));
      }
      else{
        echo json_encode(array('success' => false, 'message' => 'Attendance failed to record'));
      }
    }


    // validate attendance during this day and it user already exist or not


  }




// form revise registrtation




  public function registrationStudentForm($files, $post)
  {

    $fullName = strtoupper($post['lname']) . ' ' . strtoupper($post['mname']) . ' ' . strtoupper($post['fname']);
    $profileName = $_FILES['renameProfile']['name'];
    // $fingerprintName = $_FILES['fingerprint']['name'];



    $selectPersonalWhere = array('lrn' => $post['lrn'], 'fullName' => $fullName, 'studentNumber' => $post['studentNumber'], 'email' => $post['email']);
    $selectParams = array(':lrn' => $post['lrn'], ':fullName' => $fullName, ':studentNumber' => $post['studentNumber'], ':email' => $post['email']);
    $studentFields = [
      'ref_number' => $post['ref_number'],
      'lrn' => $post['lrn'],
      'lname' => strtoupper($post['lname']),
      'mname' => strtoupper($post['mname']),
      'fname' => strtoupper($post['fname']),
      'profile' => $profileName,
      'email' => $post['email'],
      'fullName' => $fullName,
      'gender' => $post['gender'],
      'age' => $post['age'],
      'birthdate' => $post['birthdate'],
      'pbirth' => $post['pbirth'],
      'studentNumber' => $post['studentNumber'],
      'currentAddress' => $post['address'],
      'nationality' => strtoupper($post['nationality']),
      'year_id' => $post['level'],
    ];




    $studentRec = $this->createWithVerify('student_record', [], $studentFields, $selectPersonalWhere, $selectParams, 'Student has been addedd', 'Something went wrong,Please contact administrator');




    $response = array();

    if ($studentRec) {




      // send record of relative
      $selectWhereRelative = ['fatherName' => $post['fatherName'], 'motherName' => $post['motherName'], 'guardianName' => $post['guardiansName']];
      $selectRelativeParams = [':fatherName' => $post['fatherName'], ':motherName' => $post['motherName'], ':guardianName' => $post['guardiansName']];



      $relativesfields = [
        'fatherName' => strtoupper($post['fatherName']),
        'fatherOccupation' => $post['fatherOccupation'],
        'fatherNumber' => $post['fatherNumber'],
        'fatherEmail' => $post['fatherEmail'],
        'fatherAddress' => $post['fatherAddress'],
        'motherName' => strtoupper($post['motherName']),
        'motherOccupation' => $post['motherOccupation'],
        'motherNumber' => $post['motherNumber'],
        'motherEmail' => $post['motherEmail'],
        'motherAddress' => $post['motherAddress'],
        'guardianName' => strtoupper($post['guardiansName']),
        'guardianNumber' => $post['guardianContactNumber'],
        'guardianEmail' => $post['guardianEmail'],
        'guardianAddress' => $post['guardianAddress'],
        'student_id' => $studentRec
      ];




      $contactName = strtoupper($post['contactName']);
      $relation = $post['relationship'];
      $phone = $post['contactNumber'];




      $emergencyFields = [
        'contactName	' => $contactName,
        'relationship' => $relation,
        'phone' => $phone,
        'student_id' => $studentRec
      ];




      $selectWhereEmergency = array('contactName' => $contactName, 'relationship' => $relation, 'phone' => $phone);

      $selectWhereEmergencyParams = array(':contactName' => $contactName, ':relationship' => $relation, ':phone' => $phone);





      $relativeRec = $this->createWithVerify('relative_record', [], $relativesfields, $selectWhereRelative, $selectRelativeParams, 'Relative has been addedd', 'Something went wrong,Please contact administrator');


      if ($relativeRec) {



        $emergencyRec = $this->createWithVerify('emergency_contact', [], $emergencyFields, $selectWhereEmergency, $selectWhereEmergencyParams, 'Emergency has been addedd', 'Something went wrong,Please contact administrator');



        if ($emergencyRec) {



       
     



            $target_profile_dir = '../images/uploads/profile/';
            // $target_fingerprint_dir = '../images/uploads/fingerprint/';

            if (!is_dir($target_profile_dir)) {
              mkdir($target_profile_dir, 0755, true); // Create the directory recursively with proper permissions
            }

            // if (!is_dir($target_fingerprint_dir)) {
            //   mkdir($target_fingerprint_dir, 0755, true); // Create the directory recursively with proper permissions
            // }

            $profile = $_FILES['renameProfile'];
            // $fingerprint = $_FILES['fingerprint'];

            handleFileUpload($profile, $target_profile_dir);
            // handleFileUpload($fingerprint, $target_fingerprint_dir);

      

            if($post['credentialType'] == 'local'){
              // upload images to local directory

              $reportCardFile = $_FILES['form38'];
              $sf10 = $_FILES['form37'];
              $bcert = $_FILES['bcert'];
              $gmoral = $_FILES['gmoral'];
              $rec_letter = $_FILES['rec_letter'];
              $med_cert = $_FILES['med_cert'];




              if($reportCardFile['name'] != ''){
                
                $cardDir = '../images/uploads/documents/local/report-card/';
                $getCardNewName = 'card_'.$post['lrn'];

                handleFileUploadwithRename($reportCardFile, $cardDir, $getCardNewName);
              }

              if($sf10['name'] != ''){

                $sf10Dir = '../images/uploads/documents/local/form-sf10/';
                $getSf10NewName = 'sf10_' . $post['lrn'];


                handleFileUploadwithRename($sf10, $sf10Dir,$getSf10NewName);
              }

              if($bcert['name'] != ''){

               $bcertDir = '../images/uploads/documents/local/birth-cert/';
              $getBcertNewName = 'bcert_' . $post['lrn'];


                handleFileUploadwithRename($bcert, $bcertDir, $getBcertNewName);
              }

              if($gmoral['name'] != ''){
               $gmoralDir = '../images/uploads/documents/local/good-moral/';
               $getGmoraNewName = 'gmoral_' . $post['lrn'];


                handleFileUploadwithRename($gmoral, $gmoralDir,$getGmoraNewName);
              }

              if($rec_letter['name'] != ''){
               $rec_letterDir = '../images/uploads/documents/local/rec-letter/';

                $getRecLetterNewName = 'recletter_' . $post['lrn'];


                handleFileUploadwithRename($rec_letter, $rec_letterDir,$getRecLetterNewName);
              }

              if($med_cert['name'] != ''){

               $med_certDir = '../images/uploads/documents/local/med-cert/';
                $getMedNewName = 'med_cert_' . $post['lrn'];


                handleFileUploadwithRename($med_cert, $med_certDir, $getMedNewName);
              }

            }

            if($post['credentialType'] == 'foreign'){
              // upload images to foreign directory

              $studPermit = $_FILES['stud_permit'];
              $alientCert = $_FILES['alien_cert'];
              $passport = $_FILES['passport_copy'];
              $auth_rec = $_FILES['auth_rec'];

              if($studPermit['name'] != ''){
               $studDir = '../images/uploads/documents/foreign/stud-permit/';
                $getPermitNewName = 'studpermit_' . $post['lrn'];


                handleFileUploadwithRename($studPermit, $studDir, $getPermitNewName);
              }

              if($alientCert['name'] != ''){

               $alientCertDir = '../images/uploads/documents/foreign/alien_cert/';
                $alienCertNewName = 'aliencert_' . $post['lrn'];


                handleFileUploadwithRename($alientCert, $alientCertDir, $alienCertNewName);
              }

              if($passport['name'] != ''){

               $passportDir = '../images/uploads/documents/foreign/passport/';
                $passportNewName = 'passport_' . $post['lrn'];


                handleFileUploadwithRename($passport, $passportDir, $passportNewName);
              }

              if($auth_rec['name'] != ''){

               $authDir = '../images/uploads/documents/foreign/auth-rec/';
                $authNewName = 'auth_' . $post['lrn'];


                handleFileUploadwithRename($auth_rec, $authDir, $authNewName);
              }


            
            }

   $docs = array();

          $credentialType = $post['credentialType'];


          $pathCard = '.'.pathinfo($_FILES['form38']['name'], PATHINFO_EXTENSION);
          $pathSf10 = '.'.pathinfo($_FILES['form37']['name'], PATHINFO_EXTENSION);
          $pathbcert = '.'.pathinfo($_FILES['bcert']['name'], PATHINFO_EXTENSION);
          $pathgmoral= '.'.pathinfo($_FILES['gmoral']['name'], PATHINFO_EXTENSION);
          $pathmdecert= '.'.pathinfo($_FILES['med_cert']['name'], PATHINFO_EXTENSION);
          $pathreclet = '.'.pathinfo($_FILES['rec_letter']['name'], PATHINFO_EXTENSION);

          $pathstudpermit = '.'.pathinfo($_FILES['stud_permit']['name'], PATHINFO_EXTENSION);
          $pathalinecert = '.'.pathinfo($_FILES['alien_cert']['name'], PATHINFO_EXTENSION);
          $pathpassport = '.'.pathinfo($_FILES['passport_copy']['name'], PATHINFO_EXTENSION);
          $pathauthrec = '.'.pathinfo($_FILES['auth_rec']['name'], PATHINFO_EXTENSION);
          


          $reportCard = $post['selectForm38'] == 'upload' ? $getCardNewName. $pathCard : $post['selectForm38'];
          $formsf10 = $post['selectForm37'] == 'upload' ? $getSf10NewName . $pathSf10 : $post['selectForm37'];
          $birtcertificate = $post['selectBcert'] == 'upload' ? $getBcertNewName. $pathbcert : $post['selectBcert'];
          $certficate_gmoral = $post['selectgmoral'] == 'upload' ? $getGmoraNewName . $pathgmoral : $post['selectgmoral'];
          $med_cert = $post['select_med_cert'] == 'upload' ? $getMedNewName . $pathmdecert : $post['select_med_cert'];
          $let_rec = $post['select_rec_letter'] == 'upload' ? $getRecLetterNewName .$pathreclet : $post['select_rec_letter'];
          


          $study_permit = $post['select_stud_permit'] == 'upload' ? $getPermitNewName . $pathstudpermit : $post['select_stud_permit'];
          $alien_card = $post['select_alien_cert'] == 'upload' ? $alienCertNewName. $pathalinecert : $post['select_alien_cert'];
          $passport = $post['select_passport_copy'] == 'upload' ? $passportNewName . $pathpassport : $post['select_passport_copy'];
          $auth_rec = $post['select_auth_rec'] == 'upload' ? $authNewName . $pathauthrec : $post['select_auth_rec'];



          $docs = array(
            'report_card' => $reportCard,
            'formSf10' => $formsf10,
            'birthCertificate' => $birtcertificate,
            'good_moral' => $certficate_gmoral,
            'medical_cert' => $med_cert,
            'rec_letter' => $let_rec,
            'study_permit' => $study_permit,
            'alien_regcard' => $alien_card,
            'passport_copy' => $passport,
            'auth_school_record' => $auth_rec,
            'type' => $credentialType,
            'student_id' => $studentRec,
          );



          $studentSubmittedId = $this->createValid('student_submitted', $docs, []);



          if ($studentSubmittedId) {

            $response = array('success' => true, 'message' => 'Student registered successfully','refNumber' => $post['ref_number']);

        

          } else {
            $response = array('success' => false, 'message' => 'Student already submitted the document');

          }




        } else {

          $response = array('success' => false, 'message' => 'Emergency contact existed input by other student');

        }







      } else {
        $response = array('success' => false, 'message' => 'Relative existed input by other student');



      }







    } else {
      $response = array('success' => false, 'message' => 'Account already existed');



    }







    echo json_encode($response);


    // send record to emergeny


    // send record student record

    //validate gwa of users
    // asssign section for use






  }



  // end form registration


  public function getReferenceNumber($ref_number){

    $studentReq = $this->get('studentmasterlist', [], ['ref_number' => $ref_number], [':ref_number' => $ref_number]);

    $response = array();


              $whereClause = array('student_id' => $studentReq['id']);
              $bindParams = array(':student_id' => $studentReq['id']);
              $getEnrollmentDate = $this->get('enrollment_records', ['yearLevel','date_enrolled'], $whereClause, $bindParams);

             

                // test this to check if  you want user enrolled next school year
                // $dateNow = date_create(date('2025-02-02'));

        if($getEnrollmentDate){
          
                  $getSchoolYear = $this->get('schoolyear', [], [], []);


                
                  // check if enrolled in the same year


                    $getCurrentEnrollDate = date('Y-m-d', strtotime(($getEnrollmentDate['date_enrolled'])));
                    $startDateStr = date('Y-m-d', strtotime(($getSchoolYear['start_date'])));
                    $endDateStr = date('Y-m-d', strtotime(($getSchoolYear['end_date'])));



                    $dateEnrolled = date_create($getCurrentEnrollDate);
                    $startDate = date_create($startDateStr);
                    $endDate = date_create($endDateStr);
                    $dateNow = date_create(date('Y-m-d'));



            if ($dateNow->format('Y-m-d') >= $startDate->format('Y-m-d') && $dateNow->format('Y-m-d') <= $endDate->format('Y-m-d') &&  $dateNow->format('Y-m-d')  <= $dateEnrolled->format('Y-m-d') ) {
                $yearEnrolled = $getEnrollmentDate['yearLevel'];


                $response = array(
                'sucess' => false,
                'message' => "Sorry! school year yet ended you are currently enrolled $yearEnrolled in this school year"
              );

              
            }
        }
    else{
      

        if($studentReq){

          date_default_timezone_set('Asia/Manila');

          $dateRegistered = date('F d, Y', strtotime($studentReq['date_created']));

          $response = array('success' => true, 'message' => 'Accepted','data' => $studentReq,'dateRegistered' => $dateRegistered );

        }
        else{
          $response = array('success' => false, 'message' => 'Reference number not found','data' => []);

        }
    }
 
    echo json_encode($response);

  }


  // end attendance

// revision studens enrollment



// archive

  // archive list
  


  public function restoreArchive($post){
    $req = json_decode($post['data'], true);



    $deleteWhere = ['archive_id' => $req['archive_id']];


    $deleteRec = $this->deleteReqValid('archive', $deleteWhere);


    if($deleteRec){


      $selectWhere = array($req['id'] => $req['selectedId']);

      $updateField = ['is_archive' => 0];



      $updateRec = $this->updateReqValid($req['table'], $updateField, $selectWhere);
      if ($updateRec) {
        echo json_encode(array('success' => true, 'message' => 'Record restored successfully'));
      } else {
        echo json_encode(array('success' => false, 'message' => 'Something went wrong'));

      }
    }else{
      echo json_encode(array('success' => false, 'message' => 'Something went wrong'));
    }


  }

  public function deleteArchive($post){
    $req = json_decode($post['data'], true);

    return $this->deleteWithCustomKey($req['table'],$req['id'], $req['selectedId'], [], 'Record permanent  deleted', 'Something went wrong,Please contact administrator');

  }


  public function moveToArchive($post)
  {
    $req = json_decode($post['data'], true);


    $reqDetails = array(
      'archive_name' => $req['archiveName'],
      'tablename' => $req['table'],
      'column_name' => $req['id'],
      'columnId' => $req['selectedId'],
    );

    $archiveRes = $this->createValid('archive', $reqDetails, []);


    if($archiveRes){
      $selectWhere = array($req['id'] => $req['selectedId']);

      $updateField = ['is_archive' => 1];


      $updateRec = $this->updateReqValid($req['table'], $updateField, $selectWhere);
      if ($updateRec) {
        echo json_encode(array('success' => true, 'message' => 'Record moved to archive successfully'));
      } else {
        echo json_encode(array('success' => false, 'message' => 'Something went wrong'));

      }
    }


  }

// end archive


//editProfileDocuments

public function editProfileDocuments($files,$post){


// var_dump($post);

// echo $post['id'];

  $getFileName = $_FILES[$post['id']]['name'];


    if($getFileName != ''){
      $dir = $post['path'].$post['src'];

      $newName = $post['renameFile'];

    
      if(file_exists($dir)){
        unlink($dir);
      }
    

        handleFileUploadwithRename($_FILES[$post['id']], $post['path'], $newName);

        $whereStudId = array('student_id' => $post['studentId']);
        $newPatnName = '.' . pathinfo($getFileName, PATHINFO_EXTENSION);
    
        $getNePathName = $newName. $newPatnName;



        $updatedFields = array($post['columnName'] => $getNePathName);




    

        $updateReq = $this->updateReqValid('student_submitted', $updatedFields, $whereStudId);


  

        if ($updateReq) {
          $whereRef = array('id' => $post['studentId']);
          $paramsRef = [':id' => $post['studentId']];


          $getUpdateList = $this->get('studentmasterlist', [], $whereRef, $paramsRef);

          if ($getUpdateList) {

               $newDir = $post['hrefLink'].$getNePathName;

 

            echo json_encode(array('success' => true, 'message' => 'File is updated successfully', 'data' => $getUpdateList,'type' => $post['credentialType'],'imgId' => $post['imgId'],'newSrc' => $newDir,'getId' => $post['id']));

          } else {
            echo json_encode(array('success' => false, 'message' => 'Something went wrong Id not found', 'data' => [],'type'=> ''));

          }
        } else {
          echo json_encode(array('success' => false, 'message' => 'File is not updated the something problem occured'));
        }




      
     
   
    } else {
      echo json_encode(array('success' => false, 'message' => 'File is not updated the something problem occured'));
    }



  }


  public function editStudentMasterList($data){

    $post = $this->decodeRes($data);


    $getName = explode(' ', $post['viewFullName']);
    $selectPersonalWhere = array('id' => $post['viewStudentId']);
    $studentFields = [
      'lname' => strtoupper($getName[2]),
      'mname' => strtoupper($getName[1]),
      'fname' => strtoupper($getName[0]),
      'email' => $post['viewStudentEmail'],
      'fullName' => $post['viewFullName'],
      'gender' => $post['viewGender'],
      'age' => $post['viewAge'],
      'birthdate' => $post['viewBdate'],
      'pbirth' => $post['viewPlace'],
      'studentNumber' => $post['viewStudentNumber'],
      'currentAddress' => $post['viewAddress'],
      'nationality' => strtoupper($post['viewNationality']),
      'year_id' => $post['viewGradeLevel'],
    ];


    $studentRec = $this->updateReqValid('student_record', $studentFields, $selectPersonalWhere);

    if($studentRec){
      // relative 
      $selectRelativeWhere = array('student_id' => $post['viewStudentId']);
 


      $relativesfields = [
        'fatherName' => strtoupper($post['viewFatherName']),
        'fatherOccupation' => $post['viewFatherOccupation'],
        'fatherNumber' => $post['viewFatherNumber'],
        'fatherEmail' => $post['viewFatherEmail'],
        'fatherAddress' => $post['viewFatherAddress'],
        'motherName' => strtoupper($post['viewMotherName']),
        'motherOccupation' => $post['viewMotherOccupation'],
        'motherNumber' => $post['viewMotherNumber'],
        'motherEmail' => $post['viewMotherEmail'],
        'motherAddress' => $post['viewMotherAddress'],
        'guardianName' => strtoupper($post['viewGuardiansName']),
        'guardianNumber' => $post['viewGuardiansNumber'],
        'guardianEmail' => $post['viewGuardiansEmail'],
        'guardianAddress' => $post['viewGuardiansAddress'],
      ];


      $relativeRec = $this->updateReqValid('relative_record', $relativesfields, $selectRelativeWhere);


      if($relativeRec){
        $contactName = strtoupper($post['viewContactName']);
        $relation = $post['viewRelationship'];
        $phone = $post['viewContactNumber'];




        $emergencyFields = [
          'contactName	' => $contactName,
          'relationship' => $relation,
          'phone' => $phone,
        ];


      $emergency = $this->updateReqValid('emergency_contact', $emergencyFields, $selectRelativeWhere);

        if($emergency){

          //get student section

          

          if(isset($post['viewSection'])){
           
            $updateField = array(
              'section_id' => $post['viewSection'],
            );

            $updateEnrollment = $this->updateReqValid('enrollment_record', $updateField, ['student_id' => $post['viewStudentId']]);

            if ($updateEnrollment) {
              echo json_encode(array('success' => true, 'message' => 'Student updated successfully'));
            } 
          }
         
          else{
             echo json_encode(array('success' => true, 'message' => 'Student updated successfully'));

          }


        }
        else{
          echo json_encode(array('success' => false, 'message' => 'Something wento wrong, problem occured'));

        }

      }


     



      // emergency contact
    }else{
      echo json_encode(array('success' => false, 'message' => 'Invalid information,Soemthing went wrong'));

    }

  }


  public function updateEnrollementSection($data){
    $post = $this->decodeRes($data);

    // get enollment record 

    $response = array();

    $updateField = array(
      'section_id' => $post['newSection'],
    );

    $updateEnrollment = $this->updateReqValid('enrollment_record', $updateField, ['id' => $post['studentId']]);

    if($updateEnrollment){
      $response = array('success' => true, 'message' => 'Section updated successfully');
    }
    else{
      $response = array('success' => false, 'message' => 'Something went wrong,Please contact administrator');
    }

    echo json_encode($response);

  }

}



?>
