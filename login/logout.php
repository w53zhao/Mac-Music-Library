<?php
	//Start session
	session_start();

	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>

<?php
include("top_section_template.html")
?>
<title>Logout</title>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Logout</span></h2>
                </div>
        </div>
</div>


	<br/><br/><br/><br/>
	<h4 align="center" class="err">You have been logged out.</h4>
	<p align="center">Click here to <a href="login-form.php">Login</a></p>
<?php
include 'bottom_section_template.html';
?>
