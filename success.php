<?php
require_once 'config.php';
require_once 'Database.php';
session_start();
$db = connect(DB_SERVER,USER,PASSWORD,DB_NAME);

$id = selectStudentId($db,$_SESSION['adm_number']);

$checked_unit = $_POST['check'];

if(isset($_POST['btn_submit'])){
   var_dump($id);
}

