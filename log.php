<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Keller Hood</title>
<link type="text/css" rel="stylesheet" href="notime.css" />

</head>

<body>

<?php include 'includes/nav.php'; ?> <!-- include the navbar code -->

<header><h1>Log</h1></header>
<div class="wrap">

<div class="par" style="padding: 20px;">Here you will see every message from every chatroom all at once, but you will not be able to post.</div><br /><br />



<a href="http://ahswebtech.org/notime4jive/log.php" style="background-color: #CCC;">[ update ]</a>

<div id="parbox" class="parbox">
<?php include 'includes/chats_lib.php';
show_chats("log.txt");
//limit_chats("log.txt", 6);
?>
</div>
</div>

<footer>
(c) keller hood & ethan grantham 2014
</footer>


</body>
</html>
