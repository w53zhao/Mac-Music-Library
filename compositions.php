<!-- compositions.php -->


<!--____________________generates top of template____________________-->
<?php
include 'top_section_template.html';
?>


<?php
include('com.php'); //Includes the main functions
myconnect(); //Connects to database, connect early to avoid forgetting later
$id = $_REQUEST['id']; //Finds which composer and their compositions to steal data from
$query = "SELECT fname, mname, lname FROM `composers` where id=$id";
$result = mysql_query($query) or die ("Table composers was not found.");
$rownum = mysql_num_rows($result);
for ($i = 0; $i < $rownum; $i++) { //set $composer as data variable
$composername[$i] = mysql_fetch_row($result); }
$composer = $composername[0][0] . " " .  $composername[0][1] . " " . $composername[0][2];
$query = "SELECT piece_id FROM `composer_piece_link` WHERE composer_id = $id";
$result = mysql_query($query) or die ("Table composer_piece_link was not found."); //many to many connection
$rownum = mysql_num_rows($result);
$query = "SELECT * from pieces where id IN(";
for ($i = 0; $i < $rownum; $i++) { //set $composition as data variable
        $composition = mysql_fetch_row($result);  //find which composer is chosen and connects to the pieces table
	$x = $composition[0];
	if ($i == $rownum - 1)
		{
		$query .= "$x)";
		}
	else
		{
		$query .= "$x,";
		}
}


$sort = $_REQUEST['sort']; //Use a single page for organization
switch ($sort): // check for which to order and how
        case 'composition':
                $query .= " ORDER by ISNULL(title), title ASC";
                break;
        case 'composition1': //order flip
                $query .= " ORDER by ISNULL(title), title DESC";
                $flip = TRUE;
                break;
        case 'arranger':
                $query .= " ORDER by ISNULL(arranger), arranger ASC";
                break;
        case 'arranger1': //order flip
                $query .= " ORDER by ISNULL(arranger), arranger DESC";
                $flip = TRUE;
                break;
        case 'grade':
                $query .= " ORDER by ISNULL(grade), grade ASC";
                break;
        case 'grade1': //order flip
                $query .= " ORDER by ISNULL(grade), grade DESC";
		$flip = TRUE;
		break;
        case 'duration':
                $query .= " ORDER by ISNULL(duration), duration ASC";
                break;
        case 'duration1': //order flip
                $query .= " ORDER by ISNULL(duration), duration DESC";
		$flip = TRUE;
		break;
        case 'ensemble':
                $query .= " ORDER by ISNULL(ensemble_id), ensemble_id ASC";
                break;
        case 'ensemble1': //order flip
                $query .= " ORDER by ISNULL(ensemble_id), ensemble_id DESC";
		$flip = TRUE;
		break;
	default: 
		$query .= " ORDER by id";
		break;
endswitch; //ends sort check
$query .= ";";



$result = mysql_query($query) or die ("Table pieces was not found.");


for ($i = 0; $i < $rownum; $i++) { //gets the compositions with the composer
        $piece[$i] = mysql_fetch_row($result); 


}

//  Need to make it look better. Add Flash/Graphics
echo "<HTML>\n";
echo "<HEAD>\n";
echo "<TITLE>$composer</TITLE>\n"; //title
echo "</HEAD>\n";
echo "<br/>\n";
echo "<br/>\n";
echo "<H1 align=\"center\"><U><I>$composer</U></I></H1>\n";
//Description of .php
echo "<br/>\n";
echo "<H3 align=\"center\">Below is your selected composer, $composer, and his/her various compositions.</H3>";
echo "<BR><BR>\n";
//The table
echo "<TABLE align=\"center\" cellpadding=\"3\" border=\"1\">\n";//top section
echo "<TR>\n";
echo "<TH colspan=\"5\">$composer</TH>\n";
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




for ($i = 0; $i < $rownum; $i++) 
{
        echo "<TR>";
        echo "<TD align=\"left\">" . $piece[$i][1] . "</TD>\n";
        if (empty($piece[$i][2])) //NULL check, no arranger
                $piece[$i][2] = "&nbsp";
        if (empty($piece[$i][3])) //NULL check, no grade available
                $piece[$i][3] = "&nbsp";
        if (empty($piece[$i][4])) //NULL check, no duration
                $piece[$i][4] = "&nbsp";
	echo "<TD align=\"left\">" . $piece[$i][2] . "</FONT></TD>\n";
	echo "<TD align=\"center\">" . $piece[$i][3] . "</FONT></TD>\n";
	echo "<TD align=\"center\">" . $piece[$i][4] ."</FONT></TD>\n";
	$query = "SELECT name from ensemble where id=";
	$x = $piece[$i][5];
	$query .= "$x;";
	$result = mysql_query($query) or die ("Table ensemble was not found."); //check for table
	for ($j = 0; $j < $rownum; $j++)
	{
		$ensemble = mysql_fetch_row($result);
		echo "<td align=\"center\">" . $ensemble[0] . "</td>\n";
	}	
}
echo "</TABLE>\n";
// footer();
?>
<!--____________________generates bottom section of template____________________-->
<?php
include 'bottom_section_template.html';
?>
</BODY>
</HEAD>
</HTML>
