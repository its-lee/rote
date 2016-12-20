<!DOCTYPE html>
<html>
<head>
	<title>Mote</title>
	
	<!--
		TODO:
			Button to expand/collapse all.
			
			Only show top x notes. Order by last updated ascending.
			
			Use templates for:
				header
				footer
				accordion item
	-->
	
	
	
	
	
	<meta charset="UTF-8">
	<meta name="description" content="Simple public note database.">
	<meta name="keywords" content="Notes, Database">
	<meta name="author" content="Cygnut">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="img/content/moteIcon-64x64-Transparent.png" />
	
	<script src="vendor/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="css/accordion.css">
	
	
	<script>
	function accordionClick(b) {
		
		// Make it clear which accordion element we clicked on.
		$(b).toggleClass("active");
		// Drop the accordion content by changing the class.
		$(b).next().toggleClass("show");
	}
	</script>
	
	
</head>
<body>

<section class="accordion">
	<h2>Notes</h2>
	<div class="accordion-div">
	<?php
		require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
		$client = new MoteClient();
		$items = $client->getNotes();
		
		foreach ($items as $item)
		{
			echo "<button class='expand-btn' onclick='accordionClick(this)'>" . $item["category_name"] . " | " . $item["title"] . "</button>";
			
			echo "<div id='note-" . $item["id"] . "' class='panel'>";
			echo "<p>Created : " . $item["when_created"] . "</p>";
			echo "<p>Updated : " . $item["when_updated"] . "</p>";
			echo "<p>" . $item["content"] . "</p>";
			echo "</div>";
		}
	?>
	</div>
</section>

</body>
</html>