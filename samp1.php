<?php

if (isset($_POST['data'])) {
    $z = $_POST['data']; 


    if ($z === 'hidden') {

        include('db.php');

        $sql = "INSERT INTO sample(name,country)VALUES('Franklin','USA');";


        if($conn->query($sql) === TRUE){
            echo"nice";
            header('Location: staff main.php');
            exit();
        }

    } else {
        echo "No";  
    }
} else {
    echo "No data received.";  
}
?>
