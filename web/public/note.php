<!DOCTYPE html>
<html>
<head>
	<title>Rote | Note</title>
	
	<meta charset="UTF-8">
	<meta name="description" content="Simple public note database.">
	<meta name="keywords" content="Notes, Database">
	<meta name="author" content="Cygnut">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="img/content/moteIcon-64x64-Transparent.png" />
	
	<script src="vendor/jquery-3.1.1.min.js"></script>
	
	<link rel="stylesheet" href="vendor/w3.css">
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/accordion.css">
	
<style>
textarea {
	width: 100%;
}
</style>
</head>
<body>

<article>
	<?php
		
		require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
		
		$note = null;
		
		$id = $_GET["id"] ?: null;
		
		if (!is_null($id))
		{
			$client = new MoteClient();
			$items = $client->getNotes($id);
			if (!empty($items))
				$note = $items[0];
		}
		
		$title = $note ? $note["title"] : "";
		$content = $note ? $note["content"] : "";
		$category_id = $note ? $note["category_id"] : "";
	?>
	
	<h2><?php echo is_null($id) ? "Create Note" : "Edit Note" ?></h2>
	
	<form action="updateNote.php" method="post">
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
		<p>Title</p>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>"></input><br/>
		<p>Description</p>
		<textarea name="content" rows="5"><?php echo htmlspecialchars($content); ?></textarea>
		<p>Category</p>
		<select name="category_id" class="w3-btn">
		<?php
			require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
			
			$client = new MoteClient();
			$items = $client->getNoteCategories();
			
			foreach ($items as $item)
			{
				$selectedAttr = "";
				if ($category_id == $item["id"])
					$selectedAttr = "selected='selected'";
				
				echo "<option value=" . htmlspecialchars($item["id"]) . " $selectedAttr>" . htmlspecialchars($item["name"]) . "</option>";
			}
		?>
		</select><br/>
		<?php if (!is_null($id)) { ?>
		<p>Delete?<p>
		<input type="checkbox" name="delete" value=""></input><br/>
		<?php } ?>
		<br/>
		<input class="w3-btn" type="submit" value="OK"></input>
	</form>
</article>

</body>
</html>