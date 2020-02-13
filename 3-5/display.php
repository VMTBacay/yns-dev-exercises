<html>
<body>

<?php
include "connect.php";

preg_match("/\w+@[a-zA-Z]+\.[a-zA-Z]+/", $_POST["email"], $matches);
if (count($matches) != 1) {
	echo "Email Error";
} else {
	if(isset($_POST["submit"])) {
		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        if (file_exists($target_file)) {
			    $uploadOk = 0;
			} 
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    $uploadOk = 0;
			} 
	    } else {
	        $uploadOk = 0;
	    }
	    if ($uploadOk !== 0) {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "The image ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your image.";
		    }
		}

		$fields = array($_POST["user"], $_POST["pass"], $_POST["email"], basename($_FILES["fileToUpload"]["name"]));
		echo "Your name is " . $fields[0] . "<br>";
		echo "Your contact no. is " . $fields[1] . "<br>";
		echo "Your email address is " . $fields[2] . "<br>"; 
		echo "Your profile image:<br><img src='images/" . $fields[3] . "'><br>";
		
		$sql = "INSERT INTO users (username, password, email, profile_pic) VALUES ('$fields[0]', '$fields[1]', '$fields[2]', '$fields[3]')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
}
?>

</body>
</html>