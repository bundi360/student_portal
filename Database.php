<?php
function connect($server, $user, $password, $db_name)
{
    $db = new mysqli(
        $server,
        $user,
        $password
    );


    $sql = "CREATE DATABASE IF NOT EXISTS student_portal";

    if ($db->query($sql) === true) {
        $db = new mysqli(
            $server,
            $user,
            $password,
            $db_name
        );
      //  echo "database created\n";
    } else {
      //  echo "could not create\n";
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
       // echo "created 2 successfully";
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
    inserIntoCourses($db);

    return $db;
}

function inserIntoCourses(mysqli $db)
{
    $sql = "INSERT  INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs 301','Database Admin')";
    $db->query($sql);
    $sql = "INSERT  INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs 303','principles of programming language')";
    $db->query($sql);
    $sql = "INSERT  INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs 305','Compiler Design')";
    $db->query($sql);
    $sql = "INSERT   INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs 307','Design of algos')";
    $db->query($sql);
    $sql = "INSERT INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs 309','group project')";
    $db->query($sql);
    $sql = "INSERT INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs 311','name')";
    $db->query($sql);
    $sql = "INSERT INTO `course_details`(`course_code`, `course_name`) VALUES ('ccs 315','Intelligent systems')";
    $db->query($sql);
}

function displayUnits(mysqli $db){
    $data = [];
    $sql = "SELECT DISTINCT course_code,course_name FROM course_details ORDER BY course_code";
    $resultSet = $db->query($sql);

    while($row = $resultSet->fetch_assoc()){
        $data[]=$row;
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
