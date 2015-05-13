<?php
	require_once('../include/auth.php'); //include this line to keep session


	//Include database connection details
	require_once('../include/config.php');

	//Connect to mysql server
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$conn) {
		die('Failed to connect to server: ' . mysql_error());
	}

	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Maintaining the Mac Music Library: Add a New Composer</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
function isNumeric(sText)

{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;

   for (i = 0; i < sText.length && IsNumber == true; i++)
      {
      Char = sText.charAt(i);
      if (ValidChars.indexOf(Char) == -1)
         {
         IsNumber = false;
         }
      }
   return IsNumber;

   }

function checkform ( form ) //checks to see if values are entered correctly
{
  if (form.fname.value == "") {
    alert( "Please enter the composer's first name." );
    form.fname.focus(); //focus moves the cursor to the error
    return false ;
  }

  if (form.lname.value == "") {
      alert( "Please enter the composer's last name." );
      form.lname.focus(); //focus moves the cursor to the error
      return false ;
  }

if(form.birth.value.length !=0 ){ //if there is a birth year entered, then check the birth year entered
  if (!isNumeric(form.birth.value)|| form.birth.value.length != 4){ //birth year must be numeric and 4 digits
  	  alert( "Please enter a correct numeric birth year." );
      form.birth.focus(); //focus moves the cursor to the error
      return false ;
  }
}

if(form.death.value.length !=0 ){ //if there is a death year entered, then check the death year entered
  if (!isNumeric(form.death.value)|| form.death.value.length != 4){ //death year must be numeric and 4 digits
  	  alert( "Please enter a correct numeric death year." );
      form.death.focus(); //focus moves the cursor to the error
      return false ;
  }
}

  return true ;
}
//-->
</script>

</head>

<body>
	<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
	<a href="../login/member-profile.php">My Profile</a> | <a href="../login/logout.php">Logout</a>

<h3>Add a Composer</h3>
<p>
<form method="POST" action="addacomposer2.php" onsubmit="return checkform(this);">
<table border>
<tr>
 <td>First Name<font color="red">*</font></td><td><input type="text" name="fname" value="" size="25"></td>
</tr>

<tr>
 <td>Middle Name</td><td><input type="text" name="mname" value="" size="25"></td>
</tr>

<tr>
 <td>Last Name<font color="red">*</font></td><td><input type="text" name="lname" value="" size="25"></td>
</tr>

<tr>
 <td>Birth Year</td><td><input type="text" name="birth" value="" size="5"></td>
</tr>

<tr>
 <td>Death Year</td><td><input type="text" name="death" value="" size="5"></td>
</tr>

<tr>
<td>Era<font color="red">*</font></td>
<td>
<select name ="era">
<?php
$query="SELECT * FROM era ORDER BY id";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $value=$row['id'];
    if ($value==7)
    	$value="'$value' selected"; //makes Not Available option the default one
    else
    	$value="'$value'";

    $era=$row['era'];
	echo "<option value=$value>$era</option>";
}
?>
</select>
</td>
</tr>

<tr>
<td>Composer Description</td>
<td>
<textarea name ="description" rows="15" cols="50"></textarea>
</td>
</tr>

<tr>
<td colspan="2" align=center><input type="Submit" value="Add This Composer"><input type="Reset"></td>
</tr>
</table>

<br />
<a href=index.php>Back to the Index</a>

</form>
</body>
</html>