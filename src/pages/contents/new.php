  <?php

// genereate barcode
// require_once('src/function/barcode.php');

// use Biometric\BarcodeGenerator\BarcodeReader;



//   // Example usage
//   $barcodeGenerator = new BarcodeReader();
//   $barcodeGenerator->generateBarcode('123456789');
  



  function generateReferenceNumber()
  {
    $prefix = 'REG'; // can customize the prefix
    $dateComponent = date('YmdHis');
    $randomComponent = mt_rand(1000, 9999);

    return $prefix . $dateComponent . $randomComponent;
  }


 $randomRegNumber = generateReferenceNumber();
?>
  
  

  
  <form id='regFormInfo' class="space-y-6" enctype='multipart/form-data no-print' >


    

                    <input type="hidden" name='studentId'  id='studentId'>
                    <input type="hidden" name='receiptId'  id='receiptId'>
                    <input type="hidden" name='submitId'  id='submitId'>
                    <input type="hidden" name='oldProfile'  id='oldProfile'>
                    <input id='refNumber' name='ref_number' type="hidden" value='<?php echo $randomRegNumber ?>'>



        <!-- type of enrollment -->
          <fieldset class="reg_class">
                    <div class='editHidden'>
                          <label for="typeStudent" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student type</label>
                          <select id="typeStudent" name='typeStudent' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose type</option>
                            <option value="new">New</option>
                          </select>
                    </div>

                       <div class="flex justify-between items-center mt-5">
                     <button id='next-button__1'  class="hidden w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                    
                   </div>
          </fieldset>

        



          <fieldset class="reg_class">
                    <div id='chooseTypeEnroll'>
                         
                          <label for="typeEnroll" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose type</label>
                          <select id="typeEnroll" name='typeEnroll' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
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

                   <div id='typeYearLevel' class='hidden'>
                          <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose grade level</label>
                          <select id="level" name='level' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                          </select>

                    </div>


            

                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__2'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

                </fieldset>

    <!-- end grade -->

        <!-- end typeof enrollment -->

                <fieldset class="reg_class">        
                    <div id='personal-form'>
                      
            
        <!-- profile -->

                     <div class="w-full mx-auto mt-3 flex flex-col justify-center items-center ">
                      
                        <!-- display profileImg -->
                       <label for="profile" class="cursor-pointer " title="Choose file">
                        
                          <div id='previewImgDiv' class='w-[150px] h-[150px] shadow-1 border-1 bg-[#eaeaea] mx-auto px-5 py-10 rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'>2X2 picture</p> 
                          </div>
                        

                         </div>
                        </label>
                      
                        <input type="file" name="profile" id="profile" class="invisible" accept="image/*" required>
                         <label id="profile-error" class="error hidden" for="profile">This field is required.</label>
                 
                      </div>

        <!-- end profile -->
                    <!-- lrn -->


                    <div>
                        <label for="lrn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LRN</label>
                        <input type="number" name="lrn" id="lrn" maxlength="12" class="limitLength disabled-key uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                  

                    </div>

                    

                    <!-- other information needed -->
                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__3' type="button" class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </fieldset>


                <fieldset class="reg_class">        
                    <div id='personal-form'>
                    

                    <!-- fulname -->
                    <div>
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Family name</label>
                        <input type="text" name="lname" id="lname" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                    <div>
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Given Name</label>
                        <input type="text" name="fname" id="fname" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>


                      <div>
                        <label for="mname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                        <input type="text" name="mname" id="mname" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                

                    </div>

                    

                    <!-- other information needed -->
                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__4' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__4' type="button" class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </fieldset>



           <fieldset class="reg_class">
      
                 <div>
                       <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                      <select id="gender" name='gender' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="transgender">Transgender</option>
                           
                      </select>

                

                    </div>
                   

                    <!-- end gender -->

                    <!-- age -->
                  

                    <!-- end age -->

                    <!-- bday -->

                    <div>
                        <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                        <input type="date" name="birthdate" id="birthdate" class="bday bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>


                    <!-- end bday -->
                      <div id='ageReveal' class="hidden">
                        <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                        <div id='guestmyAge' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white'>7-25</div>
                        <input type="hidden" id='age' name="age">
                    </div>


            

                   

                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__5'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </fieldset>

                
           <fieldset class="reg_class">
          
              <div>

                  <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Address</label>
                        <input type="text" name="address" id="address" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                  </div>
                  <!-- plaec of birth -->
                  <div>
                        <label for="pbirth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Place of birth</label>
                        <input type="text" name="pbirth" id="pbirth" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                  </div>
                    <!-- end placeofbirth -->

                    <!-- nationality -->
                      

                    <!-- end nationality -->
                   <div>
                        <label for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                  </div>

                   <div>
                        <label for="studentNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Contact Number</label>
                        <input type="number" name="studentNumber" id="studentNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                       
                   </div>

                  

                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__6' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__6'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                </div>



           </fieldset>


           <fieldset class="reg_class">
        

            <div class="mt-2">
       
              
                        <label for="fatherName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Name</label>
                        <input type="text" name="fatherName" id="fatherName" class="uppercase char-allowed bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>                
            
            <div>
                        <label for="fatherOccupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Occupation</label>
                        <input type="text" name="fatherOccupation" id="fatherOccupation" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>
            <div>
                        <label for="fatherNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Contact Number</label>
                            <input type="number" name="fatherNumber" id="fatherNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>

            </div>

            <div>
                        <label for="fatherEmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's email</label>
                        <input type="email" name="fatherEmail" id="fatherEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>

            </div>


              <div>
                        <label for="fatherAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Address</label>
                        <input type="text" name="fatherAddress" id="fatherAddress" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
             </div>

           
              <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__7' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__7'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
             </div>
        
  
            
      
           </fieldset>

           <fieldset class="reg_class">
               

          <div class='mt-2'>
              <div>
                        <label for="motherName" class="char-allowed block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Name</label>
                        <input type="text" name="motherName" id="motherName" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>                
            

             <div>
                        <label for="motherOccupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Occupation</label>
                        <input type="text" name="motherOccupation" id="motherOccupation" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>
            <div>
                        <label for="motherNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother Contact Number</label>
                        <input type="number" name="motherNumber" id="motherNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>

                <div>
                        <label for="motherEmail" class="char-allowed block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's email</label>
                        <input type="email" name="motherEmail" id="motherEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>      

                 <div>
                        <label for="motherAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Address</label>
                        <input type="text" name="motherAddress" id="motherAddress" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
             </div>

        
           

                  <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__8' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__8' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </div>

             
              
           </fieldset>

           
           <fieldset class="reg_class">
               

          <div class='mt-2'>
  
            <div>
                        <label for="guardiansName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gurdian's Contact(Mr.Ms/Mrs.)</label>
                        <input type="text" name="guardiansName" id="guardiansName" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>                
            
            <div>
                        <label for="guardianContactNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian's Contact Number</label>
                        <input type="number" name="guardianContactNumber" id="guardianContactNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>
           
           <div>
                        <label for="guardianEmail" class="char-allowed block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian's email</label>
                        <input type="email" name="guardianEmail" id="guardianEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div> 
          
             <div>
                        <label for="guardianAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian's Address</label>
                        <input type="text" name="guardianAddress" id="guardianAddress" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
             </div>


                  <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__9' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__9' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </div>

             
              
           </fieldset>
              
             <fieldset class="reg_class">
                <legend>Emergency contact information</legend>
                 <div id='other-form'>
                      
    
                       
                    <div>
                        <label for="contactName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fullname</label>
                        <input type="text" name="contactName" id="contactName" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  >
                    </div>

                    <!-- end fullname -->


                   <!-- gender -->
                    <div>
                       <label for="relationship" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
                      <select id="relationship" name='relationship' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600  dark:text-white" >
                            <option  value='' selected></option>
                        
                           
                            <option value="parents">Parents</option> 
                            <option value="guardians">Guardians</option>
                          


                           
                      </select>

                    </div>
                   

                    <!-- end gender -->

                    <!-- age -->
                    <div>
                        <label for="contactNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact number of relative</label>
                        <input type="number" name="contactNumber" id="contactNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    
                    </div>

                    <!-- end age -->

                    <!-- bday -->

                 


                    <!-- end previous grade -->


                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__10' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__10'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

                </div>

                 

              
       </fieldset>
                
                    <!-- end other information -->


            <!-- type of submitted form -->
                 <fieldset class="reg_class">
                   
                  
               <div>
                       <label for="credentialType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credential's type</label>
                      <select id="credentialType" name='credentialType' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose</option>
                            <option value="local">LOCAL</option>
                            <option value="foreign">FOREIGN</option>  
                      </select>


                      <div id='local' class='hidden'>

                      
                        <!-- form 138 -->
                <div class="mt-4 reg_local">

                
                          <!-- select field -->
                      <div class="my-4">
                          <label for="selectForm38" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Form 138 / Report card</label>
                            <select id="selectForm38" name='selectForm38' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>

                      </div>

                     <div class="flex flex-col justify-center items-center h-full form-local6 hidden">
                          <!-- display profileImg -->
                       <label for="form38" class="cursor-pointer " title="Choose file">
                        
                          <div id='form38ImgPreview' class='shadow-1 border-1 bg-[#eaeaea] mx-auto rounded p-[60px]'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm'>Form 138 /  Report card</p> 
                          </div>
                        

                         </div>
                        </label>

                         <input type="file" name="form38" id="form38" class='invisible' accept="image/*" required>
                         <label id="form38-error" class="error hidden" for="form38">This field is required.</label>
                     </div>
                      

                        <!-- end form 138 -->
                        <div class="flex justify-between items-center  mt-5">
                          <button id='prev-button_local__1' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_local__1' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                        </div>


                    </div>

                      <div class="mt-4 reg_local">


                

                      <!-- form 137 -->
                      
                          <!-- select field -->
                      <div class="my-4">
                          <label for="selectForm37" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Form 137 / Sf10</label>
                            <select id="selectForm37" name='selectForm37' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>

                      </div>

                     <div class="flex flex-col justify-center items-center h-full form-local1 hidden">
                          <!-- display profileImg -->
                       <label for="form37" class="cursor-pointer " title="Choose file">
                        
                          <div id='formImgPreview' class='shadow-1 border-1 bg-[#eaeaea] mx-auto rounded p-[60px]'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm'>Form 137 / Sf10</p> 
                          </div>
                        

                         </div>
                        </label>

                         <input type="file" name="form37" id="form37" class='invisible' accept="image/*" required>
                         <label id="form37-error" class="error hidden" for="form37">This field is required.</label>
                     </div>
                      
         
                 

                        <!-- end form 137 -->


                        <!-- b_cert -->

                              
                        <div class="flex justify-between items-center  mt-5">
                          <button id='prev-button_local__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_local__2' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                        </div>

                        
                      </div>
                   

                      <div class="mt-4 reg_local" >
                      
                          <!-- select field -->
                         <div class="my-4">
                               <label for="selectBcert" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Certificate</label>
                            <select id="selectBcert" name='selectBcert' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>

                         </div>

                         <!-- display profileImg -->
                      <div class="flex flex-col justify-center items-center h-full form-local2 hidden">

                        <label for="bcert" class="cursor-pointer " title="Choose file">
                        
                          <div id='bcertImgPreview' class='shadow-1 border-1 bg-[#eaeaea] p-[60px] rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm'>Birth Certificate</p> 
                          </div>
                        

                         </div>
                        </label>

                          <input type="file" name="bcert" id="bcert" class="invisible" accept="image/*" required>
                         <label id="bcert-error" class="error hidden" for="bcert">This field is required.</label>
                 

                     </div>
                      
                      

                       <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_local__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_local__3' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                        </div>



                        

                      </div>
                        <!-- end b_cert -->



                        <!-- gmoral -->
                        

                   

                      <div class="mt-4 reg_local" >
                      
                          <!-- select field -->
                       <div class="my-4">
                               <label for="selectgmoral" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Good Moral</label>
                            <select id="selectgmoral" name='selectgmoral' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>

                       </div>

                         <!-- display profileImg -->
                    <div class="flex flex-col justify-center items-center h-full form-local3 hidden">
                        <label for="gmoral" class="cursor-pointer " title="Choose file">
                        
                          <div id='gmoralImgPreview' class='shadow-1 border-1 bg-[#eaeaea] p-[60px]  rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'>Good Moral</p> 
                          </div>
                        

                         </div>
                        </label>
                      <input type="file" name="gmoral" id="gmoral" class="invisible" accept="image/*" required>
                         <label id="gmoral-error" class="error hidden" for="gmoral">This field is required.</label>
                 
                     </div>
                        


                      <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_local__4' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_local__4' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                        </div>



                      </div>
                        <!-- end gmoral -->


                   <!-- rec_letter -->
                        

                   

                      <div class="mt-4 reg_local" >
                      
                          <!-- select field -->
                          <div class='my-4'>
                                <label for="select_rec_letter" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Letter of Recommendation</label>
                            <select id="select_rec_letter" name='select_rec_letter' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>

                          </div>

                      <div class="flex flex-col justify-center items-center h-full form-local4 hidden">
                           <!-- display profileImg -->
                       <label for="rec_letter" class="cursor-pointer " title="Choose file">
                        
                          <div id='recLetterImgPreview' class='shadow-1 border-1 bg-[#eaeaea] mx-auto p-[60px] rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'>Letter of Recommendation</p> 
                          </div>
                        

                         </div>
                        </label>
                         <input type="file" name="rec_letter" id="rec_letter" class="invisible" accept="image/*" required>
                         <label id="rec_letter-error" class="error hidden" for="rec_letter">This field is required.</label>
                 

                      </div>
                     

                         <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_local__5' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_local__5' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                        </div>



                      </div>
                        <!-- end rec_letter -->



                        
                   <!-- med_cert -->
                        

                   

                      <div class="mt-4 reg_local">
                      
                          <!-- select field -->
                        <div class="my-4">
                                <label for="select_med_cert" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Medical Certificate</label>
                            <select id="select_med_cert" name='select_med_cert' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>

                        </div>

                         <!-- display profileImg -->
                     <div class="flex flex-col justify-center items-center h-full form-local5 hidden">
                         <label for="med_cert" class="cursor-pointer " title="Choose file">
                        
                          <div id='medCertImgPreview' class='shadow-1 border-1 bg-[#eaeaea] p-[60px] rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'> Medical Certificate</p> 
                          </div>
                        

                         </div>
                        </label>

                         <input type="file" name="med_cert" id="med_cert" class="invisible" accept="image/*" required>
                         <label id="med_cert-error" class="error hidden" for="med_cert">This field is required.</label>
                 
                      </div>
                      
                       



                          <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_local__6' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_local__6' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                        </div>


                      </div>
                        <!-- end med_cert -->



                      </div>
                    

                      





                      </div>

                      <div id='foreign' class='hidden'>
                             <div class="mt-4 reg_foreign">
                      
                        <!-- stud_permit -->

                          <!-- select field -->
                        <div class="my-4">
                              <label for="select_stud_permit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Study permit</label>
                            <select id="select_stud_permit" name='select_stud_permit' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>
                        </div>


                         <!-- display profileImg -->

                         <div class="flex flex-col justify-center items-center h-full form-foreign1 hidden">
                        <label for="stud_permit" class="cursor-pointer " title="Choose file">
                        
                          <div id='studImgPreview' class='shadow-1 border-1 bg-[#eaeaea] p-[60px] rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'>Study Permit</p> 
                          </div>
                        

                         </div>
                        </label>
                      
                        <input type="file" name="stud_permit" id="stud_permit" class="invisible" accept="image/*" required>
                         <label id="stud_permit-error" class="error hidden" for="stud_permit">This field is required.</label>
                 

                        </div>

                    
                          <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_foreign__1' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_foreign__1' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                          </div>

                      </div>
                        <!-- end stud_permit -->

                    
                             <div class="mt-4 reg_foreign" >
                      
                        <!-- stud_permit -->

                          <!-- select field -->
                         <div class="my-4">
                               <label for="select_alien_cert" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alien Certification</label>
                            <select id="select_alien_cert" name='select_alien_cert' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>
                         </div>


                         <!-- display alien_cert -->

                          <div class="flex flex-col justify-center items-center h-full form-foreign2 hidden">
                              <label for="alien_cert" class="cursor-pointer " title="Choose file">
                        
                          <div id='alienImgPreview' class='shadow-1 border-1 bg-[#eaeaea] mx-auto px-5 p-[60px] rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'>Alien Cerfication of REG,ACR,CARD</p> 
                          </div>
                        

                         </div>
                        </label>
                      
                        <input type="file" name="alien_cert" id="alien_cert" class="invisible" accept="image/*" required>
                         <label id="alien_cert-error" class="error hidden" for="alien_cert">This field is required.</label>
                         </div>

                     
                 
                          <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_foreign__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_foreign__2' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>

                          </div>




                      </div>
                        <!-- end passport -->



                        
                             <div class="mt-4 reg_foreign">
                      
                        <!-- stud_permit -->

                          <!-- select field -->
                            <div class="my-4">
                                <label for="select_passport_copy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Passport</label>
                            <select id="select_passport_copy" name='select_passport_copy' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>
                            </div>


                         <!-- display alien_cert -->
                          <div class="flex flex-col justify-center items-center h-full form-foreign3 hidden">
                             <label for="passport_copy" class="cursor-pointer " title="Choose file">
                        
                          <div id='passportImgPreview' class='shadow-1 border-1 bg-[#eaeaea] p-[60px] rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'>Passport copy</p> 
                          </div>
                        

                         </div>
                        </label>
                      
                        <input type="file" name="passport_copy" id="passport_copy" class="invisible" accept="image/*" required>
                         <label id="passport_copy-error" class="error hidden" for="passport_copy">This field is required.</label>
                 
                         </div>

                    


                          <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_foreign__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_foreign__3' type="submit" data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>

                          </div>


                      </div>
                        <!-- end passport -->



                             
                        <div class="mt-4 reg_foreign">
                      
                        <!-- auth_rec -->

                          <!-- select field -->
                           <div class="my-4">
                               <label for="select_auth_rec" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Authenticated School Records</label>
                            <select id="select_auth_rec" name='select_auth_rec' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                  <option  value='' selected>Choose</option>
                                  <option value="upload">upload</option>
                                  <option value="to follow">to follow</option>  
                            </select>

                           </div>

                         <!-- display alien_cert -->

                          <div class="flex flex-col justify-center items-center h-full form-foreign4 hidden">
                             <label for="auth_rec" class="cursor-pointer " title="Choose file">
                        
                              <div id='authImgPreview' class='shadow-1 border-1 bg-[#eaeaea] p-[80px] rounded'>
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                              <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                                <p class='default-img text-gray-600 text-center text-sm font'>Authenticated School Records</p> 
                                </div>
                              

                              </div>
                          </label>
                        
                        <input type="file" name="auth_rec" id="auth_rec" class="invisible" accept="image/*" required>
                         <label id=" auth_rec-error" class="error hidden" for=" auth_rec">This field is required.</label>
                 
                          </div>

                      



                          <div class="flex justify-between items-center mt-5">
                          <button id='prev-button_foreign__4' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                          <button id='next-button_foreign__4' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                          </div>

                      </div>
                        <!-- end  auth_rec -->
                    

                 
                    

                    
                    </div>


                   <div id='lastCallBtn' class="flex justify-between items-center mt-5 hidden">
                     <button id='prev-button__11' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__11' type="submit" data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                   </div>
                </fieldset>

          

    
            <!-- end type of submitted form -->

             <fieldset id='enroolmentDetails' class='proceedFieldset reg_class'>
                 <div class="flex flex-col justify-center items-center shadow-1 bg-white border border-teal-100 p-5">
                  <h1 class="font-bold text-xl">Registration Successful!</h1>
                  <p class="text-center">Congratulations on completing the registration process! Please remember your reference number for the enrollment process.</p>
                <p><strong class='mr-2 text-base'>Your Reference Number:  </strong><span id='refLabel' ></span></p>
                <svg  id="barcodeSVG" width="347" height="147"></svg>
                  <div class="flex justify-between items-center gap-2 my-2 w-full px-3 mx-auto">
                      <label id='downloadFile' class="text-indigo-800 font-medium cursor-pointer"><a>Download</a></label>
                       <label id='copyText' class="font-medium cursor-pointer text-indigo-800">Copy</label>
                  </div>
       

                  <p><strong>Instructions:</strong></p>
                  <ol class="text-sm text-center leading-6">
                  <li>Copy or Download the reference number containing your reference number or paste this the reference number in a secure place.</li>
                  <li>Proceed to the school registrar with your reference number.</li>
                  <li>Do not share your reference number with others.</li>
                  <li>If you have any issues, feel free to contact our support team. <a class="text-indigo-800" href="#">biometricteam@info.ph</a></li>

                   <p class="text-indigo-800 flex justify-center my-2"><a href='page?=registration'>Refresh</a></p>
                  </ol>
                  </div>
              
             </fieldset>       

  </form>