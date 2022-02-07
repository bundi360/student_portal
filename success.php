<?php
require_once 'config.php';
require_once 'Database.php';
session_start();
$db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);


$std_id = selectStudentId($db, $_SESSION['adm_number']); //select current user student id


$checked_unit = $_POST['check'];
$course_ids = obtainCourseId($db, $checked_unit); // ids of all selected units


if (isset($_POST['btn_submit'])) {
   //some bullshit code
   for ($i = 0; $i < sizeof($course_ids); $i++) {
      foreach ($course_ids[$i] as $course_id) {
         foreach ($std_id as $id) {
            insertRegisterdUnits($db, $course_id, $id);
         }
      }
   }

   


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   
</head>
<body>
 <h3>  <?php echo "successfully registered for the units, you can proceed to view your exam card or print transcript:";
 ?> </h3>
<form method="post" action="documents.php">
 <div>
    <button type="submit" name="examcard">ExamCard</button>
 </div>
</br>
 <div>
    <button type="submit" name="Transcript">Transcript</button>
 </div>
 </form>
</body>
</html>
