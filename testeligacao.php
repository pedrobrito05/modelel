<?php
$username2 = 'filemanager';
$password2 = 'Benfica05';
$dbname2 = 'filemanager';
$hostname2 = 'localhost';

// Create connection
$conn2 = mysqli_connect($hostname2, $username2, $password2, $dbname2);
if(!$conn2){
    echo "Database connection error".mysqli_connect_error();
} else {
    echo "Connection successful!";
}

$fileName = "Teste";
$fileSize = "20";
$fname = "dredfname";
$lname = "dredlname";
  
$sql2 = "INSERT INTO files (name, size, uploader_fname, uploader_lname) 
         VALUES ('{$fileName}', '{$fileSize}', '{$fname}', '{$lname}')";

if(mysqli_query($conn2, $sql2)) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . mysqli_error($conn2);
}

mysqli_close($conn2);
?>
