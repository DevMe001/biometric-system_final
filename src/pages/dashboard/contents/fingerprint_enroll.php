<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/fingerprint.css') ?>">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>


<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$getfingerprintRecord = $controller->getAttendanceRecord();
$getStudentEnrolledName = $controller->getEnrolleUserName();



?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Fingerprint</p>
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
          <input id='fingerprintSearchEl' type="text" placeholder="Search here">
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <!-- print -->
      <div>
        <button id='fingerprintPrint'
          class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
      </div>

      <div id='onModalfingerprintToggle' data-modal-target="fingerprint-modal" data-modal-toggle="fingerprint-modal"
        class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
      </div>
    </div>

  </div>




  <!-- wrapper for table  need to use grid-->
  <div class='w-full mx-auto bg-white-500 shadow rounded mt-10'>

    <!-- <div class="absolute bottom-20 right-20">

       <div class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
       </div>
      </div> -->

    <table class="custom-table fingerprint-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>LRN</th>
          <th class='p-2 text-left'>Fingerprint</th>
          <th class='p-2 text-left'>Date</th>
          <th colspan="2" class='p-2 text-left'>Action</th>
     
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

<!-- get attendace -->

    <?php

    if (count($getfingerprintRecord) > 0) {

      foreach ($getfingerprintRecord as $keyList => $fingerprint) {



    $attRec = json_encode($fingerprint);

    $fingerprintData = htmlspecialchars(str_replace('\\', '', $attRec));

        $deleted = $fingerprint['is_archive'];


        if($deleted == 0){
          ?>

          <tr>
            <td class='p-2'>
          <?php echo $keyList + 1 ?>
                </td>
                <td class='p-2'>
                  <?php echo $fingerprint['lrn'] ?>
                </td>
                <td class='p-2'>
                  <span style='display: inline-block; width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
                    <?php echo $fingerprint['fingerscan'] ?>
                  </span>
                </td>
                <td class='p-2'>
                  <?php echo $fingerprint['date_created'] ?>
                </td>
        
                <td onclick='editfingerprint(<?php echo $fingerprintData; ?>)'
                  class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="create-outline"></ion-icon></td>
                <td onclick='fingerPrintMoveToArchive(<?php echo $fingerprintData; ?>)'
                  class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="archive-outline"></ion-icon></td>
              </tr>
     <?php

        }else{
          ?>
           
        <tr id='fingerprintNoResult' class='hidden'>
          <td colspan='4' class='text-center text-gray-500'>No match found</td>
          <?php
        }
    ?>

  
            <!-- create center no match found -->
      

      <?php
  }
  # code...
} else {
  ?>


   <!-- create center no match found -->
        <tr id='fingerprintNoResult'>
          <td colspan='4' class='text-center text-gray-500'>No match found</td>
    <?php
}


?>


