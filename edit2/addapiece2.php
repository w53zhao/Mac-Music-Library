<?php
	require_once('../include/auth.php'); //include this line to keep session


	//Include database connection details
	require_once('../include/config.php');


	//Function to sanitize values received from the form. Example: two apostrophes together
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

	$error ="";

	//Connect to mysql server
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$conn) {
		$error = 'Failed to connect to server: ' . mysql_error();
	}

	//Select database
	if(strlen($error)==0){
		$db = mysql_select_db(DB_DATABASE);
		if(!$db) {
			$error = "Unable to select database.";
		}
	}

	//Sanitize the POST values
	$title = clean($_POST['title']);

	$composers = $_POST['composers'];

	$arranger = clean($_POST['arranger']);

	$grade = $_POST['grade'];//NULL or int

	$ensemble = clean($_POST['ensemble']);


	$hour = $_POST['hour'];

	$minute = $_POST['minute'];
	if(strlen($hour) > 0 && $hour < 10) {
		$hour = "0" . "$hour"; //adds a zero in front of 1-digit numbers Example: 01
	}
	if(strlen($minute)>0 && $minute <10) {
		$minute = "0$minute"; //adds a zero in front of 1-digit numbers Example: 01
	}

	$second = $_POST['second'];
	if(strlen($second)>0 && $second <10) {
		$second = "0$second";
	}

	//all hour, minute and second length are either 0 or a value. Here only $minute is checked
	if(strlen($minute)==0){
		$duration= "NULL";
	}else{
		$duration= "'$hour:$minute:$second'";
	}

	$description= clean($_POST['description']);
	if (strlen($description)==0)
		$description= "NULL";
	else
	$description= "'$description'";


if(strlen($error)==0){
	$qry = "INSERT INTO pieces(title, arranger, grade, duration, ensemble_id) VALUES('$title','$arranger', $grade, $duration, $ensemble)";

	$result = @mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {

		$qry = "SELECT id FROM pieces WHERE title= '$title' AND arranger = '$arranger' AND ensemble_id = '$ensemble' ORDER BY id DESC LIMIT 1"; //finds last id number
		$result = @mysql_query($qry);

		if($result) {
			while($row = @mysql_fetch_array($result)){
				$piece_id=$row['id'];

				foreach( $composers as $composer_id){

					$qry = "INSERT INTO composer_piece_link (composer_id, piece_id) VALUES($composer_id,$piece_id)";
					$result = @mysql_query($qry);
					if($result) {

					}else{
						$error = "Failed to update composer_piece_link for this piece.";
						break;
					}

				}

				$qry = "INSERT INTO piece_description (piece_id, description) VALUES($piece_id, $description)";
				$result = @mysql_query($qry);
				if($result) {
				}else{
					$error = "Failed to add piece description.";
					break;
				}
			}
		}else{
			$error = "Failed to get the piece id.";
		}
	}else {
		$error = "Failed to add piece.";
	}
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Maintaining the Mac Music Library</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
	<a href="../login/member-profile.php">My Profile</a> | <a href="../login/logout.php">Logout</a>
<p />
<p />
<p />
<p />

<?php
if(strlen($error)==0){
	echo "The piece was added successfully.";
}else{
	echo "<a href='javascript: history.go(-1)'>Back the previous page</a>";
}
?>

<p />
<p />
<a href=index.php>Back to the Index</a>

<body>
</html>
