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
<title>Maintaining the Mac Music Library</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
//checks to see if all necessary values are entered


function checkform () //makes sure at least one composer is checked when pressing the delete button
{

  var chks = document.getElementsByName('ids[]');
  var hasChecked = false;
  for (var i = 0; i < chks.length; i++)  {
  	if (chks[i].checked){
  		hasChecked = true;
  		break;
  	}
  }

  if (hasChecked == false){
  	alert("Please select at least one.");
  	return false;
  }
return true;

}
//-->
</script>

</head>

<body>
	<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
	<a href="../login/member-profile.php">My Profile</a> | <a href="../login/logout.php">Logout</a>

<h2>Composer List</h2>
<form method="POST" action="deleteacomposer2.php" onsubmit="return checkform();">
<table border='1'>
<tr>
<td>Delete</td>
<td>Edit</td>
<td>First Name</td>
<td>Middle Name</td>
<td>Last Name</td>
<td>Birth Year</td>
<td>Death Year</td>
<td>Era</td>
</tr>

<?php
$query="SELECT c.id AS id , c.fname AS fname, c.mname AS mname, c.lname AS lname, c.birth AS birth, c.death AS death, e.era AS era FROM composers AS c,era AS e WHERE c.era_id= e.id ORDER BY c.lname, c.fname";
//join composers and era tables
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $id=$row['id'];
    $fname=htmlentities($row['fname']);
    $mname=htmlentities($row['mname']);
    $lname=htmlentities($row['lname']);
    $birth=$row['birth'];
    $death=$row['death'];
    $era=$row['era'];

	if(strlen($mname)==0)
		$mname='&nbsp';
	if(strlen($birth)==0)
		$birth='&nbsp';
	if(strlen($death)==0)
		$death='&nbsp';


	echo "<tr>";
	echo "<td><input type='checkbox' name='ids[]' value='$id' /></td>";
	echo "<td><a href = './editacomposer1.php?id=$id'>$id</td>";
	echo "<td>$fname</td>";
	echo "<td>$mname</td>";
	echo "<td>$lname</td>";
	echo "<td align = \"right\">$birth</td>";
	echo "<td align = \"right\">$death</td>";
	echo "<td>$era</td>";
	echo "</tr>\n";
}

?>
</tr>
</table>
<p />
<input type="Submit" value="Delete the Checked Composers">
</form>

*Deleting the composer will also delete an pieces associated with the composer.
</body>
</html>