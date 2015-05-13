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

if(strlen($error)==0){
	$qry = "INSERT INTO composers(fname, mname, lname, birth, death, era_id) VALUES('$fname',$mname, '$lname', $birth, $death, $era_id)";

	$result = @mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
	}else{
		$error = "Failed to add composer.";
	}
}
?>



<?php
include 'top_section_template.html';
?>
<title>Upload</title>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Maintaining the Mac Music Library</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />
</head>

<body>


<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Add Composer</span></h2>
                <?php
                        if(strlen($error)==0){
                                echo "The composer, $fname, $lname, was added successfully.";
                                echo "<br/>";
                                echo "<br/>";
                                echo "<a href=\"addacomposer1.php\">Click here </a> to add another composer.";
                        }else{
                                echo "<a href='javascript: history.go(-1)'>Back the previous page</a>";
                        }
                ?>

                </div>
        </div>
        <div id='right'>
                <br/>
                <a href="index.php">Index</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../login/logout.php">Logout</a>
        </div>
</div>
<br/>
<?php
include 'bottom_section_template.html';
?>
