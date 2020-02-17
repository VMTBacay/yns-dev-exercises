<!DOCTYPE html>
<html>
<head>
    <title>1-7</title>
</head>
<body>
    <?php
    $name = $_POST['name'];
    $contact = $_POST['cont_num'];
    $email = $_POST['email'];
    $error = false;
    preg_match('/\d/', $name, $matches);
    if ($name === '' || count($matches) !== 0) {
        echo 'Name Error<br>';
        $error = true;
    }
    preg_match('/[\D\s]/', $contact, $matches);
    if ($contact === '' || count($matches) !== 0) {
        echo 'Number Error<br>';
        $error = true;
    }
    preg_match('/\w+@[a-zA-Z]+\.[a-zA-Z]+/', $email, $matches);
    if (count($matches) !== 1) {
        echo 'Email Error<br>';
        $error = true;
    }
    if (!$error) {
        echo 'Your name is ' . $_POST['name'] . '<br>';
        echo 'Your contact no. is ' . $_POST['cont_num'] . '<br>';
        echo 'And your email address is ' . $_POST['email'];
    }
    ?>
</body>
</html>