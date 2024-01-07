<style>
 #editMasterForm select{
    webkit-appearance: none;
    appearance: none;
     border:0px;
   outline:0px;
   border-bottom: 1px solid #000;
  }
 
  #editMasterForm [class^='select2'] {
  border: none !important;
  outline: none !important;

  }
  #editMasterForm .select2-container .select2-selection--single .select2-selection__rendered{
    background: #ffffff !important;
  }

  .customBottomBorder{
    border-bottom: 1px solid #000 !important;
  }

  .selectedStyle{
  border:none;outline:none;border-bottom:1px solid #000;
  }
  .spacingInput{
     word-spacing: 30px;
  }
  
  input::focus{
  border:none !important; 
  outline:none !important;
  }
  </style>



<div>

<?php

$classDetails = array();

  if(count($sections) > 0){
    foreach($sections as $res){
      $class = json_encode($res);

      $classDetails[] = $class;
    }
  }

$enrollmentList = array();
if (count($enrollmentRecord) > 0) {
  foreach ($enrollmentRecord as $res) {
    $enroll = json_encode($res);

    $enrollmentList[] = $enroll;
  }
}

?>
  <input type="hidden" id='getClassDetails' value='<?php echo htmlspecialchars(json_encode($classDetails)) ?>' />
   <input type="hidden" id='getEnrollmentValue' value='<?php echo htmlspecialchars(json_encode($enrollmentList)) ?>'/>
</div>


<form id='editMasterForm' class="flex flex-col flex-wrap w-full max-w-[70rem] mx-auto">

<input type="hidden" name="viewStudentId" id='viewStudentId'>

<div class="flex justify-between w-full no-print">
     <p id='backMasterList' class='my-5 cursor-pointer flex'>
                 
                <span class='text-indigo-500'>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
           
                </svg>
               </span>

               <span class='ml-1 cursor-pointer text-indigo-500 text-xl font-medium'>Back</span>
            
                                    
</p>

 <p id='editMasterList' class='my-5 cursor-pointer text-indigo-500 text-xl font-medium'>                
           <span>Edit</span>  <ion-icon name="create-outline">
                                           
</p>

