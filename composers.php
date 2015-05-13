<!-- composers.php -->
<?php
include('com.php'); //Includes the main functions
myconnect(); //Connects to database, connect early to avoid forgetting later
?> 
<!--____________________generates top section of template____________________-->
<?php
include("top_section_template.html")
?>
<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Composers</span></h2>
                </div>
        </div>
</div>
<TITLE>Composers</TITLE>
<?php
//retrieve data for search
$fname = $_REQUEST['fname'];
$mname = $_REQUEST['mname'];
$lname = $_REQUEST['lname'];
$birthmin = $_REQUEST['birthmin'];
$birthmax = $_REQUEST['birthmax'];
$deathmin = $_REQUEST['deathmin'];
$deathmax = $_REQUEST['deathmax'];
$selectedera = $_REQUEST['era'];
if ($selectedera == " ") { //null check, added space to look better
	$selectedera = ""; }
$set = TRUE; //just in case to fix further problems
?>
<br/><br/>
<?php
$sort = $_REQUEST['sort']; //Use a single page for organization
if ((empty($fname)) && (empty($mname)) && (empty($lname)) && (empty($birthmin)) && (empty($birthmax)) && (empty($deathmin)) && (empty($deathmax)) && (empty($selectedera)))
	$query = "SELECT * FROM `composers`";
else
$query = "SELECT * FROM `composers` where ";
if (!empty($fname)) { 
	$query .= "fname like '$fname%' ";
	$set = FALSE; }
if ($set == FALSE && (!empty($mname))) {
	$query .= "AND ";
	$set = TRUE; }
if (!empty($mname)) {
	$query .= "mname like '$mname%' ";
	$set = FALSE; }
if (($set == FALSE) && (!empty($lname))) {
	$query .= "AND ";
	$set = TRUE; }
if (!empty($lname)) {
        $query .= "lname like '$lname%' ";
	$set = FALSE; }
if ($set == FALSE && (!empty($birthmin))) {
	$query .= "AND ";
	$set = TRUE; }
if (!empty($birthmin)) {
	$query .= "birth >= $birthmin ";
	$set = FALSE; }
if ($set == FALSE && (!empty($birthmax))) {
	$query .= "AND ";
	$set = TRUE; }
if (!empty($birthmax)) {
	$query .= "birth <= $birthmax ";
	$set = FALSE; }
if ($set == FALSE && (!empty($deathmin))) {
	$query .= "AND ";
	$set = TRUE; }
if (!empty($deathmin)) {
	$query .= "death >= $deathmin ";
	$set = FALSE; }
if ($set == FALSE && (!empty($deathmax))) {
	$query .= "AND ";
	$set = TRUE; }
if (!empty($deathmax)) {
	$query .= "death <= $deathmax "; 
	$set = FALSE; }
if ($set == FALSE && (!empty($selectedera))) {
	$query .= "AND ";
	$set = TRUE; }
if (!empty($selectedera)) {
	$query .= "era_id = $selectedera "; }
switch ($sort): // check for which to order and how
	case 'fname':
		$query .= "ORDER by ISNULL(fname), fname ASC"; 
		break;
	case 'fname1': //order flip
		$query .= "ORDER by ISNULL(fname), fname DESC";
		$flip = TRUE;
		break;
        case 'mname':
                $query .= "ORDER by ISNULL(mname), mname ASC";
		break;
	case 'mname1': //order flip
		$query .= "ORDER by ISNULL(mname), mname DESC";
		$flip = TRUE;
		break;
        case 'lname':
                $query .= "ORDER by ISNULL(lname), lname ASC";
		break;
	case 'lname1': //order flip
                $query .= "ORDER by ISNULL(lname), lname DESC"; 
                $flip = TRUE;
		break;
        case 'birth':
                $query .= "ORDER by ISNULL(birth), birth ASC";
		break;
	case 'birth1': //order flip
                $query .= "ORDER by ISNULL(birth), birth DESC";
		$flip = TRUE;
		break;
	case 'death':
                $query .= "ORDER by ISNULL(death), death ASC";
		break;
	case 'death1': //order flip
                $query .= "ORDER by ISNULL(death), death DESC"; 
		$flip = TRUE;
		break;
	case 'era':
                $query .= "ORDER by ISNULL(era_id), era_id ASC";
		break;
	case 'era1':
                $query .= "ORDER by ISNULL(era_id), era_id DESC";
	        $flip = TRUE;
		break;
	default:
		$query .= "ORDER by id";
		break;
