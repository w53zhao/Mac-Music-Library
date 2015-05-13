<!-- composersfull.php -->
<?php
include('com.php'); //Includes the main functions
myconnect(); //Connects to database, connect early to avoid forgetting later
$id = $_REQUEST['id']; //Finds which composition and their composer(s) to steal data from
$query = "SELECT title FROM `pieces` where id=$id";
$result = mysql_query($query) or die ("Table pieces was not found.");
$rownum = mysql_num_rows($result);
for ($i = 0; $i < $rownum; $i++) { //set $composition as data variable
$compositionname[$i] = mysql_fetch_row($result); }
$compname = $compositionname[0][0];
$bluecolor = "<FONT color=\"#2554C7\">"; //Dark Blue
$greencolor = "<FONT color=\"#00FF00\">"; //Green
$redcolor = "<FONT color=\"#FF0000\">"; //Red
$purplecolor = "<FONT color=\"#8E35EF\">"; //Purple
$query = "SELECT composer_id FROM `composer_piece_link` WHERE piece_id = $id";
$result = mysql_query($query) or die ("Table composer_piece_link was not found."); //many to many connection
$rownum = mysql_num_rows($result);
for ($i = 0; $i < $rownum; $i++) { //set $composer as data variable
        $composer[$i] = mysql_fetch_row($result); } //find which composition is chosen and connects to the composer
$query = "SELECT * FROM `composers` WHERE id = " . $composer[0][0] . "";
for ($i = 1; $i < $rownum; $i++) { //matches the compositions with the composer
        $query .= " OR piece_id = " . $composer[$i][0] . "";
        }
$sort = $_REQUEST['sort']; //Use a single page for organization
switch ($sort): // check for which to order and how
        case 'fname':
                $query .= " ORDER by ISNULL(fname), fname ASC";
                break;
        case 'fname1': //order flip
                $query .= " ORDER by ISNULL(fname), fname DESC";
                $flip = TRUE;
                break;
        case 'mname':
                $query .= " ORDER by ISNULL(mname), mname ASC";
                break;
        case 'mname1': //order flip
                $query .= " ORDER by ISNULL(mname), mname DESC";
                $flip = TRUE;
                break;
        case 'lname':
                $query .= " ORDER by ISNULL(lname), lname ASC";
                break;
        case 'lname1': //order flip
                $query .= " ORDER by ISNULL(lname), lname DESC";
		$flip = TRUE;
		break;
        case 'birth':
                $query .= " ORDER by ISNULL(birth), birth ASC";
                break;
        case 'birth1': //order flip
                $query .= " ORDER by ISNULL(birth), birth DESC";
		$flip = TRUE;
		break;
        case 'death':
                $query .= " ORDER by ISNULL(death), death ASC";
                break;
        case 'death1': //order flip
                $query .= " ORDER by ISNULL(death), death DESC";
		$flip = TRUE;
		break;
        case 'era':
                $query .= " ORDER by ISNULL(era_id), era_id ASC";
                break;
        case 'era1': //order flip
                $query .= " ORDER by ISNULL(era_id), era_id DESC";
                $flip = TRUE;
                break;
	default: 
		$query .= " ORDER by id";
		break;
endswitch; //ends sort check
$query .= ";";
$result = mysql_query($query) or die ("Table composers was not found.");
$rownum = mysql_num_rows($result);
for ($i = 0; $i < $rownum; $i++) { //gets the compositions with the composer
        $composer[$i] = mysql_fetch_row($result); }
//  Need to make it look better. Add Flash/Graphics
echo "<HTML>\n";
echo "<HEAD>\n";
echo "<STYLE TYPE=\"text/css\">\n"; //style of entire page
echo "A:link{color:#2554C7}\n"; // Dark blue
echo "A:visited{color:#2554C7}\n";
echo "A:hover{color:#FF0000}\n";
echo "A:active{color:#2554C7}\n";
echo "</STYLE>\n";
echo "<TITLE>$compname</TITLE>\n"; //title
echo "</HEAD>\n";
echo "<BODY background = \"images/image7.jpg\">\n"; //background, Wency change please
echo "<H1 align=\"center\"><FONT color=\"#8D38C9\"><U><I>$compname</U></I></FONT></H1>
<!-- Link back to home -->\n";
echo "<P align=\"center\"><A href=\"../index.html\"><FONT size=\"2\" face=\"arial\" color=\"#347C2C\">Home</A></FONT></P>\n";
//Description of .php
$query = "SELECT description FROM piece_description where piece_id=$id"; //gets description of composer
$result = mysql_query($query) or die ("Table composer_description  was not found.");
$description[] = mysql_fetch_row($result);
echo "<H3 align=\"center\">$redcolor" . $description[0][0] . "</FONT></H3>\n";
/*The table
echo "<TABLE align=\"center\" cellpadding=\"3\" border=\"1\">\n";//top section
echo "<TR>\n";
echo "<TH colspan=\"5\">$purplecolor$composer</FONT></TH>\n";
echo "</TR><TR>\n"; //links
if ($flip == FALSE || EMPTY($flip)) {   // No previous alter, ascending
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=composition1\">Composition Name</A></FONT>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=arranger1\">Arranger</A></FONT></TH>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=grade1\">Grade</A></FONT></TH>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=duration1\">Duration</A></FONT></TH>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=ensemble1\">Ensemble</A></FONT></TH>\n"; }
else { //previously altered, descending
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=composition\">Composition Name</A></FONT>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=arranger\">Arranger</A></FONT></TH>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=grade\">Grade</A></FONT></TH>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=duration\">Duration</A></FONT></TH>\n";
	echo "<TH align=\"center\"><A href=\"" . $PHP_SELF . "?id=$id&sort=ensemble\">Ensemble</A></FONT></TH>\n"; }
for ($i = 0; $i < $rownum; $i++) { //the meat of the table
        echo "<TR>";
        echo "<TD align=\"left\"><A href=\"pieces.php?id=" . $piece[$i][0] . "\">" . $piece[$i][1] . " </A></TD>\n";
        if (empty($piece[$i][2])) //NULL check, no arranger
                $piece[$i][2] = "&nbsp";
        if (empty($piece[$i][3])) //NULL check, no grade available
                $piece[$i][3] = "&nbsp";
        if (empty($piece[$i][4])) //NULL check, no duration
                $piece[$i][4] = "&nbsp";
	echo "<TD align=\"left\">$bluecolor" . $piece[$i][2] . "</FONT></TD>\n";
	echo "<TD align=\"center\">$bluecolor" . $piece[$i][3] . "</FONT></TD>\n";
	echo "<TD align=\"center\">$bluecolor" . $piece[$i][4] ."</FONT></TD>\n";
$query = "SELECT name FROM `ensemble` WHERE id = " . $piece[$i][5] . ";";//grabs ensemble from table to show in words
$result = mysql_query($query) or die ("Table ensemble was not found."); // check for table
$rownum = mysql_num_rows($result);
for ($j = 0; $j < $rownum; $j++) {
	$piece[$j] = mysql_fetch_row($result); }
	echo "<TD align=\"center\">$bluecolor" . $piece[0][0] ."</TD>\n"; // the ensemble
	echo "</TR>\n"; }	
echo "</TABLE>\n";*/
// footer();
?>
</BODY>
</HEAD>
</HTML>
