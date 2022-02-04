<?php

require_once 'Database.php';
require_once "config.php";
$db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);
$data = displayUnits($db);
session_start();


$_SESSION['name'] = $_POST['name'];
$_SESSION['adm_number'] = $_POST['admissionNo'];
$_SESSION['sem'] = $_POST['current_semester'];
$values = array($_SESSION['name'], $_SESSION['adm_number'], $_SESSION['sem']);

//inserting into student_details table
if (isset($_POST['btn_register'])) {

    insertToStudents($db, $values);
}
echo "<h2> Select the units you wish to register </h2>";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

</head>

<body>
    <?php
   
    foreach ($data  as $val) {
    ?>

        <form>
            <input type='checkbox' name='check'><?php echo"". $val['course_code']. " ". $val['course_name']; ?>


        </form>
    <?php
    } ?>
    <form method="POST" action="success.php">
        <button name="btn_submit">SUBMIT</button>
    </form>
</body>

</html>