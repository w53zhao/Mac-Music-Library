<!--General script for everything -->
<?php

function myconnect() { // Connects to the database
$connect = @mysql_connect('localhost', 'root', 'wenxizhao940908') or die ("Could not connect to the server.");
$db_select = @mysql_select_db("macmusic") or die ("Could not select the database $database.");
} // end of function




?>
