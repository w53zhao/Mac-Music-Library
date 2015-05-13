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

<?php
include 'top_section_template.html';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Composer</title>
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
<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Edit Composer</span></h2>
                </div>
        </div>
        <div id='right'>
                <br/>
                <a href="index.php">Index</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../login/logout.php">Logout</a>
        </div>
</div>


<?php
$composer_id= $_GET['id'];
$query="SELECT * FROM composers WHERE id=$composer_id";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $fname= $row['fname'];
    $mname= $row['mname'];
    $lname= $row['lname'];
    $birth= $row['birth'];
    $death= $row['death'];
    $era_id= $row['era_id'];


    if ($mname=="NULL") $mname="";
    if ($birth=="NULL") $birth="";
    if ($death=="NULL") $death="";
}



?>

<br/><br/><br/><br/>
<form method="POST" action="editacomposer2.php" onsubmit="return checkform(this);">
<input type="hidden" name="id" value="<?php echo $composer_id ?>" >

<TABLE align = "center" cellpadding = "3" border = "1">
<tr>
 <td>First Name<font color="red">*</font></td><td><input type="text" name="fname" value="<?php echo htmlentities($fname) ?>" size="25"></td>
</tr>

<tr>
 <td>Middle Name</td><td><input type="text" name="mname" value="<?php htmlentities($mname) ?>" size="25"></td>
</tr>

<tr>
 <td>Last Name<font color="red">*</font></td><td><input type="text" name="lname" value="<?php echo htmlentities($lname) ?>" size="25"></td>
</tr>

<tr>
 <td>Birth Year</td><td><input type="text" name="birth" value="<?php echo $birth ?>" size="5"></td>
</tr>

<tr>
 <td>Death Year</td><td><input type="text" name="death" value="<?php echo $death ?>" size="5"></td>
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

	if ($value==$era_id)
		$value= "'$value' selected"; //gets the selected dropdown option
	else
		$value= "'$value'";


    $era=$row['era'];
	echo "<option value=$value>$era</option>";
}
?>
</select>
</td>
</tr>


<tr>
<td colspan="2" align=center><input type="Submit" value="Save Changes"><input type="Reset"></td>
</tr>
</table>

</form>
<br/>
<?php
include 'bottom_section_template.html';
?>

