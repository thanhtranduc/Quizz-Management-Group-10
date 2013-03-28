<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php echo $this->Html->css("login"); //load file CSS riêng (app/webroot/css/login.css)?> 
<title>Login</title> 
<body> 
    <form method="post" action=""> 
        <fieldset> 
        <legend>Login</legend> 
        <label>Username</label><input type="text" name="username" size="20" /><br /> 
        <label>Password</label><input type="password" name="password" size="20" /><br /> 
        <label>&nbsp;</label><input type="submit" name="ok" value="Login" /> 
		<!—Hi?n  th? thông báo l?i n?u có--> 
		<br>
        <span class="error"><?php echo $error; ?></span> 
        </fieldset> 
    </form> 
</body> 
</html>