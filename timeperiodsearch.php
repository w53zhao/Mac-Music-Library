<!--____________________ top section of template____________________-->

<?php
include("top_section_template.html");
include('com.php');
myconnect();
?>
<title>Search by Time Period</title>

<!--____________________left main section ____________________-->

        <div id="body">
                <div id="left">
                        <div id="welcome">
                                <h2 class="guilded"><span>Search by Time Period</span></h2>
                                <p>This section allows you to browse the Mac Music Library by time period.</p>
                                <p>Simply enter in any specific information in the form on the right. All similar results will be given.</p>				     		     <p>Specific years can be entered instead of time periods.</p>
                                <p>&nbsp;</p>
                        </div>
                </div>

<!--____________________right main section____________________-->

                <div id="right">
                        <div id="login">
                                <h2>Search</h2>
                                <form action="composers.php" method="get">
                                        <table border="0" cellspacing="2" cellpadding="0">
                                                <tr><th>Birth Year</th><td><input type="text" size="2" maxlength="4" name="birthmin" value="" class="text" /> to <input type ="text" size="2" maxlength="4" name="birthmax" value="" class="text"</tr>
						<tr><th>Death Year</th><td><input type="text" size="2" maxlength="4" name="deathmin" value="" class="text" /> to <input type ="text" size="2" maxlength="4" name="deathmax" value="" class="text"</tr>
						<tr><th>Era</th><td><SELECT name="era"><OPTION> </OPTION>
<?php
$query = "SELECT era FROM `era`;"; //gets all eras and transfers into words
$result = mysql_query($query) or die ("Table era was not found.");
$rownum = mysql_num_rows($result);
for ($i = 0; $i < $rownum; $i++)  //change integer era into words
        $era[$i] = mysql_fetch_row($result);
for ($i = 0; $i < $rownum; $i++) {
	$value = $i+1;
	echo "<OPTION value=\"$value\">" . $era[$i][0] . "</OPTION>\n"; }
?>
</SELECT></td></tr>
						<tr><td></td><td colspan="4"><input type="reset" value="Reset"><input type="submit"  value="Submit"></td></tr>
                                        </table>
                                </form>
                        </div>
                </div>  
        </div>

<!--____________________generates bottom section of template____________________-->

<?php
include("bottom_section_template.html")
?>


