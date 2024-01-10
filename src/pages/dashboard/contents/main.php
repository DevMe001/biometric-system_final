
<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$yearLevel = $controller->getYearLevel();

$sections = $controller->getSections();
$studentRecord = $controller->getStudentRecords();
$studentList = $controller->getMasterStudentsRecord();


$getSchoolYear = $controller->getSchoolYear();
$subjectList = $controller->getSubjects();
$classList = $controller->getClassRecords();
$teacher = $controller->getTeacherDetails();

$attendance_list = $controller->getAttendanceList();
$getTeacherAttendance = $controller->getTeacherAttendanceView($_SESSION['users']['id']);

$getStudentCoutPerTeacher = $controller->getCountStudentPerTeacher($_SESSION['users']['id']);

$countStudents = count($studentRecord) ?? 0;
$countSubject = count($subjectList) ?? 0;
$countsections = count($sections) ?? 0;
$countClass = count($classList) ?? 0;
$countTeacher = count($teacher) ?? 0;
$countLevel = count($yearLevel) ?? 0;

$countAttendance = count($attendance_list) ?? 0;
$countTeacherViewAttendance = count($getTeacherAttendance) ?? 0;

$countStudentPerTeacher = count($getStudentCoutPerTeacher) ?? 0;

$countStudentList = count($studentList) ?? 0;


// getschoolyear
$schoolYear = "SY-$getSchoolYear[start_date] - $getSchoolYear[end_date]";
$startDate = date('Y', strtotime($getSchoolYear['start_date']));
$endDate = $getSchoolYear['end_date'];


?>


<div  class="cardBox">
  <?php
    if(isset($_SESSION['users'])){
      $role = $_SESSION['users']['role'];

      if($role == 1){
        ?>
        
  <div id='goToScholYear' data-tabIndex='#tab7' class="card">
    <div>
      <div class="numbers"><?php echo $startDate ?>
                </div>
                <div class="cardName">Current School Year</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="school-outline"></ion-icon>
              </div>
            </div>
        

           <div data-tabIndex='#tab1' class="card">
              <div>
                <div class="numbers">
                 <?php echo $countStudentList ?>
                  </div>
                  <div class="cardName">Students list</div>
                </div>
          
                <div class="iconBx">
                  <ion-icon name="home-outline"></ion-icon>
                </div>
              </div>

                <div data-tabIndex='#tab1' class="card">
                  <div>
                    <div class="numbers">
                  <?php echo $countStudents ?>
                </div>
                <div class="cardName">Students Enrolled</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="home-outline"></ion-icon>
              </div>
            </div>
        
            <div data-tabIndex='#tab4' class="card">
              <div>
                <div class="numbers">
                  <?php echo $countSubject ?>
                </div>
                <div class="cardName">Subjects</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="bookmarks-outline"></ion-icon>
              </div>
            </div>
        
            <div data-tabIndex='#tab6' class="card">
              <div>
                <div class="numbers">
                  <?php echo $countLevel ?>
                </div>
                <div class="cardName">Grade Level</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="speedometer-outline"></ion-icon>
              </div>
            </div>
            <div data-tabIndex='#tab3' class="card">
              <div>
                <div class="numbers">
                  <?php echo $countsections ?>
                </div>
                <div class="cardName">Sections</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="subway-outline"></ion-icon>
              </div>
            </div>
            <div data-tabIndex='#tab5' class="card">
              <div>
                <div class="numbers">
                  <?php echo $countClass ?>
                </div>
                <div class="cardName">Class</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="folder-open-outline"></ion-icon>
              </div>
            </div>
        
            <div data-tabIndex='#tab2' class="card">
              <div>
                <div class="numbers">
                  <?php echo $countTeacher ?>
                </div>
                <div class="cardName">Teachers</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="person-outline"></ion-icon>
              </div>
            </div>
     
            <div data-tabIndex='#tab8' class="card">
              <div class="numbers">
                <?php echo $countAttendance ?>
                <div class="cardName">Attendance</div>
              </div>
        
              <div class="iconBx">
                <ion-icon name="finger-print-outline"></ion-icon>
                <!-- <ion-icon name="receipt-outline"></ion-icon> -->
              </div>
            </div>
        <?php
      }else{
        ?>
      
  <div id='goToScholYear' data-tabIndex='#tab7' class="card">
    <div>
      <div class="numbers"><?php echo $startDate ?>
              </div>
              <div class="cardName">Current School Year</div>
            </div>
      
            <div class="iconBx">
              <ion-icon name="school-outline"></ion-icon>
            </div>
          </div>
      
        
  
        
         

          <div data-tabIndex='#tab8' class="card">
            <div>
              <div class="numbers"><?php echo $countTeacherViewAttendance ?></div>
              <div class="cardName">Attendance</div>
            </div>
      
            <div class="iconBx">
              <ion-icon name="finger-print-outline"></ion-icon>
              <!-- <ion-icon name="receipt-outline"></ion-icon> -->
            </div>
          </div>
        <?php
      }
    }
  ?>
</div>



  <!-- ================= New Customers ================ -->




