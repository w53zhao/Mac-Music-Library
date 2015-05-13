<?php
include('com.php'); //Includes the main functions
myconnect(); //Connects to database, connect early to avoid forgetting later
$id = $_REQUEST['id']; //Finds which composition to use
$path = "pieces/";
chdir($path); //changes path to get ready to read
$list = popen("ls", "r"); //reads all the files in the folder
while($line = trim(fgets($list, 256)))
{
	if (stristr($line, $id . '_') == TRUE) {
		$compositions[] = $line; }
}
$numfile = count($compositions); //see how many compositions are in the folder
$query = "SELECT description FROM piece_description where piece_id=$id";
$result = mysql_query($query) or die ("Table piece_description  was not found.");
$description[] = mysql_fetch_row($result); 

?>
<!-- Need to make it look better. Add Flash/Graphics -->
<HTML>
<HEAD>
<STYLE TYPE="text/css"> /* Got lazy, temp colour for links  Wency change please */
A:link{color:#E0FFFF}
A:visited{color:#E0FFFF}
A:hover{color:#E0FFFF}
A:active{color:#E0FFFF}
</STYLE>
<TITLE>Piece Description</TITLE>
</HEAD>
<BODY background = "images/image4.jpg">
<H1 align = "center"><FONT color = "#8D38C9"><U><I>Piece Description</U></I></FONT></H1>
<!-- Link back to home -->
<P align="center"><A href="../index.html"><FONT size="2" face="arial" color="#347C2C">Home</A></FONT></P>
<!-- Description of .php -->
<?php
echo "<H3 align =\"center\"><FONT color =\"#F525887\">" . $description[0][0] . "</FONT></H3>\n";
echo "<BR><BR>\n";
for ($i = 1; $i <= $numfile; $i++) { //loop to display thumbnails pages
	echo "<P align=\"center\"><A href=\"pieces/" . $id . "_" . $i ."\">Page $i</a><BR>\n";
echo "<A href=\"pieces/". $id . "_" . $i . "\"><IMG SRC=\"pieces/". $id ."_" . $i ."\" width=\"160\" height=\"200\"></A></A>\n"; }
?>
</BODY>
</HTML>


