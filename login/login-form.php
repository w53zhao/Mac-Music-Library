<?php
include ('top_section_template.html');
?>
<title>Login</title>
<div id='body'>
        <div id='left'>
                <div id='welcome'>
                        <h2 class="guilded"><span>Administrator</span></h2>
			<p>If you are an administrator, please log in to edit, delete, or to add on to the database.</p>
                </div>
        </div>


<div id="right">
                        <div id="login">
                                <h2>Login</h2>
	<p>&nbsp;</p>
	<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
	  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
		  <td width="112"><b>Login</b></td>
		  <td width="150"><input name="login" type="text" class="textfield" size="12"/></td>
		</tr>
		<tr>
		  <td><b>Password</b></td>
		  <td><input name="password" type="password" class="textfield" size="12"/></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td><input type="submit" name="Submit" value="Login" /></td>
		</tr>

		<tr>
	      <td colspan="2"><a href ="./register-form.php"><br />Sign Up<br>(For administrator use only)  </a></td>
		</tr>

	  </table>
	<br/>
	</form>
</div>
</div>
</div>
<br/>
<?php
include 'bottom_section_template.html';
?>
