<?php
	require_once('../include/auth.php'); //include this line to keep session
?>

<?php
include ('top_section_template.html');
?>
<title>Maintaining the Database</title>

<!--____________________generate left section of edit__________________-->

<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?>!</span></h2>
		<br/><br/>
		<H3>Compositions</H3>
			<p><a href="addapiece1.php">Add Composition</a></p>
			<p><a href="pieceslistforedit.php">Edit Composition Information</a></p>
		</div>
	 </div>

<!--___________________generate right section of edit____________________-->

	<div id='right'>
		<br/>
		<a href="../login/logout.php">Logout</a>
		<br/><br/><br/><br/>
		<H3>Composers</H3>
			<p><a href="addacomposer1.php">Add Composer</a></p>
			<p><a href="composerlistforedit.php">Edit Composer Infomation</a></p>
	</div>
</br>
</div>
<?php
include 'bottom_section_template.html';
?>
