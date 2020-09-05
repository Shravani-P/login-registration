<?php
$con = mysqli_connect("localhost", "root", "", "Sample");
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// else {
//    echo 'connection successful';
//}
?>
