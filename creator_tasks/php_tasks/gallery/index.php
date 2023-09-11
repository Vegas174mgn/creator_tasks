<?php
session_start();

require_once "galleryHandler.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-file">
    <form method="post" action="galleryHandler.php" enctype="multipart/form-data">
        <input type="file" class=".form-control-file" id="file-uploader"
               accept="image/png,image/jpeg,image/bmp,image/gif" name="newImg">
        <input type="submit" value="Send" name="submit">
    </form>
</div>
<div class="container">
    <div class="row row-cols">
        <?php foreach (getPicArray("img/") as $pic): ?>
            <div class="col">
                <img class="pic" src="<?= $pic ?>" alt="Какое-то изображение"/>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
