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
    if ($db->query($sql)) {
        $db = new mysqli(
            $server,
            $user,
            $password,
            $db_name
        );
    }


    $sql1 = "CREATE TABLE IF NOT EXISTS student_details (ID int(11) AUTO_INCREMENT, 
    `name` varchar(255) NOT NULL,
    adm_number varchar(255) NOT NULL,
    sem varchar(34) not null,
    PRIMARY KEY  (ID))";

    if ($db->query($sql1)) {
        // echo "created  successfully";
    } else {
        //  echo "could not create" . mysqli_error($db);
    }
    $sql2 = "CREATE TABLE IF NOT EXISTS course_details (ID int(11) AUTO_INCREMENT,
`course_code` varchar(255) NOT NULL,
course_name varchar(255) NOT NULL,

PRIMARY KEY  (ID))";
    if ($db->query($sql2) === true) {
    }



    $sql3 = "CREATE TABLE IF NOT EXISTS result_entry (unit_id int (30) not null,
`adm_no` varchar(255) NOT NULL,
result int (20) NOT NULL)";

    if ($db->query($sql3) === true) {
        // echo "created 3 successfully";
    }



    $sql4 = "CREATE TABLE IF NOT EXISTS student_course (course_id int (20) not null,
student_id int (20) not null,
FOREIGN KEY (course_id) REFERENCES course_details(id),
FOREIGN KEY (student_id) REFERENCES student_details(id))";

    if ($db->query($sql4) === true) {
        //echo "created 4 successfully";
    }


    return $db;
}

// function inserIntoCourses(mysqli $db)
// {
//     $sql = "INSERT IGNORE INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs301','Database Admin')";
//     $db->query($sql);
//     $sql = "INSERT IGNORE INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs303','principles of programming language')";
//     $db->query($sql);
//     $sql = "INSERT IGNORE INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs305','Compiler Design')";
//     $db->query($sql);
//     $sql = "INSERT IGNORE  INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs307','Design of algos')";
//     $db->query($sql);
//     $sql = "INSERT IGNORE INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs309','group project')";
//     $db->query($sql);
//     $sql = "INSERT IGNORE INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs311','name')";
//     $db->query($sql);
//     $sql = "INSERT IGNORE INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs315','Intelligent systems')";
//     $db->query($sql);
// }

function displayUnits(mysqli $db)
{
    $data = [];
    $sql = "SELECT DISTINCT course_code,course_name FROM course_details ORDER BY course_code";
    $resultset = $db->query($sql);

    while ($row = $resultset->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}
function insertToStudents(mysqli $db, array $record)
{
    $sql = "INSERT INTO student_details(`name`,`adm_number`,`sem`) VALUES('$record[0]','$record[1]','$record[2]')";


    if ($db->query($sql)) {
        // echo "records inserted succefully";
    } else {
        echo "failed";
    }
}

function insertRegisterdUnits(mysqli $db, $cors_id, $std_id)
{
    $sql = "INSERT INTO student_course (course_id,student_id) VALUES($cors_id,$std_id)";
    $db->query($sql);
}

function selectStudentId(mysqli $db, $std_adm)
{

    $sql = "SELECT ID FROM student_details WHERE `adm_number` = '$std_adm'";
    $resultset =  $db->query($sql);

    while ($row = $resultset->fetch_assoc()) {
        $id = $row;
    }

    return $id;
}

function obtainCourseId(mysqli $db, array $checked_unit)
{
    $ids = [];
    foreach ($checked_unit as $unit) {
        $sql = "SELECT ID FROM course_details where course_code = '$unit'";
        $resultset = $db->query($sql);

        while ($row = $resultset->fetch_assoc()) {
            $ids[] = $row;
        }
    }
    return $ids;
}

function selectStudents(mysqli $db, $adm_no)
{
    $sql = "SELECT ID,`name`    FROM student_details where adm_number = '$adm_no'";
    $resultset = $db->query($sql);

    if (mysqli_num_rows($resultset) < 1) {
        echo "no such student exists";
    } else {
        $data = [];
        while ($row = $resultset->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}

function selectUnitsRegistered(mysqli $db, $std_id)
{
    $sql = "SELECT ID, `course_code`, `course_name` FROM `student_course` join course_details ON id = course_id WHERE student_id = '$std_id'";
    $resultset = $db->query($sql);
    $data = [];

    while ($row = $resultset->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function insertToResult_entry(mysqli $db, $count, $unit_id, $adm, array $resultset)
{

    for ($i = $count; $i < sizeof($resultset); $i++) {
        $sql = "INSERT INTO result_entry (unit_id,adm_no,result) VALUES ('$unit_id','$adm','$resultset[$i]')";
        $db->query($sql);
        break;
    }
}

function viewResult(mysqli $db, $unit_id, $adm_no)
{
    $sql = "SELECT course_code, course_name,result FROM `result_entry` JOIN course_details ON id='$unit_id' JOIN student_details ON adm_number = '$adm_no'";
    $resultset = $db->query($sql);
    $data = [];

    if(mysqli_num_rows($resultset)<1){
        echo "<h2> your results have not been posted yet </h2>";
    }else{
        while($row = $resultset->fetch_assoc()){
            $data[]=$row;
        }
        return $data;
    }
}
