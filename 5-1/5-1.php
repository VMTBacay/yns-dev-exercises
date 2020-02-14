<?php
include "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
10 Trivia Questions:<br><br>
<?php
$result = $conn->query("SELECT * FROM questions ORDER BY RAND() LIMIT 10;");
$i = 1;
foreach ($result as $row) {
	echo "Question $i:<br>";
	echo "{$row["question"]}<br>";
	echo "Answer: <select class='answers'>";
	foreach (explode("|", $row["choices"]) as $choice) {
		$correct = $choice === $row["answer"];
		echo "<option value='$correct'>$choice</option>";
	}
	echo "</select><br><br>";
	$i++;
}
?>
<button onclick="showScore()">Submit Answers</button>
<script type="text/javascript">
	function showScore() {
		let answers = document.getElementsByClassName("answers"), score = 0;
		for (answer of answers) {
			score += answer.value ? 1 : 0
		}
		alert("Your score is: " + score + "\nPlay another round!");
		location.reload();
	}
</script>
</body>
</html>