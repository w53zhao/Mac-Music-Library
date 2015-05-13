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
<title>Edit Composition</title>
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

  var agree=confirm("Are you sure you want to delete the selected piece(s)?");
  if (agree)
	return true ;
  else
	return false ;
}

function checkall ()
{

  var chks = document.getElementsByName('ids[]');
  var hasChecked = false;
  for (var i = 0; i < chks.length; i++)  {
  	chks[i].checked=true;
  }
}

function uncheckall ()
{

  var chks = document.getElementsByName('ids[]');
  var hasChecked = false;
  for (var i = 0; i < chks.length; i++)  {
  	chks[i].checked=false;
  }
}

function toggle ()
{

  var chks = document.getElementsByName('ids[]');
  var hasChecked = false;
  for (var i = 0; i < chks.length; i++)  {
  	chks[i].checked =!(chks[i].checked);
  }
}


//-->
</script>


</head>

<body>
<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Edit Composition</span></h2>
                </div>
        </div>
        <div id='right'>
                <br/>
                <a href="index.php">Index</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../login/logout.php">Logout</a>
        </div>
</div>

<br/><br/><br/>
<form method="POST" action="deleteapiece2.php" onsubmit="return checkform();">
<p align="center">
<input type= 'button' onclick="checkall();" value="Check All">
<input type= 'button' onclick="uncheckall();" value="Uncheck All">
<input type= 'button' onclick="toggle();" value="Toggle">
</p>
<TABLE align = "center" cellpadding = "3" border = "1">
<tr>
<td>Delete</td>
<td>&nbsp;</td>
<td>Title</td>
<td>Grade</td>
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
	echo "<td><input type='checkbox' name='ids[]' value='$id' /></td>";
	echo "<td><a href = './editapiece1.php?id=$id'>&nbsp;Edit&nbsp;</td>";
	echo "<td>$title</td>";
	echo "<td align = \"right\">$grade</td>";
	echo "<td>$ensemble</td>";
	echo "</tr>";
}

?>
</tr>
</table>
<p align="center">
<input type="Submit" value="Delete the Checked Compositions">
</p>
</form>
<?php
include 'bottom_section_template.html';
?>