</div>



 <legend class="font-medium text-xl text-center">Registered Form <small id='viewStatus'>(Pending)</small></legend>
  <div class="flex justify-between items-start mt-10 flex-wrap w-full">
    
    <div>
      <p><span class="font-medium">Registration #:</span> <span id='viewReferenceNumber'
          class="bottom-border01">Reg202023345345</span></p>
      <p><span class="font-medium">Lrn:</span> <span id='viewLrn' class="bottom-border01"> 345345435345345</span></p>
      <div class="flex gap-2 my-2">
         <div   class="flex justify-start items-center  w-full">
                          <label for="viewGradeLevel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level</label>
          
                       <div class='customBottomBorder'>
                           <select disabled style='max-width:12rem' id="viewGradeLevel" name='viewGradeLevel' class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                       
                          </select>
                       </div>

      </div>
        <div id='showSectionWhenEnrolled'  class="flex gap-2 w-full hidden">
                          <label for="viewSection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>

                    
                       <div class='customBottomBorder'>
                           <select disabled  style='width:10rem'  id="viewSection" name='viewSection' class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                       
                          </select>
                      </div>

      </div>
      </div>
    </div>
   
    <div>
      <p><span class="font-medium">Date registered:</span> <span id='viewDateRegistered' class="bottom-border01">December
          15 2023</span></p>

    </div>
  </div>

  <div class="my-2">
    <small>Please be advised that the above information shall be used in relation to the aforementioned protocols in
      accordance with the Data Privacy Act of 2012</small>
  </div>
  <!-- list of form inputted -->
  <div class="all-border01 flex flex-col justify-between items-start p-5 mt-2 gap-4 flex-wrap w-full">
    <small class="mb-1 font-medium">Applicant's Personal Details:</small>

    <!-- personal info -->
    <div class="bottom-border02 w-full">
      <small>Personal Details</small>
    </div>

    <div class="flex justify-between gap-4 flex-wrap w-full">
      <div class="flex justify-start">
        <p><span class="font-medium">Legal Name: </span></p>
        <input style="min-width:20rem" readonly type="text" class="text-center px-2 selectedStyle spacingInput" name='viewFullName' id='viewFullName'/>

      </div>

      <div class="flex justify-start">
        <p><span class="font-medium">Date of birth: </span></p>
          <input readonly type="date"  class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewBdate' id='viewBdate' value="2008-09-09" />

      </div>


      <div class="flex justify-start">
        <p><span class="font-medium">Gender: </span></p>
         <select disabled id='viewGender' name="viewGender" class="text-center">
        <option value="male" selected>Male</option>
        <option value="female">Female</option>
        <option value="transgender">Transgender</option>
      </select>
      </div>


    </div>

    <!-- end personalinfo -->



    <!-- location -->
    <div class="flex justify-between gap-4 flex-wrap  w-full">

       <div class="flex justify-start">
        <p><span class="font-medium">Age: </span></p>
        <input readonly type="number"  class="bottom-border01 text-center px-2 selectedStyle spacingInput" name="viewAge" id='viewAge'/>
      

      </div>
     
      <div class="flex justify-start">
        <p><span class="font-medium">Place of birth: </span></p>
        <input readonly type="text"  class="bottom-border01 text-center px-2 selectedStyle spacingInput"  name="viewPlace"  id='viewPlace'/>
      

      </div>

      <div class="flex justify-start">
        <p><span class="font-medium">Current address: </span></p>
        <input readonly type="text"class="bottom-border01 text-center px-2 selectedStyle spacingInput" name="viewAddress" id='viewAddress'>
      </div>

    


    </div>

    <!-- end location -->


    <!-- students -->
    <div class="flex justify-between gap-4 flex-wrap  w-full">

     <div class="flex justify-start">
        <p><span class="font-medium">Nationality: </span></p>
        <input readonly type='text'  class="bottom-border01 text-center px-2 selectedStyle spacingInput" name="viewNationality" id='viewNationality'/>
       

      </div>

      <div class="flex justify-start">
        <p><span class="font-medium">Student's number: </span></p>
        <input readonly type='number'  class="bottom-border01 text-center px-2 selectedStyle spacingInput" name="viewStudentNumber" id='viewStudentNumber'/>

      </div>

      <div class="flex justify-start">
        <p><span class="font-medium">Student's email: </span></p>
        <input type='email'  class="bottom-border01 text-center px-2 selectedStyle spacingInput"  name="viewStudentEmail" id='viewStudentEmail'/>

      </div>


      <div class="flex justify-start">

      </div>


    </div>
    <!-- end students -->

    <div id='viewParentDetails' class="flex flex-col justify-between gap-4 flex-wrap w-full hidden">

      <div class="bottom-border02 w-full my-2">
        <small>Father's's Details</small>
      </div>
      <!-- father info -->

      <div class="flex justify-between gap-4 flex-wrap w-full">
        <div class="flex justify-start">
          <p><span class="font-medium">Father's Name: </span></p>
          <input readonly style="word-spacing: 30px;" class="bottom-border01 text-center px-2"  name='viewFatherName'  id='viewFatherName'/>

        </div>
        <div class="flex justify-start">
          <p><span class="font-medium">Father's occupation: </span></p>
          <input readonly class="bottom-border01 text-center px-2 selectedStyle spacingInput"
            id='viewFatherOccupation' name="viewFatherOccupation"/>

        </div>
        <div class="flex justify-start">
          <p><span class="font-medium">Father's email: </span></p>
          <input readonly type="email" readonly class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewFatherEmail' id='viewFatherEmail'/>

        </div>





      </div>


      <div class="flex justify-between gap-4 flex-wrap w-full">

        <div class="flex justify-start">
          <p><span class="font-medium">Father's number: </span></p>
          <input readonly type="number"  class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewFatherNumber' id='viewFatherNumber'/>

        </div>

        <div class="flex justify-start">
          <p><span class="font-medium">Father's address: </span></p>
          <input readonly type="text"  class="bottom-border01 text-center px-2 selectedStyle spacingInput"  name='viewFatherAddress' id='viewFatherAddress'/>
          </p>

        </div>


      </div>



      <!-- end father -->


      <div class="bottom-border02 w-full my-2">
        <small>Mother's Details</small>
      </div>

      <!-- mother  -->
      <!-- father info -->

      <div class="flex justify-between gap-4 flex-wrap my-2 w-full">
        <div class="flex justify-start">
          <p><span class="font-medium">Mother's Name: </span></p>
          <input readonly type='text' class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewMotherName' id='viewMotherName'/>

        </div>
        <div class="flex justify-start">
          <p><span class="font-medium">Mother's occupation: </span></p>
          <input readonly type='text' class="bottom-border01 text-center px-2 selectedStyle spacingInput"
            name='viewMotherOccupation' id='viewMotherOccupation'/>

        </div>
        <div class="flex justify-start">
          <p><span class="font-medium">Mother's email: </span></p>
          <input readonly type="email"  class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewMotherEmail' id='viewMotherEmail'>

        </div>





      </div>


      <div class="flex justify-between gap-4 flex-wrap my-2 w-full">

        <div class="flex justify-start">
          <p><span class="font-medium">Mother's number: </span></p>
          <input  class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewMotherNumber'  id='viewMotherNumber'//>

        </div>

        <div class="flex justify-start">
          <p><span class="font-medium">Mother's address: </span></p>
          <input class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewMotherAddress' id='viewMotherAddress'/>
        

        </div>


      </div>




    <div id='guardianDetails' class='hidden'>


      <!-- end mother -->
      <div class="bottom-border02 w-full">
        <small>Guardian's Details</small>
      </div>
      <!-- guardian  -->


      <div class="flex justify-between gap-4 flex-wrap w-full">
        <div class="flex justify-start">
          <p><span class="font-medium">Guardian's Name: </span></p>
          <input readonly type="text" class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewGuardiansName'  id='viewGuardiansName'/>

        </div>
        <div class="flex justify-start">
          <p><span class="font-medium">Guardian's occupation: </span></p>
          <input readonly  type="text" style="word-spacing: 30px;min-width:10rem;" class="bottom-border01 text-center px-2 selectedStyle spacingInput"
            name='viewGuardiansOccupation'  id='viewGuardiansOccupation'/>

        </div>
        <div class="flex justify-start">
          <p><span class="font-medium">Guardian's email: </span></p>
          <input readonly  type="email" class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewGuardiansEmail' id='viewGuardiansEmail'/>
          </p>

        </div>





      </div>




      <div class="flex justify-between gap-4 flex-wrap w-full">

        <div class="flex justify-start">
          <p><span class="font-medium">Guardian's number: </span></p>
          <input type="number" class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewGuardiansNumber' id='viewGuardiansNumber'/>

        </div>

        <div class="flex justify-start">
          <p><span class="font-medium">Guardian's address: </span></p>
          <input type="text" class="bottom-border01 text-center px-2 selectedStyle spacingInput" name='viewGuardiansAddress' id='viewGuardiansAddress'/>
        </div>


      </div>

    </div>


    <!-- end father -->

    <!-- end guardian -->

    <div class="bottom-border02 w-full">
      <small>Incase of emergency</small>
    </div>
    <!-- incase of emergency -->


    <div class="flex justify-between gap-4 flex-wrap w-full">
      <div class="flex justify-start">
        <p><span class="font-medium">Contact Name: </span></p>
        <input type="text"  class="bottom-border01 text-center px-2 spacingInput selectedStyle" name='viewContactName'  id='viewContactName'/>

      </div>
      <div class="flex justify-start">
        <p><span class="font-medium">Relationship: </span></p>
        <select disabled name='viewRelationship' id='viewRelationship' class="text-center">
          <option value="parents">Parents</option> 
          <option value="guardians">Guardians</option>
      </select>
      
      </div>
      <div class="flex justify-start">
        <p><span class="font-medium">Contact Number : </span></p>
        <input type="number"  class="bottom-border01 text-center px-2 spacingInput selectedStyle" name='viewContactNumber' id='viewContactNumber'/>
      </div>


    </div>





    <!-- end incase of emergency  -->
    <div class="bottom-border02 w-full">
      <small>Submitted document (<strong id='viewTypeSubmittedDocument'>Local</strong>)</small>
    </div>


    <!-- submitted document -->

    <div id='viewLocalType' class="flex justify-between gap-2 flex-wrap  w-full"> </div>
    <!-- end local -->


    <!-- foreign -->
    <div id="viewForeignType" class='flex justify-between gap-2 flex-wrap  w-full'></div>
    <!-- end foreign -->

    <!-- end submitted document -->
    <div class="bottom-border03 w-full my-4">
       <small>Tuition fee</small>
    </div>


    <!-- fee -->
    <div class="flex gap-2 justify-around w-full">

    
               
      <div class="flex gap-2">

        <div class="w-auto my-2">
          <div>
            <p class='text-left mb-1'><span class="font-medium">Miscellanious fee</span> <span id='viewMiscellanious'
                clas='font-medium'>₱10,045.00</span></p>
            <p class='text-left mb-1'><span class="font-medium">Books and Modules</span> <span id='viewBooks'
                clas='font-medium'>₱5,905.00</span></p>
            <p class='text-left mb-1'><span class="font-medium">Tuition fee</span> <span id='viewTuition'
                clas='font-medium'>₱15,000.00</span></p>
            <p class='text-left mb-1'><span class="font-medium">Total</span> <span id='viewTotal'
                clas='font-medium'>₱30,950</span></p>
          </div>
          <div class="mt-4">
            <p class='text-left'><span class="font-medium">Full cash payment</span> <span id='viewFullPayment'
                clas='font-medium'>₱29,450</span></p>
          </div>

        </div>


      </div>

      <div class="flex gap-2 w-6/12">

        <div class="w-full mx-auto my-2">
          <div class="flex flex-col justify-between items-center shadow-md p-5">
            <p class="text-center font-bold">Discount granted</p>
            <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'>
                25%</span></p>
            <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'>
                15%</span></p>
            <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'>
                5%</span></p>
            <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'>
                5%</span></p>
          </div>
        </div>

      </div>

      <!-- end fee -->




    </div>

    <div class="flex justify-end items-center gap-2 mt-5 w-full no-print">
      <button id='printRegisterForm' type="button"
        class="w-[10rem] btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'">Print <ion-icon name="print-outline"></ion-icon></button>
      <button disabled id='approveChangeInput' data-end='last_record'
        class="hidden w-[10rem] text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
    </div>

  </div>
    </div>
        </form>
  <!-- end view list -->