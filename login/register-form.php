<?php
	session_start();
?>

<?php
include ('top_section_template.html');
?>
<title>Sign Up</title>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Form</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
		if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>';
			}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
		}
	?>


<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Sign Up</span></h2>
                </div>
        </div>
        <div id='right'>
                <br/>
                <a href="../login/logout.php">Logout</a>
        </div>
</div>

<br/><br/><br/><br/>
	<form id="loginForm" name="loginForm" method="post" action="register-exec.php">
	    <TABLE align = "center" cellpadding = "3" border = "1">
		<tr>
		  <th>First Name </th>
		  <td><input name="fname" type="text" class="textfield" id="fname" /></td>
		</tr>
		<tr>
		  <th>Last Name </th>
		  <td><input name="lname" type="text" class="textfield" id="lname" /></td>
		</tr>
		<tr>
		  <th>Login</th>
		  <td><input name="login" type="text" class="textfield" /></td>
		</tr>
		<tr>
		  <th>Password</th>
		  <td><input name="password" type="password" class="textfield" id="password" /></td>
		</tr>
		<tr>
		  <th>Confirm Password </th>
		  <td><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td><input type="submit" name="Submit" value="Register" /></td>
		</tr>
	  </table>
	</form>
</body>

</html>
