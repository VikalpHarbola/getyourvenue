<?php
/*
 * Created on Aug 31, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<h1>Login</h1>
<hr>
<br/>
<form action='../../actionController/CSMController.php' method='post'>
	<div>
		<span>Login:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<span><input type="text" class="text" name="userId"/></span>
	</div>
	<div>
		<span>Password:</span>
		<span><input type="password" class="text" name="password" /></span>
	</div><br>
	<div>
		<span><input type="submit" class="text" name="name" value="Submit" /></span>
		<span><input type="reset" class="text" name="name" value="Reset" /></span>
	</div>
	<input type="hidden" name="region" value="delhi-ncr">
	<input type="hidden" name="category" value="wedding-venues">
	<input type="hidden" name="capacity" value="0">
	<input type="hidden" name="action" value="userAuthetication" />
</form>

<div font color="red">
<?php 
	if(isset($message))
		echo $message; 
?>
</div>
