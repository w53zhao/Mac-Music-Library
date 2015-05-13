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
include("top_section_template.html")
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Composition</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"> 




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


<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Add Composition</span></h2>
                </div>
        </div>
	<div id='right'>
		<br/>
                <a href="index.php">Index</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../login/logout.php">Logout</a>
	</div>
</div>

<form method="POST" action="addapiece2.php" onsubmit="return checkform(this);">
<br/><br/><br/><br/>
<table align="center" cellpadding="3" border="1">
<tr>
 <td>Piece Title<font color="red">*</font></td><td><input type="text" name="title" value="" size="75"></td>
</tr>

<tr>
<td>Composer<br/><br/>(Add composer if not in list.)<font color="red">*</font></td>
<td>
<select id="composers" name ="composers[]" multiple size="10" >
<option>Not Available</option>
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
	{
 	echo "<option value=$i>$i</option>";
	echo $x = $i + 0.5;
	echo "<option value=$x>$x</option>";
	}
 ?>
 </select>
 </td>
</tr>

<tr>
 <td>Duration</td><td><select name ="hour">
 <option value="" selected>Hour</option> <!--value is empty-->
<?php
	for ($i=0; $i<10; $i++)
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

<td colspan="2" align=center><input type="Submit" value="Add Piece"><input type="Reset"></td>
</tr>
</table>
</form>
<br />
<?php
include 'bottom_section_template.html';
?>
