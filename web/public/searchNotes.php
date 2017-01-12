<!DOCTYPE html>
<html>
<head>
	<title>Rote | Search Notes</title>
	
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
	
<script>
</script>
</head>
<body>

<article>
	
	<section>
		<h3>Search</h3>
		<form action="notes.php">
			<p>Category</p>
			<select name="category_id" class="w3-btn" id="category-select" onchange="selectCategory()">
			<?php
				require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
				
				$client = new MoteClient();
				$items = $client->getNoteCategories();
				
				echo "<option value=''>All Categories</option>";
				
				foreach ($items as $item)
					echo "<option value=" . htmlspecialchars($item["id"]) . ">" . htmlspecialchars($item["name"]) . "</option>";
			?>
			</select>
			<p>Title</p>
			<input class="w3-btn" type="text" name="title"></input><br/><br/>
			<input class="w3-btn" type="submit" value="OK"></input>
		</form>
	</section>
	
</article>

</body>
</html>