<!-- end attendace -->




      </tbody>



    </table>

    <!-- printing code -->

    <table class="fingerprint-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>Lrn</th>
          <th class='p-2 text-left'>Name</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Birthdate</th>
          <th class='p-2 text-left'>Address</th>
          <th class='p-2 text-left'>Gen.Ave</th>
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($getfingerprintRecord as $keyList => $fingerprint) {




          ?>
          <tr>
          
            <td class='p-2'>
          <?php echo $keyList + 1 ?>
            </td>
            <td class='p-2'>
              <?php echo $fingerprint['attendance_id'] ?>
            </td>
            <td class='p-2'>
              <?php echo $fingerprint['lrn'] ?>
            </td>
            <td class='p-2'>
              <?php echo $fingerprint['date_created'] ?>
            </td>
          
            <td onclick='editfingerprint(<?php echo $fingerprintData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="create-outline"></ion-icon></td>
            <td onclick='moveToArchive(<?php echo $fingerprintData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="trash-outline"></ion-icon></td>
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
        <button onclick='prevBtn(".fingerprint-table")'
          class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
      </span>
      <span> |</span>
      <span>
        <button onclick='nextBtn(".fingerprint-table","fingerprintNoResult")'
          class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
      </dv>
    </div>



    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addfingerprint" data-modal-toggle="addfingerprint" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
    <div id="fingerprint-modal" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" data-modal-backdrop="static">
      <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='closeModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="fingerprint-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
        
            <form id='fingerprintForm' class="space-y-6">
               <fieldset class='fingerprint_enroll'>
                <input type='hidden' name='fingerprintNameEdit' id='fingerprintNameEdit'/>

                   <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white text-center"><span id='attendaceTitle'>Enroll</span> student
              fingerprint</h3>
                      <!-- get username of enrolle student -->
                   
                          <label for="fingerprintName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Name</label>
                           <select style="width:100%;" id="fingerprintName" name='fingerprintName' class="selectItem2Lib px-5 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                             
                                foreach ($getStudentEnrolledName as $student) {
    

                                  ?>
                                      
                                      <option value="<?php echo $student['enrollment_id'] ?>"> <?php echo $student['fullName'] ?></option>
                                                  
        
        
        
                                      <?php

                                }


                                ?>
                          </select>
                      <!-- end enrolled students -->

                    <div class='flex justify-center items-center w-full my-5'>
                    <input  id='fingerprintNextBtn__1' type='button' class="btn bg-indigo-900 text-white rounded font-medium px-10 py-3"  value="Proceed">

                    </div>
               </fieldset>    


               <fieldset class='fingerprint_enroll'>

               <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white text-center"><span id='attendaceTitle'>Enroll</span> student
              fingerprint</h3>

            
               <div id='fingerprintPrevBtn__1' class='flex justify-start items-start w-full my-5 cursor-pointer'>
                 
                <span class='text-indigo-900'>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
           
                </svg>
               </span>

               <span class='ml-1 text-indigo-900 cursor-pointer'> Back</span>
            
                                    
               </div>


                <!-- loader -->
                      
                <div class='flex flex-col justify-center items-center w-full my-5'>
                <div id='spinLoaderDevice' class='mb-5 hidden' role="status">
                    <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div> 

                <!-- end loader -->

                <!-- devicemsg -->

                 <div class='flex flex-col justify-center items-center'>
                         <span id='deviceMsg' class='text-red-600 font-medium text-xl mb-5 hidden text-center'>Device is disconnected</span>       
                         
                         
                    <!-- check device btn -->
                   <input id='fingerprintNextBtn__2' type='button' class="btn bg-indigo-900 text-white rounded font-medium px-10 py-3" value="Check Device"/>

                  </div>
                <!-- end device msg -->
               
              
            </div>
                
               </fieldset>


               
               <fieldset class='fingerprint_enroll'>
                  <!-- instruction -->


                <div id='fingerprintPrevBtn__2' class='flex justify-start items-start w-full my-5 cursor-pointer'>
                 
                <span class='text-indigo-900'>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
           
                </svg>
               </span>

               <span class='ml-1 text-indigo-900 cursor-pointer'> Back</span>
            
                                    
               </div>

              <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white text-center"><span id='attendaceTitle'>Biometric</span> fingerprint
              scanner</h3>

                 
                 <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                  <li>
                      <span class="text-gray-900 dark:text-white">Make sure scan your fingerprint accurately.</span>
                  </li>
                  <li>
                      <span class="text-gray-900 dark:text-white">Scan <span id='counterItem' class='font-semibold text-gray-900 dark:text-white text-xl'>4</span> <span id='getTimeLabel'>times</span> to get accurate image.</span>
                  </li>
                
              </ol>

                         
               <div class="fingerprint__border max-w-full gap-20 mx-auto">

                <div class="flex flex-col justify-center items-center h-full text-">
                  <div
                    class="flex flex-col justify-center items-start h-full gap-20 shadow-1">
                    <div class='relative p-5 z-20 w-[150px] h-full relative flex justify-center align-center'>
                  <img class="max-w-[16rem] max-h-[16rem] relative z-10 relative" src="<?php echo baseUrlImageSrc('biometric.png') ?>" alt="">
                      <div id='biometric__scanItem'
                        class='overlay-box absolute w-[88px] h-[135px] rounded-full z-30 bg-[rgba(0,0,0,0.13)] hidden'></div>
                    </div>
                  </div>

              <p id='ctaMsg' class="text-center font-semibold text-xl text-green-600 my-2 hidden">Completed</p>

              
                </div>


              </div>

                   <div class='flex justify-center items-center w-full'>
                    <input  id='fingerprintNextBtn__3'  type='submit' class="btn bg-indigo-900 text-white rounded font-medium px-10 py-3 hidden" value="Submit">

                    </div>
                  <!-- end instruction -->


               </fieldset>

            </form>
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



<!-- <script>
  var scriptElement = document.querySelector("script[src='']");
  if (!scriptElement) {
    var newScript = document.createElement('script');
    newScript.src = '<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>';
    document.head.appendChild(newScript);
  }
</script> -->


<!-- plugins to run fingerprint sdk -->
  <script src='<?php echo baseUrlScriptSrc('/js/es6-shim.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/websdk.client.bundle.min.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/fingerprint.sdk.min.js') ?>'></script>

  <!-- end fingerprint plugins -->

<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/intermidiate.js') ?>'></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/fingerprintEnrollFunction.js') ?>'></script>
