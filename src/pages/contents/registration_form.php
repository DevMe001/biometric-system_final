<style>
  .border-custom{
    border:1px solid #eaeaea !important;
  }

   [id*="-error"] {
   color:#ff3333  !important;
   text-transform: none !important;
}


</style>




<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/fingerprint.css') ?>">


    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>



<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$yearLevel = $controller->getYearLevel();

$sections = $controller->getSections();
$studentRecord = $controller->getStudentRecords();
$getSchoolYear = $controller->getSchoolYear();

$totalEnroll = count($studentRecord);
// getschoolyear
// $schoolYear = "SY-{$getSchoolYear['start_date']}-{$getSchoolYear['end_date']}";
$startYear = date('Y', strtotime($getSchoolYear['start_date']));
$endYear = date('Y', strtotime($getSchoolYear['end_date']));
$schoolYear = "SY-$startYear-$endYear";

$startDate = $getSchoolYear['start_date'];
$endDate = $getSchoolYear['end_date'];
?>



<div class='my-4 bg-white max-w-md mx-auto'>
          <legend id='formLabel' class='font-medium'>Applicant Personal Details</legend>


          <?php require_once('new.php') ?>

</div>







<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
  integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

<!-- <script>
  var scriptElement = document.querySelector("script[src='']");
  if (!scriptElement) {
    var newScript = document.createElement('script');
    newScript.src = '<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>';
    document.head.appendChild(newScript);
  }
</script> -->
<!-- <script src="http://localhost/biometric-system/src/js/es6-shim.js"></script>
  <script src="http://localhost/biometric-system/src/js/websdk.client.bundle.min.js"></script>
  <script src="http://localhost/biometric-system/src/js/fingerprint.sdk.min.js"></script> -->



<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/registorForm.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/face-api.min.js') ?>'></script>

<!-- 
<script>





$.validator.addMethod('email_restrict', function (value) {
    const reg = /^[\w.+\-]+@gmail\.com$/;
    return reg.test(value);
});

$.validator.addMethod('password_restrict', function (value) {
      const reg = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
      return reg.test(value);
  });

$('#regForm').validate({
  // rules
  rules:{
     floating_email:{
      required:true,
      email_restrict:true
      },
      floating_password:{
        required:true,
        password_restrict:true
      },
      username:{
        required:true
      }
  },
  messages: {
      floating_email: {
    required: "Email cannot be empty..",
    email_restrict:"Email is not valid."
    },
    username:'Username cannot be empty.',
      floating_password:{
        required: "Password  cannot be empty.",
        password_restrict: "Password must be (1 uppercase, 1 number, 1 special character, 8 character limit.",
      }
  },
  // message

   submitHandler:function(){


    var form = document.getElementById("regForm");
    var formData = new FormData(form);
  
    var data = {};

    for (var pair of formData.entries()) {
    data[pair[0]] = pair[1];
    }
                
   

  var req = indexedDB.deleteDatabase('user_forms');
  req.onsuccess = function () {
      console.log("Deleted database successfully");
  };
  req.onerror = function () {
      console.log("Couldn't delete database");
  };
  req.onblocked = function () {
      console.log("Couldn't delete database due to the operation being blocked");
  };


    
   const cache = indexedDB.open('user_forms',1);

   cache.onupgradeneeded =()=>{
    let res = cache.result;
    res.createObjectStore('data',{autoIncrement:true})
   }


   cache.onsuccess =()=>{
    let res = cache.result;

    let transaction = res.transaction('data','readwrite');
    let store =transaction.objectStore('data');

    store.put(data);

    
    $('#onEnroll').click();
   }
 



 



   

   }
  // submitHandler
})



</script> -->


  

 <!-- <script>
        // Function to change the class of the iframe
        function changeIframeClass(newClasses) {
            const iframe = document.getElementById('frameSrc');
            iframe.className = newClasses.join(' ');
        }


        function showMessage(msg,type){

          if(type === 'error'){
          Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: `Something went wrong!,${msg}`,
                  footer: ''
            })
          }else{
             Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: msg, 
                    showConfirmButton: false,
                    timer: 1500
           });
          }
            
        }


        // Listen for messages from the iframe content
        window.addEventListener('message', function(event) {
            if (event.origin !== window.location.origin) {
                return;
            }

            if (event.data.action === 'changeIframeClass') {
                changeIframeClass(event.data.newClasses);
            }
            if (event.data.action === 'showAlertMsg') {
                const data = event.data;
               showMessage(data.message,data.type);
            }
        });


    
        
</script>
 -->
