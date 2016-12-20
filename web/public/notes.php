<!DOCTYPE html>
<html>
<head>
	<title>Mote | Notes</title>
	
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

function accordionClick(b) {
	
	// Make it clear which accordion element we clicked on.
	$(b).toggleClass("active");
	// Drop the accordion content by changing the class.
	$(b).next().toggleClass("show");
}

</script>
<style>
.topnote {
	font-size: x-small;
}
</style>
</head>
<body>
<?php include(realpath(dirname(__FILE__) . "./header.html")); ?>

<article class="accordion">
	<h2>Matching Notes</h2>
	<?php
		require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
		$client = new MoteClient();
		
		$category_id = $_GET["category_id"] ?: null;
		$title = $_GET["title"] ?: null;
		
		$items = $client->getNotes(null, 0, $config["web"]["defaultNoteCount"], $category_id, $title);
		
		if (empty($items))
		{
			echo "<p>No results :(</p>";
		}
		else
		{
			echo "<div class='accordion-div'>";
			foreach ($items as $item)
			{
				echo "<button class='expand-btn' onclick='accordionClick(this)'>" . $item["category_name"] . " | " . $item["title"] . "</button>";
				
				echo "<div id='note-" . $item["id"] . "' class='panel'>";
				echo "<p class='topnote'>Created " . $item["when_created"] . ", updated " . $item["when_updated"] . ". </p>";
				echo "<p>" . $item["content"] . "</p>";
				echo "</div>";
			}
			echo "</div>";
		}
	?>
</article>

<?php include(realpath(dirname(__FILE__) . "./footer.html")); ?>
</body>
</html>