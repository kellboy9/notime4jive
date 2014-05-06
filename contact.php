<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Keller Hood</title>
<link type="text/css" rel="stylesheet" href="notime.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript" /></script>

</head>

<body>

<?php include 'includes/nav.php'; ?> <!-- include the navbar code -->

<header><h1>Contact</h1></header>

<div class="par">
Contact me at <a style="padding-left: 0; font-weight: bold; background-color: #333; color: #EEE;" href="mailto:kellboy9@gmail.com">kellboy9@gmail.com.</a> <strong>or</strong> use the form below:<br /><br />

<form method="POST" id="contact" action="">
<input type="text" class="textField" value="name" name="name" /><br />
<input type="text" class="textField" value="email" name="email"  /><br />
<textarea name="message" class="textField" cols="60" rows="6">Enter message here...</textarea><br />
<input type="submit" value="Submit" />
</form>
</div>

<?php
if(!empty($_POST))`
{
	mail("kellerhasabig@cock.li", "Message from " . $_POST["name"], $_POST["message"] . "\n" . "Email me back at " . $_POST["email"]);
}
?>

<footer>
(c) keller hood 2014
</footer>

</body>
</html>
