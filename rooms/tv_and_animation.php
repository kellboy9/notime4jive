<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Keller Hood</title>
<link type="text/css" rel="stylesheet" href="../notime.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript" /></script>

</head>

<body>

<?php include '../includes/nav.php'; ?> <!-- include the navbar code -->
<header><h1>TV and Animation (Weeb stuff)</h1></header>

<div class="wrap">

<a href="./tv_and_animation.php" style="background-color: #CCC;">[ update ]</a>

<div id="parbox" class="parbox">
<?php include '../includes/chats_lib.php';
write_chats_and_pictures("messages_tv_and_animation.txt");
write_chats("../log.txt");
show_chats("messages_tv_and_animation.txt");
limit_chats("messages_tv_and_animation.txt", 6);
?>
</div>

<div class="footer">
<form action="" method="post" id="ChatForm" enctype="multipart/form-data">
<input name="NameIn" type="text" maxlength="20" id="NameIn" class="textField" value="Name (optional)" onclick="this.select()"/>
<input name="ChatIn" type="text" maxlength="50" id="ChatIn" class="textField" value="Type here to chat!" onclick="this.select()"/><br/>
<input name="file" id="file" type="file" size="35"/><br/>
<input type="submit" value="Submit"/>
</form>
</div>

</div> <!--wrap-->

<footer>
(c) keller hood & ethan grantham 2014
</footer>

<!--<script>
$("#ChatIn").keyup(function(event) {
	if (event.keyCode == 13) {
		this.form.submit();
		return false;
	 }
});
</script>-->

</body>
</html>
