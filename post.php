<?php
require_once 'Database.php';
require_once "config.php";
session_start();
$result_field = $_POST['result_field'];
$sub_btn = $_POST['post'];

$db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);

//$adm_no = $_POST['adm_no'];
$data = selectStudents($db, $_SESSION['adm_no']);
$std_id;
foreach ($data as $val) {
    $std_id = $val['ID'];
}
$units = selectUnitsRegistered($db, $std_id);




if (isset($sub_btn)) {

    $count = 0;
    foreach ($units as $unit) {
        $id = $unit['ID'];
        insertToResult_entry($db, $count, $id, $_SESSION['adm_no'], $result_field);

        $count++;
    }




    echo "
        <script>
        window.location.href = 'admin.html';
        </script>
   ";
}
