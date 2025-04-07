<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $originalID =  $_POST['idOrig'];
    $id =  $_POST['idNum'];
    $name = $_POST['fullName'];
    $gender = $_POST['gender'];
    $gradeLvl = $_POST['gradelvl'];
    $section = $_POST['section'];

    include('db.php');

    $sql = "UPDATE shs_students_data set id_number = $id,full_name = '$name',gender = '$gender',grade_level = $gradeLvl,section = '$section' WHERE id_number = $originalID;";

    if($conn->query($sql) === TRUE){
        header("Location: student main.php?num=$id");
        exit();
    }
    else{
        echo "Error Code";
    }
}

?>