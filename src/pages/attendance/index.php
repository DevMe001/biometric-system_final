<?php
namespace Biometric\Helper;

use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();



$getStudentEnrolledName = $controller->getEnrolleUserLrn();



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
   <script src="<?php echo baseUrlScriptSrc('/js/tailwindcss.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

  <style>
    .custom-border {
      border: 1px solid;
      border-image: linear-gradient(to left, rgba(25, 57, 125, 0.4), rgba(234, 234, 234, 0.68));
      border-image-slice: 1;
    }

     .default-box{
       position: absolute;
      top: 60%;
      left: 50%;
      transform: translate(-50%, -50%);
    }


    .overlay-box{
       position: absolute;
      top: 60%;
      left: 50%;
      transform: translate(-50%, -50%);
     animation: scanning 2s ease-in-out infinite;
    }


    .overlay-box::before{
      content: '';
      position: absolute;
      top: 5px;
      left: 4px;
      width: 82px;
      height: 2px;
      animation: lineScanner 2s linear  infinite;
    }


    @keyframes lineScanner {
      0% {
       background: linear-gradient(to right, rgba(237, 122, 14, 0), rgba(237, 122, 14, 1), rgba(237, 122, 14, 0));
        transform: translateY(0px);
         opacity: 1;
      }

      100% {
         width: 80px;
       background: linear-gradient(to right, rgba(3, 58, 240, 0), rgba(3, 58, 240, 1), rgba(3, 58, 240, 0));
        transform: translateY(125px);
         opacity: 1;

      }
    }


    @keyframes scanning {
      0% {
     
        background:rgba(237, 122, 14, 0.6); 


      }

      100% {
        
         background:rgba(3, 58, 240, 0.6); 
        
      }
    }

  </style>
</head>

<body>
  <div class="attendance  bg-[url(<?php echo baseUrlImageSrc('bg.png') ?>)] bg-no-repeat bg-cover  w-screen h-screen mx-auto relative ">
    <div class="attendance__border   max-w-[44rem] h-[80vh] max-h-[32.5rem] gap-20 mx-auto">
      <div class="flex flex-col justify-center items-center h-[100vh]">
        <div
          class="custom-border flex flex-col justify-center items-center h-[32.5rem] gap-20 shadow-1 p-20 bg-[rgba(6,0,0,0.13)]">
          <h1 class="text-6xl text-center text-white font-bold max-w-[15ch] leading-70 z-10">HMIS Attendance System</h1>
          <div class='relative p-5 z-20 w-[150px] h-full relative flex justify-center align-center'>
               <img class="max-w-[16rem] max-h-[16rem] relative z-10 relative" src="<?php echo baseUrlImageSrc('biometric.png') ?>" alt="">
                <div id='scanningDevice' class='overlay-box absolute w-[88px] h-[135px] rounded-full z-30 bg-[rgba(0,0,0,0.13)] hidden'></div>
          </div>
        </div>

      </div>
    </div>
    <div class="attendance_logo absolute bottom-0 left:0 ml-5 mb-5 z-10">

      <img class="max-w-[16rem] max-h-[16rem]" src="<?php echo baseUrlImageSrc('logo_att.png') ?>" alt="">

    </div>
    <div
      class="attendance_instruction absolute bottom-0 right-0 mr-5 mb-5 bg-white rounded-md p-5 max-h-[18rem] max-w-[14rem] z-10">
      <div class="flex flex-col justify-center items-center gap-3">
        <p class="text-center font-bold text-[#19397D]">Instruction</p>
        <img src="<?php echo baseUrlImageSrc('scan.png') ?>" class="max-w-[10rem] max-h-[9rem]">
        <p class="text-center text-sm font-semibold text-[#19397D] max-w-[24ch] leading-5">Place your finger properly for
          identification</p>
      </div>
    </div>

    <div class="attendance__overlay absolute top-0 left-0 right-0 bottom-0 bg-[rgba(0,0,0,0.6)] z-1"></div>



    
  
  <button id='ontoggleAttendance' data-modal-target="verify-modal" data-modal-toggle="verify-modal" class='text-center py-3 font-bold text-md'>+</button>

  </div>
 

   <div id="verify-modal" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" data-modal-backdrop="static">
      <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='closeModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="verify-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
        
            <form id='attendanceListForm' class="space-y-6">
               <fieldset class='attendance_enroll'>

              
                      <!-- get username of enrolle student -->
                   
                  <div>
                           <label for="attendanceName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student's LRN</label>
                           <select style="width:100%;" id="attendanceName" name='enrolled_id' class="selectItem2Lib px-5 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                             
                                foreach ($getStudentEnrolledName as $student) {
    

                                  ?>
                                      
                                      <option value="<?php echo $student['enrollment_id'] ?>"> <?php echo $student['lrn'] ?></option>
                                                  
        
        
        
                                      <?php

                                }


                                ?>
                          </select>
                  </div>


                  <div class='mt-2'>
                           <label for="clockType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Clock type</label>
                           <select style="width:100%;" id="clockType" name='clockType' class="selectItem2Lib px-5 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value="">Choose</option>
                            <option value="1">Clock in</option>
                            <option value="2">Clock out</option>
                        
                          </select>
                  </div>
                      <!-- end enrolled students -->

                    <div class='flex justify-center items-center w-full my-5'>
                    <input  id='attendanceNextBtn__1' type='submit' class="btn bg-indigo-900 text-white rounded font-medium px-10 py-3"  value="Proceed">

                    </div>
               </fieldset> 
            </form>
          </div>
        </div>
      </div>
    </div>




</body>

</html>
  <script src='<?php echo baseUrlScriptSrc('/js/es6-shim.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/websdk.client.bundle.min.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/fingerprint.sdk.min.js') ?>'></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/intermidiate.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/attendanceReader.js') ?>'></script>