<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/attendance.css') ?>">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>



<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$getRecentArchives = $controller->getRecentArchives();


$getRecentTable = 'attendance_list';
$getRecentColumnId = 'rec_id';

if($getRecentArchives){
  $getRecentTable = $getRecentArchives['archive_name'];
  $getRecentColumnId = $getRecentArchives['column_name'];
}



$getTableSelected = isset($_GET['table']) ? $_GET['table'] : $getRecentTable ;
$getColumnId = isset($_GET['columnId']) ? $_GET['columnId'] : $getRecentColumnId;



$getArchiveList = $controller->getArchiveList($getTableSelected);

if(count ($getArchiveList) > 0){
  $getArchiveHasValue =  $controller->getArchiveTableHasValue($getColumnId,$getTableSelected);
}

$getArchiveSpecificTable = count($getArchiveList) > 0 ? $getArchiveHasValue: $getArchiveList;


$getArchiveTables = $controller->getArchiveTables();





$tableFields = [
  (object) [
    'type' => 'attendance_list',
    'thead' => ['#', 'LRN', 'Clock_type','Time','Date archive','Restore','Delete'],

    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'lrn',
        'key' => 'field',
        'databaseKey' => 'lrn'
      ],
      [
        'type' => 'clockType',
        'key' => 'field',
        'databaseKey' => 'clockType'
      ],
      [
        'type' => 'time',
        'key' => 'field',
        'databaseKey' => 'date_created'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],
   
    ],
  ],
  (object) [
    'type' => 'attendance_record',
    'thead' => ['#', 'Fullname', 'LRN', 'Fingerprint','Date archive', 'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'fullName',
        'key' => 'field',
        'databaseKey' => 'fullName'
      ],
      [
        'type' => 'lrn',
        'key' => 'field',
        'databaseKey' => 'lrn'
      ],
      [
        'type' => 'fingerscan',
        'key' => 'field',
        'databaseKey' => 'fingerscan'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],

  ],
  (object) [
    'type' => 'enrollment_records',
    'thead' => ['#', 'LRN', 'Name', 'Section', 'Grade Level','Date archive', 'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'lrn',
        'key' => 'field',
        'databaseKey' => 'lrn'
      ],
      [
        'type' => 'fullName',
        'key' => 'field',
        'databaseKey' => 'fullName'
      ],
      [
        'type' => 'sectionName',
        'key' => 'field',
        'databaseKey' => 'sectionName'
      ],
      [
        'type' => 'yearLevel',
        'key' => 'field',
        'databaseKey' => 'yearLevel'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],
  
  ],
  (object) [
    'type' => 'student_record',
    'thead' => ['#', 'Reference #', 'LRN', 'Fullname','Date archive', 'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'ref_number',
        'key' => 'field',
        'databaseKey' => 'ref_number'
      ],
      [
        'type' => 'lrn',
        'key' => 'field',
        'databaseKey' => 'lrn'
      ],
      [
        'type' => 'fullName',
        'key' => 'field',
        'databaseKey' => 'fullName'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
     
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],
    

  ],
  (object) [
    'type' => 'users',
    'thead' => ['#', 'Username', 'Password', 'Role','Date archive', 'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'username',
        'key' => 'field',
        'databaseKey' => 'username'
      ],
      [
        'type' => 'passwod',
        'key' => 'field',
        'databaseKey' => 'password'
      ],
      [
        'type' => 'role',
        'key' => 'field',
        'databaseKey' => 'role'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],
   

  ],
  (object) [
    'type' => 'classes_record',
    'thead' => ['#', 'Class name','Date archive',  'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'class_name',
        'key' => 'field',
        'databaseKey' => 'class_name'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],

  ],
   (object) [
    'type' => 'section',
    'thead' => ['#', 'Section name','Date archive',  'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'name',
        'key' => 'field',
        'databaseKey' => 'name'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],

 

  ],
  (object) [
    'type' => 'subject',
    'thead' => ['#', 'Subject name','Date archive', 'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'name',
        'key' => 'field',
        'databaseKey' => 'name'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],


  ],
  (object) [
    'type' => 'teacher_profile',
    'thead' => ['#', 'Teacher name','Date archive', 'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'fullName',
        'key' => 'field',
        'databaseKey' => 'fullName'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],
    'databaseKey' => ['fullName']

  ],
  (object) [
    'type' => 'year',
    'thead' => ['#', 'Grade level','Date archive', 'Restore', 'Delete'],
    'tbody' => (object) [
      [
        'type' => 'index',
        'key' => 'key',
        'databaseKey' => ''
      ],
      [
        'type' => 'name',
        'key' => 'field',
        'databaseKey' => 'name'
      ],
      [
        'type' => 'date',
        'key' => 'field',
        'databaseKey' => 'archiveDate'
      ],
      [
        'type' => 'restore',
        'key' => 'restore',
        'databaseKey' => ''
      ],
      [
        'type' => 'delete',
        'key' => 'delete',
        'databaseKey' => ''
      ],

    ],
    'databaseKey' => ['name']

  ]
];