endswitch; //ends the check for which to order
$query .= ";";
$result = mysql_query($query) or die ("Table composers was not found."); //executes query
$rownum = mysql_num_rows($result);
for ($i = 0; $i < $rownum; $i++) { //set $composer as data variable
        $composer[$i] = mysql_fetch_row($result); }
if (empty($composer)) { //checks for an empty search, if not go to else
	echo "<BR>\n";
	echo "<H2 align=\"center\">There are no composers that match your search request.</H2>\n"; }
else //if the search has an actual result
{
//print_r($query); for checking the query
?> 

<!-- Table of composers -->
<br/><br/>
<TABLE align = "center" cellpadding = "3" border = "1">
<TR>
</TR><TR>
<?php
$extention = "&fname=$fname&mname=$mname&lname=$lname&birthmin=$birthmin&birthmax=$birthmax&death=$deathmin&deathmax=$deathmax&era=$selectedera"; // add on extension to link
if ($flip == FALSE || EMPTY($flip)) {   // No previous alter, ascending
	echo "<TH><A href=\"" . $PHP_SELF . "?sort=fname1$extention\">First Name</A></FONT>\n";
	echo "<A href=\"" . $PHP_SELF . "?sort=mname1$extention\">Middle Name</A></FONT>\n";
	echo "<A href=\"" . $PHP_SELF . "?sort=lname1$extention\">Last Name</A></FONT></TH>\n";
	echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=birth1$extention\">Birth Year</A></FONT></TH>\n";
	echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=death1$extention\">Death Year</A></FONT></TH>\n";
	echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=era1$extention\">Era</A></FONT></TH>\n";
	echo "</TR>\n"; }
else { // Previously altered, descending
	echo "<TH><A href=\"" . $PHP_SELF . "?sort=fname$extention\">First Name</A></FONT>\n";
        echo "<A href=\"" . $PHP_SELF . "?sort=mname$extention\">Middle Name</A></FONT>\n";
        echo "<A href=\"" . $PHP_SELF . "?sort=lname$extention\">Last Name</A></FONT></TH>\n";
        echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=birth$extention\">Birth Year</A></FONT></TH>\n";
        echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=death$extention\">Death Year</A></FONT></TH>\n";
        echo "<TH align =\"center\"><A href=\"" . $PHP_SELF . "?sort=era$extention\">Era</A></FONT></TH>\n"; }
//Meat section of the table
for ($i = 0; $i < $rownum; $i++) { //the meat of the table
	echo "<TR>";
	echo "<TD align=\"left\">$color<A href = \"compositions.php?id=" . $composer[$i][0] . "\">" . $composer[$i][1] . " </A></FONT>";
	//if (empty($composer[$i][2])) //NULL check, sets as &nbsp;
	//	$composer[$i][2] = "&nbsp";
	echo "$color<A href = \"compositions.php?id=" . $composer[$i][0] . "\"> " . $composer[$i][2] . " </A></FONT>";
echo "$color<A href = \"compositions.php?id=" . $composer[$i][0] . "\">" . $composer[$i][3] . "</FONT>";
echo "</TD>";
if (empty($composer[$i][4])) //NULL check
        $composer[$i][4] = "&nbsp";

echo "<TD align = \"center\">$color" . $composer[$i][4] . "</FONT>";
echo "</TD>";
if (empty($composer[$i][5])) //NULL check, composer might be still alive
	$composer[$i][5] = "&nbsp";    
echo "<TD align = \"center\">$color" . $composer[$i][5] . "</FONT>";
echo "</TD>\n";
if (empty($composer[$i][6])) //NULL check, era might be not given!
	$composer[$i][6] = 7;
$query = "SELECT era FROM `era` WHERE id = " . $composer[$i][6] . ";"; //grabs era from table to show in words
$result = mysql_query($query) or die ("Table era was not found."); // check for table
$rownum1 = mysql_num_rows($result);;
for ($j = 0; $j < $rownum1; $j++)  //change integer era into words
        $era[$j] = mysql_fetch_row($result); 
	echo "<TD align =\"center\">$color" . $era[0][0] . "</FONT></TD>\n";
	echo "</TR>"; }
echo "</TABLE>";
echo "<br/>\n"; }
include 'bottom_section_template.html';
?>
</BODY>
</HTML>
