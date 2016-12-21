<!DOCTYPE html>
<html>
<head>
	<title>Mote | Category</title>
	
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
<?php include(realpath(dirname(__FILE__) . "./header.html")); ?>

<article>
	<?php
		require_once(realpath(dirname(__FILE__) . "/../library/include.php"));
		
		$category = null;
		
		$id = $_GET["id"] ?: null;
		
		if (!is_null($id))
		{
			$client = new MoteClient();
			$items = $client->getNoteCategories($id);
			if (!empty($items))
				$category = $items[0];
		}
		
		
		$name = $category ? $category["name"] : "";
		$description = $category ? $category["description"] : "";
	?>
	
	<h2><?php echo is_null($id) ? "Create Category" : "Edit Category" ?></h2>
	
	<form action="updateCategory.php" method="post">
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
		<p>Name</p>
		<input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"></input><br/>
		<p>Description</p>
		<textarea name="description" rows="5"><?php echo htmlspecialchars($description); ?></textarea>
		<br/>
		<?php if (!is_null($id)) { ?>
		<p>Delete?<p>
		<input type="checkbox" name="delete" value=""></input><br/>
		<?php } ?>
		<br/>
		<input class="w3-btn" type="submit" value="OK"></input>
	</form>
</article>

<?php include(realpath(dirname(__FILE__) . "./footer.html")); ?>
</body>
</html>