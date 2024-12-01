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




$dir = 'uploads';
if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
}

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileDestination = realpath($dir) . '/' . $fileName;
    move_uploaded_file($fileTmpName, $fileDestination);
}


	

$uploader_fname=$row2['uploader_fname'];
$files = scandir($dir);
foreach ($files as $file) {
    $sql2 = mysqli_query($conn2, "SELECT * FROM files WHERE namef = '$file'");
    if(mysqli_num_rows($sql2) > 0){
    $row2 = mysqli_fetch_assoc($sql2);
    $uploader_fname=$row2['uploader_fname'];
}
    if ($file !== '.' && $file !== '..') {
        $filePath = $dir . '/' . $file;
        $fileSize = filesize($filePath);

        if (is_dir($filePath)) {
            echo "<tr>
                      <br><td><a href='?dir=$filePath'>$file/</a></td>
                      <br><td></td>
                      <br><td></td>
                      <br><td></td>
                  </tr>";
        } else {
            echo "<tr>
                      <br><td>$file</td>
                      <br><td>Autor: $uploader_fname</td>
                      <br><td>$fileSize bytes</td>
                      <br><td><a href='$filePath' download>Download</a></td>
                      <br><td><a href='?delete=$filePath' id='delete-file'>Delete</a></td>
                  </tr>";
        }
    }
}

if (isset($_GET['delete'])) {
    $file = $_GET['delete'];
    if (file_exists($file)) {
        if (is_dir($file)) {
            rmdir($file);
        } else {
            unlink($file);
        }
        header("Location: https://esa.ib6.pt/teste2file.php");
        exit();
    }
}

?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">Upload</button>
</form>
