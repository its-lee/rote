<!DOCTYPE html>
<html>
<head>
	<title>Rote | Categories</title>
	
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
/* Make it obvious that you can click on rows. The selectors are tds as it's more reliable to access these than trs. */
tr:hover td, tr:hover td {
	cursor: pointer;
	background-color: green;
}
</style>
<script>

function rowClick(id)
{
	window.location.href = '/category.php?id=' + id;
}

</script>
</head>
<body>

<article>
	<h3>Categories</h3>
	<form action="category.php">
		<input class="w3-btn" type="submit" value="Create"></input>
	</form>
	<br/>
	<table class="w3-table-all">
	<?php
		
		$client = new MoteClient();
		$items = $client->getNoteCategories();
		
		echo 
			"<tr>" . 
			"<th>Category</th>" . 
			"<th>When Created</th>" . 
			"<th>When Updated</th>" . 
			"</tr>";
		
		foreach ($items as $item)
			echo 
				"<tr onclick='rowClick(" . htmlspecialchars($item["id"]) . ")'>" . 
				"<td>" . htmlspecialchars($item["name"]) . "</td>" . 
				"<td>" . htmlspecialchars($item["when_created"]) . "</td>" . 
				"<td>" . htmlspecialchars($item["when_updated"]) . "</td>" . 
				"</tr>";
		
	?>
	</table>
</article>

</body>
</html>