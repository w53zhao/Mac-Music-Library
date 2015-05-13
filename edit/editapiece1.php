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


<?php
$piece_id= $_GET['id'];
$query="SELECT * FROM pieces WHERE id=$piece_id";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $title= $row['title'];
    $arranger= $row['arranger'];
    $grade= $row['grade'];
    $duration= $row['duration'];
    $ensemble_id= $row['ensemble_id'];


    if ($arranger=="NULL") $arranger="";

}

$description="";

$query="SELECT * FROM piece_description WHERE piece_id=$piece_id";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $description= $row['description'];

    if ($description=="NULL") $description="";
}


?>
<br/><br/><br/>
<form method="POST" action="editapiece2.php" onsubmit="return checkform(this);">
<input type="hidden" name="id" value="<?php echo $piece_id ?>" >


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

<tr>
<td colspan="2" align=center><input type="Submit" value="Save Changes"><input type="Reset"></td>
</tr>
</table>

<br />
<a href=index.php>Back to the Index</a>

</form>
</body>
</html>
