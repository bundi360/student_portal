<?php
require_once 'Database.php';
require_once "config.php";
$db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);

$data = displayUnits($db);
$name = $_POST['name'];
$adm_number = $_POST['admissionNo'];
$sem = $_POST['current_semester'];
$values = array($name, $adm_number, $sem);
if (isset($_POST['btn_register'])) {

    insertToStudents($db, $values);
}

foreach ($data  as $val) {
    echo "<form>";
    echo "<input type = 'checkbox' name = 'check'>" . $val['course_code'] . " " . $val['course_name'];


    echo "</form>";
}
echo "<button type='submit' name='sbt_units'>SUBMIT</button>";