// foreach ($columnField as $object) {
//   echo "Type: " . $object->type . "\n";
//   echo "Columns: " . implode(', ', $object->column) . "\n";
//   echo "--------------------------\n";
// }

?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Archive</p>
</div>

<div class='w-[90%] mx-auto'>


  <!-- breadcrums  -->



  <!-- wrapper  filter-->
  <div class='w-full mx-auto'>
    <!-- filter search -->

    <div class='w-[80%] flex justify-between items-center gap-5 mx-auto'>
      <!-- sort -->
      <div>
        <?php require_once(__DIR__ . '/widget/widget.php'); ?>
        <!-- <p class='text-md text-gray-500 font-bold'>Sort <span class='btn btn-blue-500 p-2'>▼</span></p> -->
      </div>
      <!-- search -->
      <div class="search focus:outline focus:outline-offset-2 focus:outline-1 focus:outline-blue-500 focus:rounded">
        <label>
          <input id='archieveSearchEl' type="text" placeholder="Search here">
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <!-- print -->
      <!-- <div>
        <button id='archievePrint'
          class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
      </div> -->

    
    </div>

  </div>






  <!-- wrapper for table  need to use grid-->
  <div class='w-full mx-auto bg-white-500 shadow rounded mt-10'>

   
           <div id='filterTable' class="flex justify-start item-center gap-4 mb-4">
              <label for="filterTable" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">Table name</label>
              <select style='width:200px;' id="filterTable"  class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <?php


            foreach ($getArchiveTables as $table) {

              $labelName = '';
              $tableName = $table['table_name'];
              $columnId = 'rec_id';

              if($tableName == 'attendance_list'){
                $labelName = 'Attendance';
                $columnId='rec_id';
              }
              else if($tableName == 'classes_record'){
                $labelName = 'Classes';
                $columnId='class_id';


              } else if ($tableName == 'enrollment_records') {
                $labelName = 'Enrollment';
                $columnId='enrollment_id';


              } else if ($tableName == 'student_record') {
                $labelName = 'Student list';
                $columnId='id';

              } else if ($tableName == 'subject') {
                $labelName = 'Subject';
                $columnId='id';


              } else if ($tableName == 'teacher_profile') {
                $labelName = 'Teacher';
                $columnId='id';


              } else if ($tableName == 'section') {
                $labelName = 'Section';
                $columnId='id';


              } else if ($tableName == 'year') {
                $labelName = 'Grade level';
                $columnId='id';


              } else if ($tableName == 'users') {
                $labelName = 'Accounts';
                $columnId='id';


              } else if ($tableName == 'attendance_record') {
                $labelName = 'Fingerprint';
                $columnId='attendance_id';

              }

       

                $getSelected = $getTableSelected == $table['table_name'] ? 'selected' : '';
           
              ?>
                    <option data-id="<?php echo  $columnId ?>" value="<?php echo $table['table_name'] ?>"  <?php echo $getSelected ?>  >
                     <?php echo $labelName ?>
                    </option>
                    <?php

            }

            ?>
           </select>
          
            </div>
       
    


    <table class="custom-table archieve-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <?php
          foreach ($tableFields as $field) {
            if ($field->type == $getTableSelected) {
              foreach ($field->thead as $thead) {
                echo "<th class='p-2 text-left'>" . $thead . "</th>";
              }
            }
          }
          ?>
        </tr>
      </thead>
      <tbody>

     <tr>
  <?php
  $counter = 0;
      foreach ($getArchiveSpecificTable as $keyList => $archiveItem) {

      $getID = '';
       $tableValue ='';
        $selectedTable = $getTableSelected;

  if ($selectedTable == 'attendance_list') {
    $getID = 'rec_id';
    $tableValue = 'attendance_record_list';
  } else if ($selectedTable == 'classes_record') {
    $getID = 'class_id';
      $tableValue = 'classes_record';

  } else if ($selectedTable == 'enrollment_records') {
    $getID = 'enrollment_id';
    $tableValue = 'enrollment_record';

    } else if ($selectedTable == 'student_record') {
            $getID = 'id';
            $tableValue = 'student_record';

    } else if ($selectedTable == 'subject') {
          $getID = 'id';
      $tableValue = 'subject';

    } else if ($selectedTable == 'teacher_profile') {
      $getID = 'id';
      $tableValue = 'teacher_profile';

    } else if ($selectedTable == 'section') {
          $getID = 'id';
      $tableValue = 'section';

    } else if ($selectedTable == 'year') {
          $getID = 'id';
      $tableValue = 'year';

    } else if ($selectedTable == 'users') {
          $getID = 'id';
      $tableValue = 'users';

    } else if ($selectedTable == 'attendance_record') {
      $getID = 'attendance_id';
      $tableValue = 'fingerprint_enroll';

    }


    $getIdTable = array(
      'id' => $getID,
      'selectedId' => $archiveItem[$getID],
      'table' => $tableValue,
      'data' => $archiveItem,
      'archive_id' => $archiveItem['archive_id'],
    );

    $archiveRecord = json_encode($getIdTable);

    $rchiveDetails = htmlspecialchars(str_replace('\\', '', $archiveRecord));


    foreach ($tableFields as $tableField) {
          if ($tableField->type == $getTableSelected) {
            foreach ($tableField->tbody as $tbody) {


              $type = $tbody['type'];
              $key = $tbody['key'];
              $databaseKey = $tbody['databaseKey'];


              
              if ($key == 'key') {
                ?>
                <tr>
                <td class='p-2'>
                  <?php echo $keyList + 1 ?>
                </td>
                <?php
              } else if ($key == 'field') { 
               ?>
                   <td class='p-2 text-center'>

                      <?php 
                      
                      if($type =='fingerscan'){
                        ?>
                          <span style='display: inline-block; width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
                          <?php echo $archiveItem[$databaseKey] ?>
                                            </span>
                        <?php
                      } else if ($type == 'clockType') {

                                  $clock = $archiveItem[$databaseKey] == 1 ? 'Clock in' : 'Clock out';

                                 
                                  ?>
                                                <span style='display: inline-block; width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
                                          <?php echo $clock ?>
                                                </span>
                       
                                                         <?php

                                }
                                else if ($type == 'time') {

                                  $clockSet = new DateTime($archiveItem[$databaseKey]);
                                  $clockTime = $clockSet->format('h:i A');
                                 
                                  ?>
                                <span style='display: inline-block; width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
                              <?php echo $clockTime ?>
                                </span>
                       
                                             <?php

                                }else if($type == 'date'){

               
                                  $clockDate = $date = date('F d, Y', strtotime($archiveItem[$databaseKey]));
                                    ?>
                                <span style='display: inline-block; width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
                                    <?php echo $clockDate ?>
                                </span>
                       
                                 <?php

                                }else{
                        ?>
                          <?php echo $archiveItem[$databaseKey] ?>
                        <?php
                      }
                      
                      
                    
                      
                      
                      ?>
                      </td>
               <?php
               
              }
              elseif($key== 'restore'){
                ?>
                <td onclick='restoreArchive(<?php echo $rchiveDetails; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'>
              <ion-icon name="refresh-outline"></ion-icon>
              </td>
                <?php
              } elseif ($key== 'delete') {
            ?>
                <td onclick='deleteArchive(<?php echo $rchiveDetails; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon
                name="trash-outline"></ion-icon></td>
              </tr>
               <?php
          } 
            }
          }
        }
      
      }
      ?>
  <tr>

      <?php 
        $totalCount = count($getArchiveList);


      $currenLabel = '';
  

      if ($getTableSelected == 'attendance_list') {
        $currenLabel = 'Attendance';
      } else if ($getTableSelected == 'classes_records') {
        $currenLabel = 'Classes';

      } else if ($getTableSelected == 'enrollment_records') {
        $currenLabel = 'Enrollment';

      } else if ($getTableSelected == 'student_record') {
        $currenLabel = 'Students';

      } else if ($getTableSelected == 'subject') {
        $currenLabel = 'Subject';

      } else if ($getTableSelected == 'teacher_profile') {
        $currenLabel = 'Teacher';

      } else if ($getTableSelected == 'section') {
        $currenLabel = 'Section';

      } else if ($getTableSelected == 'year') {
        $currenLabel = 'Grade level';

      } else if ($getTableSelected == 'users') {
        $currenLabel = 'Accounts';

      } else if ($getTableSelected == 'attendance_record') {
        $currenLabel = 'Fingerprint';
      }

        if($totalCount == 0){
          ?>
            <tr>
              <td colspan='7' class='text-center text-gray-500'>No archive <?php echo strtolower($currenLabel) ?> found</td>
            </tr>
          <?php
        }
      
      ?>

      <tr id='archiveNoResult' class='hidden'>
          <td colspan='7' class='text-center text-gray-500'>No match found</td>
      <tr/>
      

      </tbody>



    </table>

    <!-- printing code -->

    <table class="attendance-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>LRN</th>
          <th class='p-2 text-left'>Clock type</th>
          <th class='p-2 text-left'>Date</th>

          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($getAttendanceList as $keyList => $attendance) {




          ?>
          <tr>

            <td class='p-2'>
              <?php echo $keyList + 1 ?>
            </td>
            <td class='p-2'>
              <?php echo $attendance['attendance_id'] ?>
            </td>
            <td class='p-2'>
              <?php echo $attendance['lrn'] ?>
            </td>
            <td class='p-2'>
              <?php echo $attendance['date_created'] ?>
            </td>

            <td onclick='editattendance(<?php echo $attendanceData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon
                name="create-outline"></ion-icon></td>
            <td onclick='deleteattendance(<?php echo $attendanceData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon
                name="trash-outline"></ion-icon></td>
          </tr>
          <?php
          # code...
        }


        ?>

      </tbody>

    </table>

    <!-- end printing code -->

    <hr />
    <div class='flex justify-end gap-2 pr-5 items-center'>

      <span>
        <button onclick='prevBtn(".attendance-table")'
          class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
      </span>
      <span> |</span>
      <span>
        <button onclick='nextBtn(".attendance-table","attendanceNoResult")'
          class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
      </dv>
    </div>



    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addattendance" data-modal-toggle="addattendance" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
    <div id="archieve-modal" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
      data-modal-backdrop="static">
      <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='closeModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="archieve-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">

          </div>
        </div>
      </div>
    </div>

    <!-- edit modal -->



  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
  integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/archiveFunction.js') ?>'></script> 