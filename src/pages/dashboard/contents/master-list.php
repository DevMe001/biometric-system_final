<div class='master-default'>
  <!-- wrapper  filter-->
<div class='w-full mx-auto'>
  <!-- filter search -->

  <div class='w-[80%] flex justify-between items-center gap-5 mx-auto no-print'>
    <!-- sort -->
    <div>
      <?php require_once(__DIR__ . '/widget/widget.php'); ?>
      <!-- <p class='text-md text-gray-500 font-bold'>Sort <span class='btn btn-blue-500 p-2'>▼</span></p> -->
    </div>
    <!-- search -->
    <div class="search focus:outline focus:outline-offset-2 focus:outline-1 focus:outline-blue-500 focus:rounded">
      <label>
        <input id='masterListRecSearchEl' type="text" placeholder="Search here">
        <ion-icon name="search-outline"></ion-icon>
      </label>
    </div>
    <!-- print -->
    <!-- <div>
      <button id='masterListRecPrint'
        class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
    </div> -->

    <a href="?page=registration"
      class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
      <button class='text-center py-3 font-bold text-md'>+</button>
  </a>
  </div>


</div>





  <!-- wrapper for table  need to use grid-->
  <div class='w-full mx-auto bg-white-500 shadow rounded mt-10 overflow-x-auto'>


     <input type="hidden"  name="schoolYear" id='schoolYear' value=<?php echo $schoolYear ?>>
    <!-- <div class="absolute bottom-20 right-20">

       <div class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
       </div>
      </div> -->

<form method="post" action="" id="myForm">
    <input type="hidden" name="getRecentYear" id="getRecentYear" value="<?php echo date('Y') ?>">
  <!-- Other form elements go here -->
