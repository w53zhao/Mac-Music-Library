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

	$composer_id= $_POST['id'];


	//Sanitize the POST values
	$fname = clean($_POST['fname']);

	$mname= clean($_POST['mname']);
	if (strlen($mname)==0)
		$mname="NULL";
	else
		$mname="'$mname'";

	$lname= clean($_POST['lname']);

	$birth= $_POST['birth'];
	if (strlen($birth)==0)
		$birth= "NULL";

	$death= $_POST['death'];
	if (strlen($death)==0)
		$death= "NULL";

	$era_id= $_POST['era'];

	$description= clean($_POST['description']);
	if (strlen($description)==0)
		$description= "NULL";
	else
		$description= "'$description'";

if(strlen($error)==0){
	$qry = "UPDATE composers SET fname='$fname', mname=$mname, lname='$lname', birth = $birth, death = $death , era_id = $era_id WHERE id =$composer_id";

	$result = @mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {

    	$qry = "UPDATE composer_description SET description= $description WHERE composer_id = $composer_id";
		$result = @mysql_query($qry);
		if($result) {
		}else{
			$error = "Failed to update composer description.";
			break;
		}

	}else{
		$error = "Failed to update composer.";
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
	echo "The composer, $fname $lname, was successfully updated.";
}else{
	echo "<a href='javascript: history.go(-1)'>Back the previous page</a>";
}
?>

<p />
<p />
<a href=index.php>Back to the Index</a>

<body>
</html>