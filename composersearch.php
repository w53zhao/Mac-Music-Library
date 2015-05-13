<!--____________________ top section of template____________________-->

<?php
include("top_section_template.html");
include('com.php');
myconnect();
?>
<title>Search by Composer</title>

<!--____________________left main section ____________________-->

        <div id="body">
                <div id="left">
                        <div id="welcome">
                                <h2 class="guilded"><span>Search by Composer</span></h2>
                                <p>This section allows you to browse the Mac Music Library by composers.</p>
                                <p>Simply enter in any specific information in the form on the right. All similar results will be given.</p>				     		     <p>The first few letters of a name can be entered instead of the full name.</p>
                                <p>&nbsp;</p>
                        </div>
                </div>

<!--____________________right main section____________________-->

                <div id="right">
                        <div id="login">
                                <h2>Search</h2>
                                <form action="composers.php" method="get">
                                        <table border="0" cellspacing="2" cellpadding="0">
                                                <tr><th>First Name</th><td><input type="text" size="13" name="fname" value="" class="text" /></td></tr>
                                                <tr><th>Middle Name</th><td><input type="text" size="13" name="mname" class="text" value="" /></td></tr>
						<tr><th>Last Name</th><td><input type="text" size="13" name="lname" value="" class="text" /></td></tr>
</SELECT></td></tr>
						<tr><td></td><td colspan="2"><input type="reset"><input type="submit" value="Submit"></td></tr>
                                        </table>
                                </form>
                        </div>
                </div>  
        </div>

<!--____________________generates bottom section of template____________________-->

<?php
include("bottom_section_template.html")
?>


