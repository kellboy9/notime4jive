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
	unset($file);
	fclose($handle);
}

function show_chats($filename)
{
	$handle = fopen($filename, 'r');
	if($handle)
	{
		while (($line = fgets($handle)) !== false) 
		{
			echo "<p>";
			echo $line;
			echo "</p>";
		}
	}
	else
	{
		echo "Error!!!";
	}
	
	fclose($handle);
}

function write_chats($filename)
{
	$handle = fopen($filename, 'a');
	
	if($handle)
	{
		$green = false;
		if(!empty($_POST['ChatIn']))
		{
			if (strpos($_POST['ChatIn'], ">") !== false)
			{
				$green = true;
			}
			if((!empty($_POST['NameIn']) && ($_POST['NameIn'] !== "Name (optional)")))
			{
				if($_POST['NameIn'] === "##Admin")
				{
					fwrite($handle, "<b><span style='color: #f55'>Admin</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Anon")
				{
					fwrite($handle, "<b><span style='color: #5f5'>Anon</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Gold")
				{
					fwrite($handle, "<b><span style='color: #ff5'>Gold</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Mod")
				{
					fwrite($handle, "<b><span style='color: #55f'>Mod</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Based")
				{
					fwrite($handle, "<marquee><b><span style='color: #55f'>Lil' B</span>: </b>" . "#" . $_POST['ChatIn'] . "</marquee>" . "\n");
				}
				else
				{
					fwrite($handle, "<b>" . $_POST['NameIn'] . ": </b>" . $_POST['ChatIn'] . "\n");
				}
			}
			else
			{
				if($green)
				{
					$parts = explode('>', rtrim($_POST['ChatIn']));
					fwrite($handle, "<b>anon: </b>" . $parts[0] . "<span style='color: #2f2'>" . ">" . $parts[1] . "</span>" . "\n");
				}
				else
					fwrite($handle, "<b>anon: </b>" . $_POST['ChatIn'] . "\n");
			}
		}
	}
	else
	{
		echo "Error!!!";
	}
	fclose($handle);
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
					echo "image not uploaded! fuck!" . "\n";
				if(move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $_FILES["file"]["name"]))
					echo "image moved! yay!" . "\n";
				else
					echo "image not moved! fuck!" . "\n";
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
					fwrite($handle, "<b><span style='color: #f55'>Admin</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Anon")
				{
					fwrite($handle, "<b><span style='color: #5f5'>Anon</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Gold")
				{
					fwrite($handle, "<b><span style='color: #ff5'>Gold</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Mod")
				{
					fwrite($handle, "<b><span style='color: #55f'>Mod</span>: </b>" . $_POST['ChatIn'] . "\n");
				}
				else if($_POST['NameIn'] === "##Based")
				{
					fwrite($handle, "<marquee><b><span style='color: #55f'>Lil' B</span>: </b>" . "#" . $_POST['ChatIn'] . "</marquee>" . "\n");
				}
				else
				{
					fwrite($handle, "<b>" . $_POST['NameIn'] . ": </b>" . $_POST['ChatIn'] . "\n");
				}
			}
			else
			{
				if($green)
				{
					if($img)
					{
						$parts = explode('>', rtrim($_POST['ChatIn']));
						fwrite($handle, "<b>anon: </b>" . $parts[0] . "<span style='color: #2f2'>" . ">" . $parts[1] . "</span>" . '  <img src="images/' . $_FILES["file"]["name"] . '">' . "\n");
					}
					else
					{
						$parts = explode('>', rtrim($_POST['ChatIn']));
						fwrite($handle, "<b>anon: </b>" . $parts[0] . "<span style='color: #2f2'>" . ">" . $parts[1] . "</span>" . "\n");
					}
				}
				else
				{
					if($img)
					{
						fwrite($handle, "<b>anon: </b>" . $_POST['ChatIn'] . '  <img src="images/' . $_FILES["file"]["name"] . '">' . "\n");
					}
					else
					{
						fwrite($handle, "<b>anon: </b>" . $_POST['ChatIn'] . "\n");
					}
				}
			}
		}
	}
	else
	{
		echo "Error!!!";
	}
	fclose($handle);
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
?>
