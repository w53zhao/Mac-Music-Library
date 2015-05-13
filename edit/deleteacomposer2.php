<?php
	require_once('../include/auth.php'); //include this line to keep session


	//Include database connection details
	require_once('../include/config.php');

	$error ="";

	//Connect to mysql server
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$conn) {
		$error = 'Failed to connect to server: ' . mysql_error();
	}

	//Select database
	if(strlen($error)==0){
		$db = mysql_select_db(DB_DATABASE);
		if(!$db) {
			$error = "Unable to select database.";
		}
	}

	$whereComposer= "";
	$wherePiece="";

if(strlen($error)==0){
	$ids = $_POST['ids'];

	foreach( $ids as $id){
		$whereComposer= "$whereComposer OR id = $id ";
	}
	$whereComposer= substr($whereComposer, 3); //delete the first ' OR'  after where

//1. FIND PIECE IDS TO BUILD "WHEREPIECE": ****** must find them before the links are deleted  ******
	$sql = "SELECT piece_id FROM composer_piece_link WHERE composer_id IN (SELECT id FROM composers WHERE $whereComposer)";
//	echo "$sql<br>";
	$result = @mysql_query($sql);
	if($result) {
		while($row = @mysql_fetch_array($result)){
			$piece_id = $row['piece_id'];

			$wherePiece = "$wherePiece OR id = $piece_id";
		}
	}

}

if(strlen($error)==0){

//2. DELETE COMPOSER_PIECE_LINK
	$sql ="DELETE FROM composer_piece_link WHERE composer_id IN (SELECT id FROM composers WHERE $whereComposer)";
//	echo "$sql<br>";
	$result = @mysql_query($sql);

	if($result) {
	  //Everything is ok.
	}else{
		$error="Failed to delete the record related with the selected composer(s) in composer_piece_link table.";
	}
}

if(strlen($error)==0){
//3. IF composer related PIECE(S) EXSIST(S), DELETE THEM
	if(strlen($wherePiece)>0){
		//if there is piece, delete it
		$wherePiece= substr($wherePiece, 3); //delete the first ' OR'  after where

		if($result) {
//3.2 DELETE PIECE
			$sql ="DELETE FROM pieces WHERE $wherePiece";
//			echo "$sql<br>";
			$result = @mysql_query($sql);
			if($result) {
			  //Everything is ok.
			}else{
				$error="Failed to delete the selected composers' pieces.";
			}
		}else{
			$error="Failed to delete the selected composers' piece description.";
		}
	}
}

	if($result) {
//4.2 DELETE THE SELECTED COMPOSERS
		$sql="DELETE FROM composers WHERE $whereComposer";
//		echo "$sql<br>";
		$result = @mysql_query($sql);

		//Check whether the query was successful or not
		if($result) {
		  //Everything is ok.
		}else{
			$error="Failed to delete the selected composer(s).";
		}
	}else{
			$error="Failed to delete the composer(s) description.";
	}

?>
<?php
include 'top_section_template.html';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Composer</title>
<link href="../css/loginmodule.css" rel="stylesheet" type="text/css" />
</head>

<body>


<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Edit Composer</span></h2>
                        <?php
                        if(strlen($error)==0)
                        {
                        echo "Successfully deleted the composer(s).";
                        echo "<br/><br/>";
                        echo "<a href=\"composerlistforedit.php\">Click here </a>to delete more composers.";
                        }

                        else
                        {
                        echo "<a href='javascript: history.go(-1)'>Back the previous page</a>";
                        }
                        ?>

                </div>
        </div>
        <div id='right'>
                <br/>
                <a href="index.php">Index</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../login/logout.php">Logout</a>
        </div>
</div>
<?php
include 'bottom_section_template.html';
?>
