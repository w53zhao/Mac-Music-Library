<?php
	require_once('../include/auth.php'); //include this line to keep session
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

<H1 align= "center">Maintaining the Mac Music Library</H1>
<H3>Pieces</H3>

<UL>
 <LI><a href="addapiece1.php">Add a Piece</a></LI>
 <LI><a href="pieceslistforedit.php">Edit Piece Information</a></LI>
 </UL>
<H3>Composers</H3>
<UL>
 <LI><a href="addacomposer1.php">Add a Composer</a></LI>
 <LI><a href="composerlistforedit.php">Edit Composer(s)</a></LI>
</UL>

<HR>
&copy; 2011 Mac Music<br>
<?php
echo "Created June 2 2011<br>";
echo "Last Modified ".@date("M d Y");
?>
</br>
</BODY>
</HTML>
