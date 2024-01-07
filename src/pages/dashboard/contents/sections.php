<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">





<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$sections = $controller->getSections();



?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Section</p>
</div>

<div class='w-[90%] mx-auto'>


  <!-- breadcrums  -->



  <!-- wrapper  filter-->
  <div class='w-full mx-auto'>
    <!-- filter search -->

    <div class='w-[80%] flex justify-between items-center gap-5 mx-auto'>
      <!-- sort -->
      <div>
        <!-- <?php require_once(__DIR__ . '/widget/widget.php'); ?> -->
        <!-- <p class='text-md text-gray-500 font-bold'>Sort <span class='btn btn-blue-500 p-2'>▼</span></p> -->
      </div>
      <!-- search -->
      <div class="search focus:outline focus:outline-offset-2 focus:outline-1 focus:outline-blue-500 focus:rounded">
        <label>
          <input id='sectionSearchEl' type="text" placeholder="Search here">
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <!-- print -->
      <div>
        <button id='sectionPrint'
          class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
      </div>

      <div id='onModalSectionToggle' data-modal-target="section-modal" data-modal-toggle="section-modal"
        class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
      </div>
    </div>

    </div>





  <!-- end -->

  <!-- wrapper for table  need to use grid-->
   <div class='w-full mx-auto bg-white-500 shadow rounded mt-10 overflow-x-auto'>

    <!-- <div class="absolute bottom-20 right-20">

       <div class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
       </div>
      </div> -->

    <table class="custom-table section-table w-auto md:min-w-[37.5rem] lg:min-w-[70%] mx-auto mb-2 w-full">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>Id</th>
          <th class='p-2 text-left'>Section</th>
          <th colspan="2" class='p-2 text-left'>Action</th>

          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>
        

        <?php
        foreach ($sections as $key => $section) {




          $sectionRecords = json_encode(array('id' => $section['id'], 'name' => $section['name'], 'limit' => $section['limit_section'], 'min_grade' => $section['min_grade'], 'max_grade' => $section['max_grade']));

          $sectionsData = htmlspecialchars(str_replace('\\', '', $sectionRecords));

          $deleted = $section['is_archive'];

          if($deleted == 0){
            ?>
             <tr>
            <td class='p-2'>
              <?php echo $key + 1 ?>
                  <td class='p-2'>
                    <?php echo $section['name'] ?>
                  </td>
                  </td>
            
            
                  <td onclick='editSection(<?php echo $sectionsData; ?>)'
                    class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="create-outline"></ion-icon></td>
                  <td onclick='sectionMoveToArchive(<?php echo $sectionsData; ?>)'
                    class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="archive-outline"></ion-icon></td>
                </tr>
            <?php
           }

          ?>
         
          <?php
          # code...
        }


        ?>


        <!-- create center no match found -->
        <tr id='sectionNoResult' class='hidden'>
          <td colspan='4' class='text-center text-gray-500'>No match found</td>
      </tbody>



    </table>

    <!-- printing code -->

    <table class="section-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>Id</th>
          <th class='p-2 text-left'>Section</th>
          <!-- <th class='p-2 text-left'>Limit</th>
          <th class='p-2 text-left'>Min Grade</th>
          <th class='p-2 text-left'>Max Grade</th>
           -->
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($sections as $key => $section) {

       


          ?>
          <tr>
            <td class='p-2'>
              <?php echo $key + 1 ?>
              <td class='p-2'>
                <?php echo $section['name'] ?>
              </td>
              </td>
              <!-- <td class='p-2'>
                <?php echo $section['limit_section'] ?>
              </td> -->
              <!-- <td class='p-2'>
                <?php echo $section['min_grade'] ?>
              </td>
              <td class='p-2'>
                <?php echo $section['max_grade'] ?>
              </td> -->
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
        <button  onclick='prevBtn(".section-table")' class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
      </span>
     <span> |</span>
      <span>
        <button onclick='nextBtn(".section-table","sectionNoResult")' class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
  </dv>
</div>


    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="section" data-modal-toggle="section" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
  <div id="section-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div id='modal_reg-container' class="relative w-full max-w-md max-h-full" >
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='sectionCloseModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="section-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white"><span id='sectionTitle'>Create</span> new section
              </h3>
            <form id='sectionForm' class="space-y-6">
              <input type="hidden" name="section_id" id='section_id'>
                <div>
                        <label for="secName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section name</label>
                        <input type="text" name="secName" id="secName" maxlength="10" class="charAllowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                </div>
              
                  
                <!-- <div>
                        <label for="secLimit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section limit</label>
                        <input type="number" name="secLimit" id="secLimit" maxlength="2" class="limitLength disabled-key uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                </div>

                  
                <div>
                        <label for="secMin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Min grade</label>
                        <input type="number" name="secMin" id="secMin" maxlength="2" class="limitLength disabled-key uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                </div>

                  
                <div>
                        <label for="secMax" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max grade</label>
                        <input type="number" name="secMax" id="secMax" maxlength="2" class="limitLength disabled-key uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                </div> -->

                    <div class="flex justify-center items-center mt-5">
                     <button id='sectionBtn'  class="w-[60%] mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                   </div>
           
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


 
<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/sectionFunction.js') ?>'></script>