<!-- compositionsfull.php -->
<?php
include('com.php'); //Includes the main functions
myconnect(); //Connects to database, connect early to avoid forgetting later
?> 
<?php
include 'top_section_template.html';
?>
<title>Program Notes</title>

<div id='body'>
	<div id='left'>
		<div id='welcome'>
			<h2 class="guilded"><span>Program Notes</span></h2>
		</div>
	</div>
</div>



<!-- Description of .php -->

<BR><BR>
<?php
$sort = $_REQUEST['sort']; //Use a single page for organization
$letter = $_REQUEST['letter']; // sorting by letter
$query = "SELECT * FROM `pieces` ";
$query .= "where title like '$letter%'"; // sort by letter
switch ($sort): // check for which to order and how
	case 'title':
		$query .= "ORDER by ISNULL(title), title ASC"; 
		break;
	case 'title1': //order flip
		$query .= "ORDER by ISNULL(title), title DESC";
		$flip = TRUE;
		break;
        case 'grade':
                $query .= "ORDER by ISNULL(grade), grade ASC";
		break;
	case 'grade1': //order flip
                $query .= "ORDER by ISNULL(grade), grade DESC"; 
                $flip = TRUE;
		break;
        case 'duration':
                $query .= "ORDER by ISNULL(duration), duration ASC";
		break;
	case 'duration1': //order flip
                $query .= "ORDER by ISNULL(duration), duration DESC";
		$flip = TRUE;
		break;
	case 'ensemble':
                $query .= "ORDER by ISNULL(ensemble_id), ensemble_id ASC";
		break;
	case 'ensemble1': //order flip
                $query .= "ORDER by ISNULL(ensemble_id), ensemble_id DESC"; 
		$flip = TRUE;
		break;
	default:
		$query .= "ORDER by id";
		break;
endswitch; //ends the check for which to order
$query .= ";";
$result = mysql_query($query) or die ("Table pieces was not found."); //executes query
$rownum = mysql_num_rows($result);
for ($i = 0; $i < $rownum; $i++) { //set $composer as data variable
        $pieces[$i] = mysql_fetch_row($result); }
if (empty($pieces)) { //checks for an empty search, if not go to else
        echo "<BR>\n";
        echo "<H2 align=\"center\">There are no compositions that match your search request.</H2>\n"; }
else //if the search has an actual result
{
echo "<div id=\"alphabet\">\n";
echo "<br/><br/>\n";

foreach(range('A','Z') as $i)          
        echo "<a href=\"" . $PHP_SELF . "?letter=$i\">$i</A></FONT>\n";
?> 
</div>
<br/>
<!-- Table of compositions -->
<TABLE align = "center" cellpadding = "3" border = "1">
<TR>
<?php
$extend = "&letter=$letter"; // to add to each relink to save time
if ($flip == FALSE || EMPTY($flip)) {   // No previous alter, ascending
	echo "<TH><A href=\"" . $PHP_SELF . "?sort=title1$extend\">Composition</A></FONT></TH>\n";
	echo "<TH><A href=\"" . $PHP_SELF . "?sort=grade1$extend\">Grade</A></FONT></TH>\n";
	echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=duration1$extend\">Duration</A></FONT></TH>\n";
	echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=ensemble1$extend\">Ensemble</A></FONT></TH>\n";
	echo "</TR>\n"; }
else { // Previously altered, descending
	echo "<TH><A href=\"" . $PHP_SELF . "?sort=title$extend\">Composition</A></FONT></TH>\n";
        echo "<TH><A href=\"" . $PHP_SELF . "?sort=grade$extend\">Grade</A></FONT></TH>\n";
        echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=duration$extend\">Duration</A></FONT></TH>\n";
        echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=ensemble$extend\">Ensemble</A></FONT></TH>\n"; }
for ($i = 0; $i < $rownum; $i++) { //the meat of the table
	echo "<TR>";
	echo "<TD align=\"left\">" . $pieces[$i][1] . " </TD>\n";
	if (empty($pieces[$i][3])) //NULL check, there might not be a grade
		$pieces[$i][3] = "&nbsp";   
	echo "<TD align = \"center\">$color" . $pieces[$i][3] . "</FONT></TD>\n";
	if (empty($pieces[$i][4])) //NULL check, there might not be a duration
        	$pieces[$i][4] = "&nbsp"; 
	echo "<TD align = \"center\">$color" . $pieces[$i][4] . "</FONT></TD>\n";
	$query = "SELECT name FROM `ensemble` WHERE id = " . $pieces[$i][5] . ";"; //grabs ensemble from table to show in words
	$result = mysql_query($query) or die ("Table ensemble was not found."); // check for ensemble
	$rownum1 = mysql_num_rows($result);
	for ($j = 0; $j < $rownum1; $j++)  //change integer era into words
        	$ensemble[$j] = mysql_fetch_row($result); 
	echo "<TD align =\"center\">" . $ensemble[0][0] . "</FONT></TD>\n";
	echo "</TR>"; }
echo "</TABLE>";
// footer();
echo "<br/>"; }
include 'bottom_section_template.html';
?>
</BODY>
</HTML>
