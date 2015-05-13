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
<title>Maintaining the Mac Music Library: Add a New Piece</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
//checks to see if all necessary values are entered

function multiselect_validate(select) {
        var valid = false;
        for(var i = 0; i < select.options.length; i++) {
            if(select.options[i].selected) {
                valid = true;
                break;
            }
        }

        return valid;
}

function checkform ( form )
{
  if (form.title.value == "") {
    alert( "Please enter the piece title." );
    form.title.focus(); //focus moves the cursor to the error
    return false ;
  }

  if(!multiselect_validate(document.getElementById('composers'))){
    alert( "Please set composer(s)." );
    form.composers.focus();
    return false ;
  }

  var total = 0;
  if (form.hour.value != "") {
	total++;
	}

  if (form.minute.value != "") {
	total++;
  }

  if (form.second.value != "") {
	total++;
  }

  if(total != 0 && total != 3){
    alert( "Please set duration properly." );
    form.hour.focus();
    return false ;
  }



  return true ;
}
//-->
</script>


</head>

<body>
	<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
	<a href="../login/member-profile.php">My Profile</a> | <a href="../login/logout.php">Logout</a>


<h3>Add a Piece</h3>
<p>
<form method="POST" action="addapiece2.php" onsubmit="return checkform(this);">
<table border>
<tr>
 <td>Piece Title<font color="red">*</font></td><td><input type="text" name="title" value="" size="75"></td>
</tr>

<tr>
<td>Composer<font color="red">*</font><br>(If composer is not in list, <br>please add composer <br>before adding piece.)</td>
<td>
<select id="composers" name ="composers[]" multiple size="10" >
<?php
$query="SELECT * FROM composers ORDER BY lname, fname, mname";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $value=$row['id'];
    $fname=$row['fname'];
    $mname=$row['mname'];
    $lname=$row['lname'];

	echo "<option value='$value'>$fname $mname $lname</option>";
}
?>
</select>
</td>
</tr>

<tr>
 <td>Arranger</td><td><input type="text" name="arranger" value="" size="50"></td>
</tr>

<tr>
 <td>Grade<font color="red">*</font></td>
 <td>
 <select name ="grade">
 <option value="NULL" selected>N/A</option>

 <?php
 	for ($i=0; $i<11; $i++)
 	echo "<option value=$i>$i</option>";
 ?>
 </select>
 </td>
</tr>

<tr>
 <td>Duration</td><td><select name ="hour">
 <option value="" selected>Hour</option> <!--value is empty-->
<?php
	for ($i=0; $i<60; $i++)
	echo "<option value=$i>$i</option>";
?>
</select>
<select name ="minute">
 <option value="" selected>Minute</option>

<?php
	for ($i=0; $i<60; $i++)
	echo "<option value=$i>$i</option>";
?>
</select>

<select name ="second">
 <option value="" selected>Second</option>

<?php
	for ($i=0; $i<60; $i++)
	echo "<option value=$i>$i</option>";
?>
</select>

</td>
</tr>

<tr>
<td>Ensemble<font color="red">*</font></td>
<td>
<select name ="ensemble">

<?php
$query="SELECT * FROM ensemble ORDER BY id";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $value=$row['id'];
    $name=$row['name'];
    if ($name=="Not Available")
    	$value="'$value' selected";
    else
    	$value="'$value'";
	echo "<option value=$value>$name</option>";
}
mysql_close($conn);
?>
</select>
</select>
</td>
</tr>

<tr>
<td>Piece Description</td>
<td>
<textarea name ="description" rows="15" cols="50"></textarea>
</td>
</tr>


<td colspan="2" align=center><input type="Submit" value="Add Piece"><input type="Reset"></td>
</tr>
</table>

<br />
<a href=index.php>Back to the Index</a>

</form>
</body>
</html>
