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

  var agree=confirm("Are you sure you want to delete the selected composer(s)? All the pieces associated with the composer will be deleted as well.");
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
                        <h2 class="guilded"><span>Edit Composer</span></h2>
                </div>
        </div>
        <div id='right'>
                <br/>
                <a href="index.php">Index</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../login/logout.php">Logout</a>
        </div>
</div>

<br/><br/><br/>
<form method="POST" action="deleteacomposer2.php" onsubmit="return checkform();">
<p align="center">
<input type= 'button' onclick="checkall();" value="Check All">
<input type= 'button' onclick="uncheckall();" value="Uncheck All">
<input type= 'button' onclick="toggle();" value="Toggle">
</p>

<TABLE align = "center" cellpadding = "3" border = "1">
<tr>
<td>Delete</td>
<td>&nbsp;</td>
<td>First Name</td>
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
	echo "<td><a href = './editacomposer1.php?id=$id'>&nbsp;Edit&nbsp;</td>";
	echo "<td>$fname</td>";
	echo "<td>$lname</td>";
	echo "<td align = \"right\">$birth</td>";
	echo "<td align = \"right\">$death</td>";
	echo "<td>$era</td>";
	echo "</tr>\n";
}

?>
</tr>
</table>
<p align="center">
<input type="Submit" value="Delete the Checked Composers">
</form><br/><br/>
*Deleting the composer will also delete the pieces associated with the composer.
</p>
<?php
include 'bottom_section_template.html';
?>
