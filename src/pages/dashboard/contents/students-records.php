
<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/fingerprint.css') ?>">


<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$yearLevel = $controller->getYearLevel();

$sections = $controller->getClassSection();
$enrollmentRecord = $controller->getStudentRecords();
$getSchoolYear = $controller->getSchoolYear();
$getMasterStudentRecord = $controller->getMasterStudentsRecord();


$totalEnroll = count($enrollmentRecord);

$totalStudents = count($getMasterStudentRecord);
// getschoolyear
// $schoolYear = "SY-{$getSchoolYear['start_date']}-{$getSchoolYear['end_date']}";
$startYear = date('Y', strtotime($getSchoolYear['start_date']));
$endYear = date('Y', strtotime($getSchoolYear['end_date']));
$schoolYear = "SY-$startYear-$endYear";

$startDate = $getSchoolYear['start_date'];
$endDate = $getSchoolYear['end_date'];
?>



<div class='flex gap-2 items-center mb-2 p-5 no-print'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Student Record </p>
</div>

<div class='w-[90%] mx-auto'>


  <!-- breadcrums  -->

  <div id='studentTabs'>

 <ul class="flex gap-5 my-4">
  <li id='showMaster' class="outline outline-offset-2 outline-1 outline-indigo-500 rounded p-2 text-indigo-500 hover:bg-indigo-800 hover:text-white">Student List</li>
  <li id='showEnrollment' class="outline outline-offset-2 outline-1 outline-indigo-500 rounded p-2 text-indigo-500 hover:bg-indigo-800 hover:text-white">Enrollment</li>
 </ul>

  </div>

  <div id='master-list'>
    <?php include('master-list.php') ?>
  </div>

  <div id='enrollment-list' class='hidden'>
    <?php include('enrollment-list.php') ?>
  </div>


  <!-- view list -->


</div>





<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
  integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

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

  <script src='<?php echo baseUrlScriptSrc('/js/es6-shim.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/websdk.client.bundle.min.js') ?>'></script>
   <script src='<?php echo baseUrlScriptSrc('/js/fingerprint.sdk.min.js') ?>'></script>
    <script src='<?php echo baseUrlScriptSrc('/js/html5-qrcode.min.js') ?>'></script>




<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/fingerprint.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/studentRecFunction.js') ?>'></script>
<!-- <script src='<?php echo baseUrlScriptSrc('/js/features/masterStudentListFunction.js') ?>'></script>  -->

<script src='<?php echo baseUrlScriptSrc('/js/face-api.min.js') ?>'></script>



<script>

$('#showMaster').on('click', function () {

  $('#master-list').removeClass('hidden');
  $('#enrollment-list').addClass('hidden');
  $('.master-view').addClass('hidden');
  $('.master-default').removeClass('hidden');
})

$('#showEnrollment').on('click', function () {
 
  $('#enrollment-list').removeClass('hidden')
  $('#master-list').addClass('hidden');
})



$('#backMasterList').on('click', function () {
  location.href='?page=dashboard';
  localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: '', message: '' }));

});

 function enableSelect() {
      var selectElement = document.getElementById('mySelect');
      selectElement.removeAttribute('disabled');
      // Optionally, reset to the first option when enabling
      selectElement.selectedIndex = 0;
    }



    let fileParams = new URLSearchParams(window.location.search);
    
    if(fileParams.get('file') == 1){
      
    }


</script>
