<?php

require_once 'Database.php';
require_once "config.php";
$db = connect(DB_SERVER, USER, PASSWORD, DB_NAME);
session_start();
$_SESSION['adm_no']= $_POST['adm_no'];
$data = selectStudents($db, $_SESSION['adm_no']);
$std_id;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

</head>

<body>



   
     <h2>Insert results for: <?php echo $_SESSION['adm_no']  ?></h2>
<?php
    foreach ($data as $val) { ?>
        <form method="post" action="post.php">
           
        <?php $std_id = $val['ID'];
    } ?>
        <?php
        $units = selectUnitsRegistered($db, $std_id);

        foreach ($units as $unit) {
            echo $unit['course_code'] . " " . $unit['course_name'] . " "; ?>
            <div>
                <input type="text" name="result_field[]">
            </div>


        <?php
        }

        ?>


        <div>
            <button type="submit" name="post">POST</button>
        </div>





        </form>
</body>

</html>