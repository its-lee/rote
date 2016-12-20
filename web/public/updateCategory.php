<?php
	
	//var_dump($_POST);
	
	try
	{
		require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
		
		$delete = array_key_exists("delete", $_POST);
		$id = $_POST["id"];
		$name = $_POST["name"];
		$description = $_POST["description"];
		
		$client = new MoteClient();
		
		if (empty($id))
			$client->insertNoteCategory($name, $description);
		else
		{
			if ($delete)
				$client->deleteNoteCategory($id);
			else
				$client->updateNoteCategory($id, $name, $description);
		}
	}
	catch (Exception $e) {}
	
	// Redirect browser once we're done here.
	header("Location: /categories.php");
	exit();
?>
