<!DOCTYPE html>
<html>
<head>
    <title>5-3</title>
</head>
<body>
    Links to all exercises<br>
    <?php
    $files = array();
    foreach (new DirectoryIterator('../../yns-dev-exercises') as $fileInfo) {
        if($fileInfo->isDot() || $fileInfo->getFilename() === ".git") continue;
        $ref = $fileInfo->getFilename();
        array_push($files, '<a href="../' . $ref . '">' . $ref . '<br>');
    }
    natsort($files);
    foreach ($files as $file) {
        echo $file;
    }
    ?>
</body>
</html>
</a>