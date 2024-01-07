<style>
  #qr-canvas-visible{
    height: 100px !important;
  }

  .bottom-border01{
    border-bottom: 1px solid #000;
  }

  .bottom-border02{
    border-bottom: 1px solid #7e7e7e;
  }


  .bottom-border03{
    border-bottom: 1px solid #eaeaea;
  }

  
  .all-border01{
    border: 1px solid #000;
  }
</style>




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
        <input id='enrollListRecSearchEl' type="text" placeholder="Search here">
        <ion-icon name="search-outline"></ion-icon>
      </label>
    </div>
    <!-- print -->
    <!-- <div>
      <button id='studentRecPrint'
        class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
    </div> -->

    <div id='onModalStudentRecToggle' data-modal-target="studentRecord-modal" data-modal-toggle="studentRecord-modal"
      class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
      <button class='text-center py-3 font-bold text-md'>+</button>
    </div>
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

      foreach ($enrollmentRecord as $key => $value) {
        if (!array_key_exists($value['yearEnrolled'], $getUniqueYear)) {
          $getUniqueYear[$value['yearEnrolled']] = $value['yearEnrolled'];
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
  

    <table class="custom-table enroll-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2 w-full">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Registered Number</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Name</th>
          <th class='p-2 text-left'>Section</th>
          <th class='p-2 text-left'>Grade Level</th>
     
          <th colspan="3" class='p-2 text-center'>Action</th>
         
       
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
    <?php

    if ($totalEnroll > 0) {
      ?>
           <tbody>


          <?php

          foreach ($enrollmentRecord as $secKey => $rec) {


            $getFilterYEar = isset($_GET['filteredYear']) ? $_GET['filteredYear'] : date('Y',strtotime($rec['date_enrolled']));


            $studentsRecord = json_encode($rec);

            $studentRecData = htmlspecialchars(str_replace('\\', '', $studentsRecord));

            if ($rec['yearEnrolled'] == $getFilterYEar) {
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
                  
                            <td class=''> 
                              <img class='rounded object-cover' id='cutomStyleImg'
                                src="<?php echo baseUrlImageSrc('uploads/profile/' . $rec['profile']) ?>" alt="profile">
                            </td>
                  
                            <td class='p-2'>
                              <?php echo strtoupper($rec['fullName']) ?>
                            </td>
                  
                  
                  
                            <td class='p-2'>
                              <?php echo strtoupper($rec['sectionName']) ?>
                            </td>
                            <td class='p-2'>
                              <?php echo strtoupper($rec['yearLevel']) ?>
                            </td>
                  
                            <td onclick='editStudentRec(<?php echo $studentRecData; ?>)'
                              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="create-outline"></ion-icon>
                            </td>
                            <td onclick='enrollmentMoveToArchive(<?php echo $studentRecData; ?>)'
                              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="archive-outline"></ion-icon></td>
                  
                            <!-- <td><ion-icon name="eye-outline"></ion-icon></td> -->
                  
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
              <tr id='enrollRecNoResult' class='hidden'>
                <td colspan='11' class='text-center text-gray-500'>No match found</td>
             </tr>
            </tbody>
 
      <?php
    } else {

      ?>
        <tbody>
            <tr id='enrollRecNoResult'>
                <td colspan='11' class='text-gray-500 font-semibold'>No match found!</td>
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
          <th class='p-2 text-left'>Registered Number</th>
          <th class='p-2 text-left'>Name</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Birthdate</th>
          <th class='p-2 text-left'>Address</th>
          <th class='p-2 text-left'>Section</th>
      
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($enrollmentRecord as $key => $rec) {



          ?>
            <tr>
                <td class='p-2'>
                <?php echo $key + 1 ?>
                  </td>
                  <td class='p-2'>
                    <?php echo $rec['ref_number'] ?>
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
        <button onclick='nextBtn(".student-table","studentRecNoResult")'
          class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
      </dv>
    </div>
    <?php
}


?>



    <!-- end printing code -->


<div>
    <?php
    $sectionListArray = array();

    if (count($sections) > 0) {
        foreach ($sections as $rec) {
            // Convert each section record to JSON
            $sectionRec = json_encode($rec);

            // Append the JSON string to the array
            $sectionListArray[] = $sectionRec;

        }
    }
    ?>

    <input type="hidden" id='getListSections' value="<?php echo htmlspecialchars(json_encode($sectionListArray)); ?>" />
</div>



    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addSubject" data-modal-toggle="addSubject" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
    <div id="studentRecord-modal" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" data-modal-backdrop="static">
      <div id='modal-container1' class="relative w-full max-w-md mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='studentRecCloseModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="studentRecord-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8 no-print">
           
            <form id='studentRecordForm' class="space-y-6" enctype='multipart/form-data no-print' >
                    <input type="hidden" name='studentId'  id='studentId'>
                    <input type="hidden" name='yearId'  id='yearId'>
                    <input type="hidden" name='receiptId'  id='receiptId'>
                    <input type="hidden" name='submitId'  id='submitId'>
                    <input type="hidden" name='paymentFee'  id='paymentFee'>
                    <input type="hidden" name='oldProfile'  id='oldProfile'>
           

         <fieldset>
              <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white"><span id='studentRecTitle'>Enrollment form</span>
              </h3>
                  <div class='flex justify-end w-full'>
                          <label class='text-indigo-500 font-medium text-sm cursor-pointer' for="scanBarcode">Scan Bar Code</label>
                          <input class="hidden" type="file" name="scanBarcode" id="scanBarcode" accept="image/*">

                         
                        </div>
                          <div id="reader"></div>
                    <div id="searchRegisterNumber">


                     <div>
                       
                        <label for="searchLrn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Registration Number</label>
                        <input type="search" name="searchRegNumber" id="searchRegNumber" class="text-center my-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Register Number" required>
                      
                    </div>
                    
                    <button id='searchBtnRefNumber' type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                  
                   </div>
          </fieldset>


          <!-- addd section -->
         <fieldset>
             <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white text-center"><span id='studentRecTitle'>Enrollment form</span>
              </h3>
          <div>
          <p><span class="font-medium my-2">Selected Grade level:</span> <span class="bottom-border01" id='getSelectedYearLevel'>8</span></p> 
         </div>
              <div id='newDivSection'>
                          <label for="newSection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Available section<span class="font-medium text-sm text-red-500" id='msgSection'></span></label>
                          <select style='width:100%' id="newSection" name='newSection' class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                          </select>

           </div>

            <div class="flex justify-between items-center mt-5">
            <button id='prev-button__1' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
            <button id='next-button__1'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
            <button id='ediTable' type="submit"  class="hidden w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
          </div>
        
         </fieldset>

          <!-- end section -->
        
    <!-- biometric part -->
    
           <fieldset id='bimetricScan' class="hidden skipFieldset">
               <div class="p-5"> 
                  <div id='checkDevice' class='max-w-auto bg-white mx-auto h-auto'>

                            <di class='flex flex-col justify-center items-center h-full'>
                              <div id='loader' class='mb-5 hidden' role="status">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                  viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                  <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                              </div>
                              <button onclick='validateConnection()'
                                class='text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>Check
                                the device</button>
                          </div>

                 </div> 

                 


                   <div id='beginEnroll' class='hidden'>



                  <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white text-center"><span id='attendaceTitle'>Biometric</span> fingerprint
                 scanner
                 </h3>
                  
                    <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                  <li>
                      <span class="text-gray-900 dark:text-white">Make sure scan your fingerprint accurately.</span>
                  </li>
                   <li>
                      <span class="text-gray-900 dark:text-white">Place your finger properly to get accurate result </span>
                  </li>
                  
                
                  </ol>

                   <div id='getFingerImage' class='flex flex-row justify-center gap-2 items-center h-full my-3'></div>
<!-- 
                    <div id="fingerscanner" class="fingerprint-container">
                      <div class="fingerprint-scanner flex justify-center items-center h-full ">
                      </div>

                    </div> -->

                      <div class="fingerprint__border max-w-full gap-20 mx-auto">

                      <div class="flex flex-col justify-center items-center h-full text-">
                        <div
                          class="flex flex-col justify-center items-start h-full gap-20 shadow-1">
                          <div class='relative p-5 z-20 w-[150px] h-full relative flex justify-center align-center'>
                        <img class="max-w-[16rem] max-h-[16rem] relative z-10 relative" src="<?php echo baseUrlImageSrc('biometric.png') ?>" alt="">
                                    <div id='fingerscanner'
                                class='overlay-box absolute w-[88px] h-[135px] rounded-full z-30 bg-[rgba(0,0,0,0.13)] hidden'></div>
                            </div>
                          </div>
                      
                      
                        </div>
                      
                      
                      </div>

               

                   </div>
                     <div id='biometricDone' class="flex justify-between items-center mt-5 hidden">
                     <button id='prev-button__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__2'  data='last_record' type="submit" class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

      </fieldset>

    <!-- end biomertric part -->







        <!-- type of enrollment -->
          <fieldset>
             <div class="flex flex-col flex-wrap">
                   
            <!-- view of all list -->
            <div class="flex justify-between item-center flex-wrap">
              <!-- profile -->
              <div class="hidden md:block">
             
                <img style="width:150px;height:150px;max-width:100%; object-fit:cover;" id="getProfile"  src="<?php echo baseUrlImageSrc('uploads/profile202356607156.jpg') ?>" class="" alt=" Logo">
              </div>
              <div class="flex flex-col justify-center items-center flex-wrap">
                <p class="font-medium text-lg md:text-xl text-center">HARVESTERS' MISSIONS INTERNATIONAL SCHOOL</p>
                <p class='font-semibold text-base'>S.E.C. Reg. No. A200005355</p>
                <p class='font-semibold text-base'>Government Recognition No. E. 061-S.2002</p>
                <p class='font-semibold text-base'>Government Recognition No. S. 023 S.2005</p>
                <p class='font-semibold text-base'>Purok 3 Longos, Calumpit, Bulacan. Philippines 3000</p>
                <p class='font-semibold text-base'>Telephone No. 044 -896-3545/</p>
                <p><strong>Email: </strong>harvesters_internationalph@yahoo.com</p>
              </div>

              <div class="hidden md:block">
                <img src="<?php echo baseUrlImageSrc('logo.png') ?>" width='150' height="150" class="rounded" alt=" Logo" />
              </div>
              
            </div>


        <div class="flex justify-between items-start mt-10 flex-wrap">
        <div>
         <p><span class="font-medium">Registration #:</span> <span id='getRefNumber' class="bottom-border01">Reg202023345345</span></p> 
         <p><span class="font-medium">Lrn:</span> <span id='getLrn' class="bottom-border01"> 345345435345345</span></p> 
       <div class="flex gap-2">
          <p><span class="font-medium">Level:</span> <span id='getGradeLevel' class="bottom-border01"> Grade 7</span></p> 
         <p><span class="font-medium">Section:</span> <span id='getSection' class="bottom-border01"> C </span></p> 
       </div>
        </div>
        <legend class="font-medium text-xl">Registered Form</legend>
        <div>
         <p><span class="font-medium">Date registered:</span> <span id='getDateRegistered' class="bottom-border01">December 15 2023</span></p> 

        </div>
        </div>

          <div class="my-2">
              <small>Please be advised that the above information shall be used in relation to the aforementioned protocols in accordance with the Data Privacy Act of 2012</small>
          </div>
        <!-- list of form inputted -->
        <div class="all-border01 flex flex-col items-start p-5 mt-2 gap-4 flex-wrap">
          <small class="mb-1 font-medium">Applicant's Personal Details:</small>

<!-- personal info -->
        <div class="bottom-border02 w-full">
          <small>Personal Details</small>
        </div>

          <div class="flex justify-between gap-4 flex-wrap">
          <div class="flex justify-start">
              <p><span class="font-medium">Legal Name: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getFullName'>Dev Me Perl</p>
      
          </div>
          
          <div class="flex justify-start">
              <p><span class="font-medium">Date of birth: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getBdate'>December</p>
      
          </div>


          <div class="flex justify-start">
              <p><span class="font-medium">Gender: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getGender'>Male</p>
      
          </div>

         
          </div>

        <!-- end personalinfo -->
       
          

  <!-- location -->
         <div class="flex justify-between gap-4 flex-wrap">
          <div class="flex justify-start">
              <p><span class="font-medium">Place of birth: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getPlace'>Caloocan City</p>
      
          </div>
          
          <div class="flex justify-start">
              <p><span class="font-medium">Current address: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getAddress'>Caloocan City</p>
      
          </div>


          <div class="flex justify-start">
              <p><span class="font-medium">Nationality: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getNationality'>Filipino</p>
      
          </div>

         
          </div>

        <!-- end location -->
         

          <!-- students -->
         <div class="flex justify-between gap-4 flex-wrap">
          <div class="flex justify-start">
              <p><span class="font-medium">Student's number: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getStudentNumber'>09453423421</p>
      
          </div>
          
          <div class="flex justify-start">
              <p><span class="font-medium">Student's email: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getStudentEmail'>biometric@edu.ph</p>
      
          </div>


          <div class="flex justify-start">
            
          </div>

         
          </div>
        <!-- end students -->

      <div id='getParentDetails' class="hidden">
        
        <div class="bottom-border02 w-full my-2">
          <small>Father's's Details</small>
        </div>
          <!-- father info -->

         <div class="flex justify-between gap-4 flex-wrap">
          <div class="flex justify-start">
              <p><span class="font-medium">Father's Name: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getFatherName'>Mando Melvin</p>
      
          </div>
            <div class="flex justify-start">
              <p><span class="font-medium">Father's occupation: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getFatherOccupation'>Driver</p>
      
          </div>
          <div class="flex justify-start">
              <p><span class="font-medium">Father's email: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getFatherEmail'>father@gm.vf</p>
      
          </div>


       

         
          </div>


             <div class="flex justify-between gap-4 flex-wrap">
      
          <div class="flex justify-start">
              <p><span class="font-medium">Father's number: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getFatherNumber'>09454563234</p>
      
          </div>

           <div class="flex justify-start">
              <p><span class="font-medium">Father's address: </span></p>
              <p style="word-spacing: 10px;" class="bottom-border01 text-center px-2" id='getFatherAddress'>Callocan City</p>
      
          </div>

         
          </div>



        <!-- end father -->
    
         
        <div class="bottom-border02 w-full my-2">
          <small>Mother's Details</small>
        </div>

        <!-- mother  -->
                <!-- father info -->

         <div class="flex justify-between gap-4 flex-wrap my-2">
          <div class="flex justify-start">
              <p><span class="font-medium">Mother's Name: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getMotherName'>Mando Melvin</p>
      
          </div>
            <div class="flex justify-start">
              <p><span class="font-medium">Mother's occupation: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2"  id='getMotherOccupation'>Driver</p>
      
          </div>
          <div class="flex justify-start">
              <p><span class="font-medium">Mother's email: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getMotherEmail'>Mother@gm.vf</p>
      
          </div>


       

         
          </div>


       <div class="flex justify-between gap-4 flex-wrap my-2">
      
          <div class="flex justify-start">
              <p><span class="font-medium">Mother's number: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getMotherNumber'>09454563234</p>
      
          </div>

           <div class="flex justify-start">
              <p><span class="font-medium">Mother's address: </span></p>
              <p style="word-spacing: 10px;" class="bottom-border01 text-center px-2" id='getMotherAddress'>Callocan City</p>
      
          </div>

         
          </div>
      </div>



      <div id='guardianDetails' class='hidden'>
    

        <!-- end mother -->
             <div class="bottom-border02 w-full">
          <small>Guardian's Details</small>
        </div>
        <!-- guardian  -->
      

           <div class="flex justify-between gap-4 flex-wrap">
          <div class="flex justify-start">
              <p><span class="font-medium">Guardian's Name: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getGuardiansName'>Mando Melvin</p>
      
          </div>
            <div class="flex justify-start">
              <p><span class="font-medium">Guardian's occupation: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getGuardiansOccupation'>Driver</p>
      
          </div>
          <div class="flex justify-start">
              <p><span class="font-medium">Guardian's email: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getGuardiansEmail'>Guardian@gm.vf</p>
      
          </div>


       

         
          </div>



          
             <div class="flex justify-between gap-4 flex-wrap">
      
          <div class="flex justify-start">
              <p><span class="font-medium">Guardian's number: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getGuardiansNumber'>09454563234</p>
      
          </div>

           <div class="flex justify-start">
              <p><span class="font-medium">Guardian's address: </span></p>
              <p style="word-spacing: 10px;" class="bottom-border01 text-center px-2" id='getGuardiansAddress'>Callocan City</p>
      
          </div>

         
          </div>

      </div>


        <!-- end father -->
    
         <!-- end guardian -->

        <div class="bottom-border02 w-full">
          <small>Incase of emergency</small>
        </div>
            <!-- incase of emergency -->
        

         <div class="flex justify-between gap-4 flex-wrap">
          <div class="flex justify-start">
              <p><span class="font-medium">Contact Name: </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getContactName'>Mando Melvin</p>
      
          </div>
            <div class="flex justify-start">
              <p><span class="font-medium">Relationship: </span></p>
              <p style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2" id='getRelationship'>Parent</p>
      
          </div>
          <div class="flex justify-start">
              <p><span class="font-medium">Contact Number : </span></p>
              <p style="word-spacing: 30px;" class="bottom-border01 text-center px-2" id='getContactNumber'>09435345345</p>
      
          </div>


          </div>

  
      
            
    
         <!-- end incase of emergency  -->
          <div class="bottom-border02 w-full">
                    <small>Submitted document (<strong id='getTypeSubmittedDocument'>Local</strong>)</small>
        </div>


         <!-- submitted document -->

         <div id='getLocalType' class="flex justify-between gap-2 flex-wrap"> </div>
        <!-- end local -->


        <!-- foreign -->
            <div id="getForeignType" class='flex justify-between gap-2 flex-wrap'></div>
        <!-- end foreign -->

        <!-- end submitted document -->
       <div class="bottom-border03 w-full"></div>


        <!-- fee -->
         <div class="flex gap-2 justify-around w-full">

          
          <div class="flex gap-2">

            <div class="w-auto my-2">
            <div>
                  <p class='text-left mb-1'><span class="font-medium" >Miscellanious fee</span> <span id='getMiscellanious' clas='font-medium'>₱10,045.00</span></p>
              <p class='text-left mb-1'><span class="font-medium" >Books and Modules</span> <span id='getBooks' clas='font-medium'>₱5,905.00</span></p>
              <p class='text-left mb-1'><span class="font-medium" >Tuition fee</span> <span id='getTuition' clas='font-medium'>₱15,000.00</span></p>
              <p class='text-left mb-1'><span class="font-medium" >Total</span> <span id='getTotal' clas='font-medium'>₱30,950</span></p>
            </div>
              <div class="mt-4">
                <p class='text-left'><span class="font-medium" >Full cash payment</span> <span id='getFullPayment' clas='font-medium'>₱29,450</span></p>
              </div>

            </div>
         
                
         </div>

          <div class="flex gap-2 w-6/12">

            <div class="w-full mx-auto my-2">
              <div class="flex flex-col justify-between items-center shadow-md p-5">
              <p class="text-center font-bold">Discount granted</p>
              <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'> 25%</span></p>
              <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'> 15%</span></p>
              <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
              <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
              </div>
            </div> 
                
         </div>

        <!-- end fee -->




          </div>

            <div class="flex justify-end items-center gap-2 mt-5 w-full">
                     <button id='prev-button__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__3' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>

        </div>
            <!-- end view list -->
            


          </fieldset>



            

    </form>

           

          </div>
        </div>
      </div>
    </div>

    <!-- edit modal -->

    <!-- print receipt -->



                 <div  class="receipt-print hidden border-2 p-5">
                        <legend class='text-center font-semibold text-xl'>Enrollment Fee<span id='typeAvail'></span></legend>
                   
                 <div class="flex gap-2 justify-center">

                  <div class="w-[50%] my-2">
                    <p class='text-left'><span class="font-medium" is='syYearPrint'>SY:2022-2023</span> <span clas='font-medium' id='typeFeePrint'>(INTERMIDIATE)</span></p>
                    <p class='text-left'><span class="font-medium">Name:</span> <span clas='font-medium' id='fLNamePrint'>Ronaldo Marzo</span></p>
                  </div>
                  <div class="w-4/12 my-2">
                    <p class='text-left'><span class="font-medium">Section</span> <span clas='font-medium'id='getSelectedSectionPrint'> Grade 7C</span></p>
                    <p class='text-left'><span class="font-medium">Issued Date:</span> <span clas='font-medium' id='getDateIssuedPrint'>11-03-2023</span></p>
                  </div> 
                
                 </div>


                <div class="flex gap-2 justify-center items-center">

                  <div class="w-[50%] my-2">
                  <div class="flex flex-col justify-between gap-2 items-start">
                    <div class="grid grid-cols-2 gap-4">
                   <p class="font-medium">Miscellanious fee</p> 
                   <p clas='font-medium' id='miscPrint'>₱10,045.00</p>
                   <p class="font-medium">Books and Modules</p> 
                   <p clas='font-medium' id='booksPrint'>₱5,905.00</p>
                   <p class="font-medium" >Tuition fee</p> 
                   <p style="border-bottom: 1px solid #000;" clas='font-medium' id='tuitionPrint'>₱15,000.00</p>
                   <p class="font-medium">Total</p> 
                   <p clas='font-medium' id='totalPrint'>₱30,950</p>  
                    </div>
                  </div>
                   <div class="mt-4">
                     <p class='text-left'><span class="font-medium">Full cash payment</span> <span clas='font-medium' id='fullPrint'>₱29,450</span></p>
                   </div>

                    <div class="mt-2">
                     <p class='text-left text-sm italic'><span class="font-medium">Note:</span> Show this receipt to registrar for confirmation</p>
                   </div>
                  </div>
                  <div class="w-[50%] mx-auto my-2">
                    <div class="flex flex-col justify-between items-center py-5">
                    <p class="text-center font-bold">Discount granted</p>
                    <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'> 25%</span></p>
                    <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'> 15%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    </div>
                  </div> 
                
                 </div>

                  
             </div>       


<!-- end print receipt -->



<!-- modal for old user-->


<!-- Modal toggle -->
<button id='oldUserModal' data-modal-target="old-user-modal" data-modal-toggle="old-user-modal" class="invisible block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">

</button>

<!-- Main modal -->
<div id="old-user-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div id='modal_reg-container' class="relative w-full max-w-md max-h-full" data-modal-backdrop="static">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="old-user-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Enroll regular students</h3>

                <!-- search lrn exist -->
              


                <form id='studentRegularForm' class="space-y-6" action="#">
                  <input type="hidden" name="userStudentId" id='userRegularId'>
                   <input type="hidden" name="enrollmentId" id='enrollmentId'>
                  <input type="hidden" name="regFullName" id='regFullName'>
                  <input type="hidden" name="endSchoolYear" value='<?php echo $endDate ?>'>
                   <input type="hidden" name="startSchoolYear" value='<?php echo $startDate ?>'>
               
                  

                   <div id="searchFilterLrn">
                     <div>
                        <label for="searchLrn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Learning Referrence Number</label>
                        <input type="number" name="searchLrn" id="searchLrn" maxlength="12" class="text-center my-5 limitLength disabled-key uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="LRN" required>
                      
                    </div>
                    
                    <button id='searchBtn' type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                  
                   </div>
             
                 <fieldset class="my-fieldset">
                    <div class="mb-2">
                        <label for="gwa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous Grade</label>
                        <input type="number" name="gwa" id="gwaPrev" maxlength="2" class="text-center limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                      <div class="flex justify-end items-center gap-2 mt-5">
                     <button id='prvBtn__1' type="button" class="hidden w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__1' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                 </fieldset>

                      <fieldset class="my-fieldset">
                    <div id='chooseTypeEnroll'>
                         
                          <label for="enrollType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student type</label>
                          <select id="enrollType" name='enrollType' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                          $getUniqueType = array();

                          foreach ($yearLevel as $studentType) {

                            if (!array_key_exists($studentType['type'], $getUniqueType)) {
                              $getUniqueType[$studentType['type']] = $studentType['type'];
                            }


                          }

                          // Sort the unique records numerically in ascending order
                          ksort($getUniqueType);

                          $getTypeUnique = array_values($getUniqueType);

                          foreach ($getUniqueType as $type) {

                            $getType = '';


                            if ($type == 1) {
                              $getType = 'Elementary';
                            } elseif ($type == 2) {
                              $getType = 'Junior HighSchool';
                            } elseif ($type == 3) {
                              $getType = 'Senior HighSchool';
                            }


                            ?>
                              
                              <option value="<?php echo $type ?>"> <?php echo $getType ?></option>
                        



                              <?php

                          }


                          ?>
                          </select>

                    </div>

      <!-- grade-->

              
                     <div class="flex justify-between items-center mt-5">
                     <button id='prvBtn__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__2'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

                </fieldset>
                <fieldset class="my-fieldset">
                     <div id='regGradeLevel'>
                          <label for="regLevel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your next grade level</label>
                          <select id="regLevel" name='regLevel' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                          </select>

                    </div>

                     <div id='newRegDivSection'>
                          <label for="newRegSection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose grade level</label>
                          <select style='width:100%' id="newRegSection" name='newRegSection' class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <?php

                        foreach ($sections as $section) {

                          ?>
                                  <option value="<?php echo $section['id'] ?>">
                                    <?php echo $section['name'] ?>
                                  </option>
                                  <?php

                        }

                        ?>
                          </select>

                    </div>

                     <div class="flex justify-between items-center mt-5">
                     <button id='prvBtn__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__3'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                
                </fieldset>
                  <fieldset class="my-fieldset">
                          <legend>Student's Credentials</legend>

                  
              
                       <label for="regCredentialType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credential's type</label>
                      <select id="regCredentialType" name='regCredentialType' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose</option>
                            <option value="local">LOCAL</option>
                            <option value="foreign">FOREIGN</option>  
                      </select>


                      <div id='regularLocal' class='hidden'>

                      <div class="mt-4">
                        <input type="checkbox" name="reg_report_card" id="reg_report_card" class='regLocal'><label class='ml-4' for="reg_report_card">Report Card</label>
                      </div>
                      <div>
                        <input type="checkbox" name="reg_formsf10" id="reg_formsf10" class='regLocal'><label class='ml-4' for="reg_formsf10">Form 137 /SF10</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_birthcert" id="reg_birthcert" class='regLocal'><label class='ml-4' for="reg_birthcert">Birth Certificate</label>
                      </div>


                      <div>
                        <input type="checkbox" name="reg_cert_gmoral" id="reg_cert_gmoral" class='regLocal'><label class='ml-4' for="reg_cert_gmoral">Certificate of good moral</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_med_cert" id="reg_med_cert" class='regLocal'><label class='ml-4' for="reg_med_cert">Medical Certificate</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_let_rec" id="reg_let_rec" class='regLocal'><label class='ml-4' for="reg_let_rec">Letter of Recommendation</label>
                      </div>

                      </div>

                      <div id='regularForeign' class='hidden'>

                      <div class="mt-4">
                        <input type="checkbox" name="reg_study_permit" id="reg_study_permit" class='regForeign'><label class='ml-4' for="reg_study_permit">Study Permit</label>
                      </div>
                      <div>
                        <input type="checkbox" name="reg_alien_card" id="reg_alien_card" class='regForeign'><label class='ml-4' for="reg_alien_card">Alien Cerfication of REG,ACR,CARD</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_passport" id="reg_passport" class='regForeign'><label class='ml-4' for="reg_passport">Passport copy</label>
                      </div>


                      <div>
                        <input type="checkbox" name="reg_auth_rec" id="reg_auth_rec" class='regForeign'><label class=' ml-4' for="reg_auth_rec">Authenticated School Records</label>
                      </div>

                     

                    
                    </div>

                   <div class="flex justify-between items-center mt-5">
                     <button id='prvBtn__4' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__4' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                </fieldset>

                <fieldset class="my-fieldset">
                        <legend class='text-center font-semibold text-xl'>Enrollment Fee(Regular)</legend>
                       <div class='flex justify-end items-center '>
                         <p id='printRegReceipt' class="cursor-pointer text-indigo my-2 btn outline outline-offset-2 outline-1 hover:bg-blue-700 hover:text-white p-2 text-indigo-500">Print receipt</p>
                       </div>
                 <div class="flex gap-2 justify-center">

                  <div class="w-7/12 my-2">
                    <p class='text-left'><span id='reg_syYear' class="font-medium">SY:2022-2023</span> <span id='typeFee' clas='font-medium'>(INTERMIDIATE)</span></p>
                    <p class='text-left'><span class="font-medium">Name:</span> <spa id='reg_fLName'n clas='font-medium'>Ronaldo Marzo</span></p>
                  </div>
                  <div class="w-4/12 my-2">
                    <p class='text-left'><span class="font-medium">Level:</span> <span id='reg_getSelectedSection' clas='font-medium'> Grade 7C</span></p>
                    <p class='text-left'><span class="font-medium">Issued Date:</span> <span clas='font-medium' id='reg_getDateIssued'>11-03-2023</span></p>
                  </div> 
                
                 </div>


                <div class="flex gap-2 justify-center">

                  <div class="w-6/12 my-2">
                  <div>
                       <p class='text-left mb-1'><span class="font-medium" >Miscellanious fee</span> <span id='reg_misc' clas='font-medium'>₱10,045.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Books and Modules</span> <span id='reg_books' clas='font-medium'>₱5,905.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Tuition fee</span> <span id='reg_tuition' clas='font-medium'>₱15,000.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Total</span> <span id='reg_total' clas='font-medium'>₱30,950</span></p>
                  </div>
                   <div class="mt-4">
                     <p class='text-left'><span class="font-medium" >Full cash payment</span> <span id='reg_full' clas='font-medium'>₱29,450</span></p>
                   </div>

                    <div class="mt-2">
                     <p class='text-left text-sm italic'><span class="font-medium">Note:</span> Show this receipt to registrar for confirmation</p>
                   </div>
                  </div>
                  <div class="w-6/12 mx-auto my-2">
                    <div class="flex flex-col justify-between items-center shadow-md py-5">
                    <p class="text-center font-bold">Discount granted</p>
                    <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'> 25%</span></p>
                    <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'> 15%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    </div>
                  </div> 
                
                 </div>

                   <div class="flex justify-end items-center gap-2 mt-5">
                     <button id='prvBtn__5' type="button" class="hidden w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__5' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                   </div>
             </fieldset>       

            </form>

                </form>
            </div>
        </div>
    </div>
</div> 





  </div>