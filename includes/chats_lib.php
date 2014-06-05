<?php

/* library description
read_and_deleta_first_line  deletes first line of file
clear_chats  				clears all chats from file
show_chats  				writes all the chats to the current webpage in paragraphs
write_chats 				uses GET to write the chats from the webpage to the file
limit_chats 				limits number of messages in file to num

topkek
*/
function read_and_delete_first_line($filename) {
	$file = file($filename);
	$output = $file[0];
	unset($file[0]);
	#$file = str_replace(array("\r", "\n"), '', $file);
	file_put_contents($filename, $file);
	return $output;
}

function clear_chats($filename)
{
	$handle = fopen($filename, 'w');
	//$file = file($filename);
	//unset($file);
	//file_put_contents($filename, $file);
	fclose($handle);
}

function show_chats_log($filename)
{
	$handle = fopen($filename, 'r');
	$count = 0;
	if($handle)
	{	
		while (($line = fgets($handle)) !== false) 
		{
			echo $line;
			$count++;
		}
	}
	else
	{
		echo "Error!!!";
	}
	
	fclose($handle);
	
	//moderate($filename);
}

function show_chats($filename)
{
	$handle = fopen($filename, 'r');
	$count = 0;
	if($handle)
	{	
		while (($line = fgets($handle)) !== false) 
		{
			echo $line;
			$count++;
		}
	}
	else
	{
		echo "Error!!!";
	}
	
	fclose($handle);
	
	moderate($filename);
}

function moderate($filename)
{
	if($_POST['NameIn'] === "##Mod")
	{
		switch($_POST['ChatIn'])
		{
			case "(clear)":
				clear_chats($filename);
				echo '<script>
				alert("clear");
				function post(path, params, method) {
					method = method || "post"; // Set method to post by default if not specified.
				
					// The rest of this code assumes you are not using a library.
					// It can be made less wordy if you use one.
					var form = document.createElement("form");
					form.setAttribute("method", method);
					form.setAttribute("action", path);
				
					for(var key in params) {
						if(params.hasOwnProperty(key)) {
							var hiddenField = document.createElement("input");
							hiddenField.setAttribute("type", "hidden");
							hiddenField.setAttribute("name", key);
							hiddenField.setAttribute("value", params[key]);
				
							form.appendChild(hiddenField);
						 }
					}
				
					document.body.appendChild(form);
					form.submit();
				}
				
				post("", {});
				
				</script>';
				break;
			case "(clearall)":
				clear_chats("../log.txt");
				clear_chats("messages_music.txt");
				clear_chats("messages_sports.txt");
				clear_chats("messages_technology.txt");
				clear_chats("messages_tv_and_animation.txt");
				clear_chats("messages_video_games.txt");
				echo '<script>
				alert("clearall");
				function post(path, params, method) {
					method = method || "post"; // Set method to post by default if not specified.
				
					// The rest of this code assumes you are not using a library.
					// It can be made less wordy if you use one.
					var form = document.createElement("form");
					form.setAttribute("method", method);
					form.setAttribute("action", path);
				
					for(var key in params) {
						if(params.hasOwnProperty(key)) {
							var hiddenField = document.createElement("input");
							hiddenField.setAttribute("type", "hidden");
							hiddenField.setAttribute("name", key);
							hiddenField.setAttribute("value", params[key]);
				
							form.appendChild(hiddenField);
						 }
					}
				
					document.body.appendChild(form);
					form.submit();
				}
				
				post("", {});
				
				</script>';
				break;
			case "(ban)":
				echo "<script type='text/javascript'>alert('click a post to ban.');</script>";
				enable_bans();
				break;
		}
	}
	if(!empty($_POST["post_ip"]))
	{
		echo $_POST["post_ip"]."\n";
		echo "b&";
		write_ip_ban_ip($_POST["post_ip"]);
	}
	/*echo "<script>window.location.reload();</script>";*/
}

