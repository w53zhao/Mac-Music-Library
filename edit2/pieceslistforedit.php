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
</head>

<body>
	<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
	<a href="../login/member-profile.php">My Profile</a> | <a href="../login/logout.php">Logout</a>

<h2>Pieces List</h2>
<formform method="POST" action="deleteapiece2.php">
<table border='1'>
<tr>
<td>Delete</td>
<td>Edit</td>
<td>Title</td>
<td>Arranger</td>
<td>Grade</td>
<td>Duration</td>
<td>Ensemble</td>
</tr>

<?php
$query="SELECT p.id AS id , p.title AS title, p.arranger AS arranger, p.grade AS grade, p.duration AS duration, e.name AS ensemble FROM pieces AS p,ensemble AS e WHERE e.id= p.ensemble_id ORDER BY p.title";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)){
    $id=$row['id'];
    $title=htmlentities($row['title']);
    $arranger=htmlentities($row['arranger']);
    $grade=$row['grade'];
    $duration=$row['duration'];
    $ensemble=$row['ensemble'];

if(strlen($arranger)==0)
	$arranger='&nbsp';
if(strlen($grade)==0)
	$grade='&nbsp';
if(strlen($duration)==0)
	$duration='&nbsp';

	echo "<tr>";
	echo "<td><input type='checkbox' name='id[]' value='$id' /></td>";
	echo "<td><a href = './editapiece1.php?id=$id'>$id</td>";
	echo "<td>$title</td>";
	echo "<td>$arranger</td>";
	echo "<td align = \"right\">$grade</td>";
	echo "<td align = \"right\">$duration</td>";
	echo "<td>$ensemble</td>";
	echo "</tr>";
}

?>
</tr>
</table>
<p />
<input type="Submit" value="Delete the Checked Pieces">
</form>

</body>
</html>