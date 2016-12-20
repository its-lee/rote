<?php
	var_dump($_POST);
	
	try
	{
		require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
		
		$delete = array_key_exists("delete", $_POST);
		$id = $_POST["id"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$category_id = $_POST["category_id"];
		
		$client = new MoteClient();
		
		if (empty($id))
			$client->insertNote($title, $content, $category_id);
		else
		{
			if ($delete)
				$client->deleteNote($id);
			else
				$client->updateNote($id, $title, $content, $category_id);
		}
	}
	catch (Exception $e) {}
	
	// Redirect browser once we're done here.
	header("Location: /notes.php");
	exit();
?>
