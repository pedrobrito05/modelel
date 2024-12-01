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
                      <br><td><a href='#' class='preview-btn' data-src='$filePath'>Preview</a></td>
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
<script>
    const previewBtns = document.querySelectorAll('.preview-btn');
    const previewModal = document.createElement('div');
    const previewFrame = document.createElement('iframe');
    const closeBtn = document.createElement('button');

    // Styling for the preview modal
    previewModal.style.position = 'fixed';
    previewModal.style.top = '0';
    previewModal.style.left = '0';
    previewModal.style.width = '100%';
    previewModal.style.height = '100%';
    previewModal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    previewModal.style.display = 'none';
    previewModal.style.zIndex = '9999';
    previewFrame.style.width = '90vw';
    previewFrame.style.height = '80vh';
    previewFrame.style.display = 'block';
    previewFrame.style.margin = 'auto';
    previewFrame.style.marginTop = '5vh';
    closeBtn.style.position = 'absolute';
    closeBtn.style.top = '2vh';
    closeBtn.style.right = '2vh';
    closeBtn.style.padding = '0.5rem';
    closeBtn.style.fontSize = '1.2rem';
    closeBtn.style.borderRadius = '50%';
    closeBtn.style.backgroundColor = '#fff';
    closeBtn.style.color = '#000';
    closeBtn.style.border = 'none';
    closeBtn.style.cursor = 'pointer';
    closeBtn.textContent = 'X';

    // Add the preview frame and close button to the preview modal
    previewModal.appendChild(previewFrame);
    previewModal.appendChild(closeBtn);
    document.body.appendChild(previewModal);

    previewBtns.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const src = e.currentTarget.getAttribute('data-src');
            previewFrame.setAttribute('src', src);
            previewModal.style.display = 'block';
        });
    });

    closeBtn.addEventListener('click', () => {
        previewModal.style.display = 'none';
        previewFrame.setAttribute('src', '');
    });
</script>


   
