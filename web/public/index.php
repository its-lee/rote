<!DOCTYPE html>
<html>
<head>
	<title>Mote</title>
	
	<!--
		TODO:
			Navigation menu in header.html.
			
			Use templates (twig?) for:
				accordion item
			
			index.php:
				Add recent notes on index.php? (okay but when we have templating to reduce duplication)
			
			notes.php:
				Better post format.
				Button to expand/collapse all.
				Order by dates.
	-->
	
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
	
	<title>Mote</title>
	
<script>
</script>
</head>
<body>
<?php include(realpath(dirname(__FILE__) . "./header.html")); ?>

<article>
	<h3>Find note:</h3>
	<form action="notes.php">
		<p>Category</p>
		<select name="category_id" class="w3-btn" id="category-select" onchange="selectCategory()">
		<?php
			require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
			
			$client = new MoteClient();
			$items = $client->getNoteCategories();
			
			echo "<option value=''>All Categories</option>";
			
			foreach ($items as $item)
				echo "<option value=" . $item["id"] . ">" . $item["name"] . "</option>";
		?>
		</select>
		<p>Title</p>
		<input class="w3-btn" type="text" name="title"></input><br/><br/>
		<input class="w3-btn" type="submit" value="Find"></input>
	</form>
</article>

<?php include(realpath(dirname(__FILE__) . "./footer.html")); ?>
</body>
</html>