</form>


      <?php

      $getUniqueYear = array();

      foreach ($getMasterStudentRecord as $key => $value) {
        if (!array_key_exists($value['yearCreated'], $getUniqueYear)) {
          $getUniqueYear[$value['yearCreated']] = $value['yearCreated'];
        }
      }

      ksort($getUniqueYear);

      $distinctYear = array_values($getUniqueYear);

      $getUniqueSection = array();


      if (count($distinctYear) > 1) {

        ?>
          
           <div id='filterPerYear' class="flex justify-end item-center gap-4 mb-4">
              <label for="getRecYearly" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">Year</label>
              <select style='width:200px;' id="getRecYearly"  class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <?php


            foreach ($distinctYear as $getPerYear) {

              $getReqYear = '';

              if (isset($_GET['filteredYear'])) {
                $getReqYear = $_GET['filteredYear'];
              }

              $getYearSelected = $getPerYear == $getReqYear ? 'selected' : '';

              ?>
                          <option value="<?php echo $getPerYear ?>"  <?php echo $getYearSelected ?> >
                            <?php echo $getPerYear ?>
                          </option>
                          <?php

            }

            ?>
                  </select>
          
                </div>
            <?php
      }

      ?>



      

    <table class="custom-table student-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2 w-full">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Registered #</th>
          <th class='p-2 text-left'>Lrn</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Name</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Address</th>
          <th colspan="3" class='p-2 text-center'>Action</th>
         
       
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
    <?php

    if ($totalStudents > 0) {
      ?>
             <tbody>


            <?php

            foreach ($getMasterStudentRecord as $secKey => $rec) {

            
              $getFilterYEar = isset($_GET['filteredYear']) ? $_GET['filteredYear'] : date('Y',strtotime($rec['date_created']));

              $details = array(
                'dateRegistered' => date('F d, Y', strtotime($rec['date_created'])),
                'data'=> $rec
              );

              $studentsRecord = json_encode($details);

              $studentRecData = htmlspecialchars(str_replace('\\', '', $studentsRecord));

              if ($rec['yearCreated'] == $getFilterYEar) {
                
                $deleted = $rec['is_archive'];
                  if($deleted == 0){
                    ?>
                               <tr>
        
                            <td class='p-2'>
                              <?php echo $secKey + 1 ?>
                                        </td>
                                        <td class='p-2'>
                                          <?php echo $rec['ref_number'] ?>
                                        </td>
                                        <td class='p-2'>
                                          <?php echo strtoupper($rec['id']) ?>
                                        </td>
                  
                                          <td >
                                              <label class='cursor-pointer' for='onProfileUpdate_<?php echo $rec['id']; ?>'>
                                                        <img class='rounded object-cover' id='cutomStyleImg'
                                                          src="<?php echo baseUrlImageSrc('uploads/profile/' . $rec['profile']) ?>" alt="profile" />
                                                      </label>
                                              
                                                      <input onchange="onUpdateProfile(event, <?php echo $studentRecData ?>)" type="file"
                                                        id='onProfileUpdate_<?php echo $rec['id']; ?>' class="hidden" accept="image/*">
                                      
                                                </td>
                                                                                        <td class='p-2'>
                                          <?php echo strtoupper($rec['lname']) . ' ' . strtoupper($rec['fname']) . ' ' . strtoupper($rec['mname']) ?>
                                        </td>
                                        <td class='p-2'>
                                          <?php echo $rec['gender'] ?>
                                        </td>
                                        <td class='p-2'>
                                          <?php echo $rec['age'] ?>
                                        </td>
                                        <td class='p-2'>
                                          <?php echo strtoupper($rec['currentAddress']) ?>
                                        </td>
                              
                                        <!-- <td onclick='editMasterListRec(<?php echo $studentRecData; ?>)'
                                          class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="create-outline"></ion-icon>
                                        </td> -->
                                        <td onclick='studentMasterListMoveToArchive(<?php echo $studentRecData; ?>)'
                                          class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="archive-outline"></ion-icon></td>
                              
                                        <td id='viewMainList' onclick='viewStudentMasterList(<?php echo $studentRecData; ?>)' clas='cursor-pointer'><ion-icon name="eye-outline"></ion-icon></td>
                              
                                      </tr>
                    <?php
                  }
                ?>
                             

                            <?php
              }


              ?>
          
                      <?php
              # code...
            }


            ?>
        
        
                <!-- create center no match found -->
                <tr id='studentRecNoResult' class='hidden'>
                  <td colspan='7' class='text-center text-gray-500'>No match found</td>
                   </tr>
              </tbody>
 
        <?php
    } else {

      ?>
          <tbody>
              <tr id='studentRecNoResult'>
                  <td colspan='7' class='text-gray-500 font-semibold'>No match found!</td>
              </tr>
          </tbody>
      
        <?php
    }

    ?>


    </table>

    <!-- printing code -->


    <table class="student-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Lrn</th>
          <th class='p-2 text-left'>Name</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Birthdate</th>
          <th class='p-2 text-left'>Address</th>
          <th class='p-2 text-left'>Section</th>
          <th class='p-2 text-left'>Gen.Ave</th>
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($getMasterStudentRecord as $key => $rec) {


        
          ?>
              <tr>
                  <td class='p-2'>
                  <?php echo $key + 1 ?>
                    </td>
                    <td class='p-2'>
                      <?php echo $rec['lrn'] ?>
                    </td>
                   <td class='p-2'>
                      <?php echo $rec['fullName'] ?>
                    </td>
                      <td class=''>
                        <img class='rounded-full object-cover'  id='customStyleImgPrint' src="<?php echo baseUrlImageSrc('uploads/profile/' . $rec['profile']) ?>" alt="profile">
                      </td>
                      <td class='p-2'>
                      <?php echo $rec['gender'] ?>
                    </td>
                    <td class='p-2'>
                      <?php echo $rec['age'] ?>
                    </td>
                    <td class='p-2'>
                      <?php echo $rec['birthdate'] ?>
                    </td>
                    <td class='p-2'>
                      <?php echo $rec['currentAddress'] ?>
                    </td>
                     <td class='p-2'>
                      <?php echo $rec['sectionName'] ?>
                      </td>
                      <td class='p-2'>
                      <?php echo $rec['gwa'] ?>
                    </td>
                    <td
                  </tr>
              <?php
          # code...
        }


        ?>

      </tbody>

    </table>



<?php

if ($totalEnroll > 0) {
  ?>
      <hr />
      <div class='flex justify-end gap-2 pr-5 items-center no-print'>

        <span>
          <button onclick='prevBtn(".student-table")' class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
        </span>
        <span> |</span>
        <span>
          <button onclick='nextBtn(".student-table","masterListRecNoResult")'
            class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
        </span>
        </dv>
      </div>
      <?php
}


?>



    <!-- end printing code -->





    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addSubject" data-modal-toggle="addSubject" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->





  </div>
</div>


<div class='master-view hidden'>
     <?php include('master-list-view.php') ?>
</div>