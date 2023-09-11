<?php
if (isset($_POST["submit"])) {
    if ($_FILES && $_FILES["newImg"]["error"] == UPLOAD_ERR_OK) {
        $dir = "img/";
        $filename = uniqueFile(basename($_FILES['newImg']['name']), $dir);

        // отделяем имя файла от разрешения
        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

        // добавляем к имени дату
        $name = $dir . $filename;

        move_uploaded_file($_FILES["newImg"]["tmp_name"], $name);

        header("Location: index.php");
        exit;
    }
}

function uniqueFile($filename, $dir): string
{
    // выделяем разрешение
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // выделяем имя файла
    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

    $fileFullName = $dir . $filename;
    $counter = 1;

    // Проверяем, существует ли файл с таким именем
    if (file_exists($fileFullName)) {
        $baseName = $filenameWithoutExtension . "_" . $counter;
        $filename = $baseName . "." . $extension;
        $counter++;
    }
    return $filename;
}

function getPicArray($dir): array
{
    return glob("{$dir}*");
}