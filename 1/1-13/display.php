<!DOCTYPE html>
<html>
<head>
    <title>1-13</title>
</head>
<body>
    <?php
    $name = $_POST['name'];
    $password = $_POST['pass'];
    $email = $_POST['email'];
    $error = false;
    preg_match('/\s/', $name, $matches);
    if ($name === '' || count($matches) !== 0) {
        echo 'Name Error<br>';
        $error = true;
    }
    preg_match('/\s/', $pass, $matches);
    if ($pass === '' || count($matches) !== 0) {
        echo 'Password Error<br>';
        $error = true;
    }
    preg_match('/\w+@[a-zA-Z]+\.[a-zA-Z]+/', $email, $matches);
    if (count($matches) !== 1) {
        echo 'Email Error<br>';
        $error = true;
    }
    if (!$error) {
        if(isset($_POST['submit'])) {
            $target_dir = 'images/';
            $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
            if($check !== false) {
                if (file_exists($target_file)) {
                    $uploadOk = 0;
                }
                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'
                && $imageFileType != 'gif' ) {
                    $uploadOk = 0;
                }
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk !== 0) {
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                    echo 'The image ' . basename( $_FILES['fileToUpload']['name']) . ' has been uploaded.';
                } else {
                    echo 'Sorry, there was an error uploading your image.';
                }
            }
             $fields = array($name, $password, $email, basename($_FILES['fileToUpload']['name']));
            echo 'Your name is ' . $fields[0] . '<br>';
            echo 'Your password is ' . $fields[1] . '<br>';
            echo 'And your email address is ' . $fields[2] . '<br>';
            echo 'Your profile image:<br><img src="images/' . $fields[3] . '">';
            $file = fopen('users.csv', 'a');
            fputcsv($file, $fields);
            fclose($file);
        }
    }
    ?>
</body>
</html>