<?php

function connect($server, $user, $password, $db_name)
{
    $db = new mysqli(
        $server,
        $user,
        $password
    );

    
    $sql = "CREATE DATABASE IF NOT EXISTS student_portal";
    $db->query($sql);    

   $sql1 = "CREATE TABLE IF NOT EXISTS student_details (ID int(11) AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
adm_number varchar(255) NOT NULL,
sem int(4) not null,
PRIMARY KEY  (ID))";

if($db->query($sql1)===true){
    echo "created 1 successfully";
}
$sql2 = "CREATE TABLE IF NOT EXISTS course_details (ID int(11) AUTO_INCREMENT,
`course_code` varchar(255) NOT NULL,
course_name varchar(255) NOT NULL,
PRIMARY KEY  (ID))";
if($db->query($sql2)===true){
    echo "created 2 successfully";
}

$sql3 = "CREATE TABLE IF NOT EXISTS result_entry (unit_id int (30) not null,
`adm_no` varchar(255) NOT NULL,
result int (20) NOT NULL)";

if($db->query($sql3)===true){
    echo "created 3 successfully";
}



$sql4 = "CREATE TABLE IF NOT EXISTS student_course (course_id int (20) not null,
student_id int (20) not null,
FOREIGN KEY (course_id) REFERENCES course_details(id),
FOREIGN KEY (student_id) REFERENCES student_details(id))";

if($db->query($sql4)===true){
    echo "created 4 successfully";
}




}

function xiv(mysqli $db){

}


    ?>

