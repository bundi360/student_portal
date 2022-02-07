<?php
require_once 'config.php';
require_once 'Database.php';
session_start();
$db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);



if (isset($_POST['examcard'])) {
    echo "<h2>Exam Card</h2>";
    $std_id = selectStudentId($db, $_SESSION['adm_number']);
    foreach ($std_id as $id) {
        $units = selectUnitsRegistered($db, $id);
        foreach ($units as $unit) {
            echo $unit['course_code'] . " " . $unit['course_name'] . "</br>";
        }
    }
} else {
    $std_id = selectStudentId($db, $_SESSION['adm_number']);
    foreach ($std_id as $id) {
        $units = selectUnitsRegistered($db, $id);
        foreach ($units as $unit) {
            $id = $unit['ID'];
        }
    }

    $result = viewResult($db, $id, $_SESSION['adm_number']);

    foreach ($result as $res) {
        echo $res['course_code'] . " " . $res['course_name'] . " " . $res['result'] . "</br>";
    }
}
