<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Keller Hood</title>
<link type="text/css" rel="stylesheet" href="../notime.css" />
</head>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<body>

<?php include '../includes/nav.php'; ?> <!-- include the navbar code -->
<header><h1>Musique Fantastique</h1></header>

<div class="wrap">

<a href="./music.php" style="background-color: #CCC;">[ update ]</a>

<div id="parbox" class="parbox">
<?php include '../includes/chats_lib.php';
	write_chats("messages_music.txt");
	write_chats_log("../log.txt");
	show_chats("messages_music.txt");
	limit_chats("messages_music.txt", 6);
	if(!empty($_POST["ChatIn"]))
	{
		if(strpos($_POST["ChatIn"],"mozart") !== false)
		{
			write_ip_ban();
			echo "<script type='text/javascript'>alert('Banned for saying mozart! You suck.');</script>";
		}
	}
	//enable_bans();
?>
</div>

<div class="footer">
<form action="" method="POST" id="ChatForm">
<input name="NameIn" type="text" maxlength="20" id="NameIn" class="textField" value="Name (optional)" onclick="this.select()"/>
<input name="ChatIn" type="text" maxlength="50" id="ChatIn" class="textField" value="Type here to chat!" onclick="this.select()"/>
<input type="submit" value="Submit"/>
</form>
</div>

</div> <!--wrap-->

<footer>
(c) keller hood & ethan grantham 2014
</footer>

</body>
</html>