function write_chats_log($filename)
{
	$handle = fopen($filename, 'a');
	
	if($handle)
	{
		$green = false;
		if(!empty($_POST['ChatIn']))
		{
			if(!banned())
			{
				fwrite($handle, "<p data-ip='".$_SERVER['REMOTE_ADDR']."'>");
				if (strpos($_POST['ChatIn'], ">") !== false)
				{
					$green = true;
				}
				if((!empty($_POST['NameIn']) && ($_POST['NameIn'] !== "Name (optional)")))
				{
					if($_POST['NameIn'] === "##Admin")
					{
						fwrite($handle, "<b><span style='color: #f55'>Admin</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Anon")
					{
						fwrite($handle, "<b><span style='color: #5f5'>Anon</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Gold")
					{
						fwrite($handle, "<b><span style='color: #ff5'>Gold</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Mod")
					{
						fwrite($handle, "<b><span style='color: #55f'>Mod</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Based")
					{
						fwrite($handle, "<marquee><b><span style='color: #55f'>Lil' B</span>: </b>" . "#" . $_POST['ChatIn'] . "</marquee>");
					}
					else
					{
						fwrite($handle, "<b>" . $_POST['NameIn'] . ": </b>" . $_POST['ChatIn']);
					}
				}
				else
				{
					if($green)
					{
						$parts = explode('>', rtrim($_POST['ChatIn']));
						fwrite($handle, "<b>anon: </b>" . $parts[0] . "<span style='color: #2f2'>" . ">" . $parts[1] . "</span>");
					}
					else
						fwrite($handle, "<b>anon: </b>" . $_POST['ChatIn']);
				}
				fwrite($handle, "</p>\n");
			}
		}
	}
	else
	{
		echo "Error!!!";
	}
}


function write_chats($filename)
{
	$handle = fopen($filename, 'a');
	
	if($handle)
	{
		$green = false;
		if(!empty($_POST['ChatIn']))
		{
			if(!banned())
			{
				fwrite($handle, "<p data-ip='".$_SERVER['REMOTE_ADDR']."'>");
				if (strpos($_POST['ChatIn'], ">") !== false)
				{
					$green = true;
				}
				if((!empty($_POST['NameIn']) && ($_POST['NameIn'] !== "Name (optional)")))
				{
					if($_POST['NameIn'] === "##Admin")
					{
						fwrite($handle, "<b><span style='color: #f55'>Admin</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Anon")
					{
						fwrite($handle, "<b><span style='color: #5f5'>Anon</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Gold")
					{
						fwrite($handle, "<b><span style='color: #ff5'>Gold</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Mod")
					{
						fwrite($handle, "<b><span style='color: #55f'>Mod</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Based")
					{
						fwrite($handle, "<marquee><b><span style='color: #55f'>Lil' B</span>: </b>" . "#" . $_POST['ChatIn'] . "</marquee>");
					}
					else
					{
						fwrite($handle, "<b>" . $_POST['NameIn'] . ": </b>" . $_POST['ChatIn']);
					}
				}
				else
				{
					if($green)
					{
						$parts = explode('>', rtrim($_POST['ChatIn']));
						fwrite($handle, "<b>anon: </b>" . $parts[0] . "<span style='color: #2f2'>" . ">" . $parts[1] . "</span>");
					}
					else
						fwrite($handle, "<b>anon: </b>" . $_POST['ChatIn']);
				}
				fwrite($handle, "</p>\n");
			}
			else
			{
				echo "<script type='text/javascript'>alert('You cannot post, you have been BANNED!');</script>";
			}
			
			//moderate($filename);
			
		}
	}
	else
	{
		echo "Error!!!";
	}
}

function write_chats_and_pictures($filename)
{
	$handle = fopen($filename, 'a');
	
	if($handle)
	{
		$green = false;
		$img = false;
		if(!empty($_POST['ChatIn']))
		{
			if(!banned())
			{
				fwrite($handle, "<p data-ip='".$_SERVER['REMOTE_ADDR']."'>");
				if (strpos($_POST['ChatIn'], ">") !== false)
				{
					$green = true;
				}
				
				if($_FILES["file"]["size"] > 0)
				{
					$img = true;
					if(is_uploaded_file($_FILES['file']['tmp_name']))
						echo "image uploaded! yay!" . "\n";
					else
						echo "image not uploaded! no!" . "\n";
					if(move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $_FILES["file"]["name"]))
						echo "image moved! yay!" . "\n";
					else
						echo "image not moved! no!" . "\n";
				}
				/*else
				{ 
					echo "Nothing uploaded, you ass." . "\n";
					echo "filename: " . $_FILES["file"]["tmp_name"] . "\n";
					echo $_FILES['file']['error'] . "\n";
				}*/
					
				if((!empty($_POST['NameIn']) && ($_POST['NameIn'] !== "Name (optional)")))
				{
					if($_POST['NameIn'] === "##Admin")
					{
						fwrite($handle, "<b><span style='color: #f55'>Admin</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Anon")
					{
						fwrite($handle, "<b><span style='color: #5f5'>Anon</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Gold")
					{
						fwrite($handle, "<b><span style='color: #ff5'>Gold</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Mod")
					{
						fwrite($handle, "<b><span style='color: #55f'>Mod</span>: </b>" . $_POST['ChatIn']);
					}
					else if($_POST['NameIn'] === "##Based")
					{
						fwrite($handle, "<marquee><b><span style='color: #55f'>Lil' B</span>: </b>" . "#" . $_POST['ChatIn'] . "</marquee>");
					}
					else
					{
						fwrite($handle, "<b>" . $_POST['NameIn'] . ": </b>" . $_POST['ChatIn']);
					}
				}
				else
				{
					if($green)
					{
						if($img)
						{
							$parts = explode('>', rtrim($_POST['ChatIn']));
							fwrite($handle, "<b>anon: </b>" . $parts[0] . "<span style='color: #2f2'>" . "&gt;" . $parts[1] . "</span>" . '  <a style="text-decoration: none; background-color: #333; padding: none;" href="images/'.$_FILES["file"]["name"].'"><img style="max-width: 200px;" src="images/' . $_FILES["file"]["name"] . '"></a>');
						}
						else
						{
							$parts = explode('>', rtrim($_POST['ChatIn']));
							fwrite($handle, "<b>anon: </b>" . $parts[0] . "<span style='color: #2f2'>" . "&gt;" . $parts[1] . "</span>");
						}
					}
					else
					{
						if($img)
						{
							fwrite($handle, "<b>anon: </b>" . $_POST['ChatIn'] . '  <a style="text-decoration: none; background-color: #333; padding: none;" href="images/'.$_FILES["file"]["name"].'"><img style="max-width: 200px;" src="images/' . $_FILES["file"]["name"] . '"></a>');
						}
						else
						{
							fwrite($handle, "<b>anon: </b>" . $_POST['ChatIn']);
						}
					}
				}
				fwrite($handle, "</p>\n");
			}
			else
			{
				//ALERTS TWICE BECAUSE OF the write_chats called for the Log
				//Implement separate function for log writing.
				echo "<script type='text/javascript'>alert('You cannot post, you have been BANNED!');</script>";
			}
			
			
			//moderate($filename);
		}
	}
	else
	{
		echo "Error!!!";
	}
	fclose($handle);
}

function banned()
{
	if( strpos(file_get_contents("banned_ips.txt"),$_SERVER['REMOTE_ADDR']) !== false) 
	{
		return true;
	}
	else
	{
		return false;
	}
}
function write_ip_ban()
{
	$iph = fopen("banned_ips.txt", 'a');
	if(fwrite($iph, $_SERVER['REMOTE_ADDR'] . "\n"))
		//echo "b&";
	fclose($iph);
}
function write_ip_ban_ip($banned_ip)
{
	//echo "B&";
	$iph = fopen("banned_ips.txt", 'a');
	if(fwrite($iph, $banned_ip . "\n"))
		//echo "b&";
	fclose($iph);
}


function limit_chats($filename, $num)
{
	$linecount = 0;
	$handle = fopen($filename, "r");
	while(!feof($handle)){
		$line = fgets($handle);
		$linecount++;
	}
	if(!empty($_POST['ChatIn']))
	{
		if($linecount > $num)
		{
			read_and_delete_first_line($filename);
		}
	}
	fclose($handle);
}

function enable_bans()
{
	/*echo "<script>alert('bannning?');</script>";*/
	if($_POST['NameIn'] == "##Mod")
	{
		/*echo "<script>alert('you are mod.');</script>";*/
		echo '
		<script>
		
		function post(path, params, method) {
			method = method || "post"; // Set method to post by default if not specified.
		
			// The rest of this code assumes you are not using a library.
			// It can be made less wordy if you use one.
			var form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", path);
		
			for(var key in params) {
				if(params.hasOwnProperty(key)) {
					var hiddenField = document.createElement("input");
					hiddenField.setAttribute("type", "hidden");
					hiddenField.setAttribute("name", key);
					hiddenField.setAttribute("value", params[key]);
		
					form.appendChild(hiddenField);
				 }
			}
		
			document.body.appendChild(form);
			alert("ban submitted.");
			form.submit();
		}
		
		$("#parbox p").click(function(e) {
			var ip = $(this).attr("data-ip");
			//this.innerHTML += "<span class=red>(USER WAS BANNED FOR THIS POST)</span>";
			alert(ip);
			// send ban request
			post("", {post_ip: ip});
			
		});
		</script>';
	}
	
	//TODO: Modify JS above to add the (USER WAS BANNED FOR THIS POST) message to the end of the line in the text file.
}

function get_line_by_string($fileName, $str) {
    $lines = file($fileName);
    foreach ($lines as $lineNumber => $line) {
        if (strpos($line, $str) !== false) {
            return $line;
        }
    }
    return -1;
}

?>
