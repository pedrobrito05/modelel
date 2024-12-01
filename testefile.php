<?php
function listarConteudo($dir) {
    if (is_dir($dir)) {
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false) {
            
            if ($file != "." && $file != "..") {
                echo "ola";
                $path = $dir . "/" . $file;
                if (is_file($path)) {
                    echo "<a href='javascript:void(0);' onclick='openPreview(\"$path\");'>$file</a><br>";
                } elseif (is_dir($path)) {
                    echo "<a href='?dir=$path'>$file/</a><br>";
                }
            }
        }
        closedir($dh);
    }
}

$baseDir = "uploads/";
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : $baseDir;

// Verifica se um diretório específico foi solicitado
if ($currentDir !== $baseDir && is_dir($currentDir)) {
    listarConteudo($currentDir);
} else {
    // Lista o conteúdo do diretório base
    listarConteudo($baseDir);
}

function openPreview($file) {
    echo "<script>window.open('$file', 'preview', 'height=500,width=500');</script>";
}
?>

<script>
function openPreview(file) {
    window.open(file, 'preview', 'height=500,width=500');
}
</script>
