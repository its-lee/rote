<?php
require_once(realpath(dirname(__FILE__) . "/MySqlClient.php"));
require_once(realpath(dirname(__FILE__) . "/../config/config.php"));

class MoteClient
{
	private $client;
	
	// Expects a map with entries:
	//   dbname
	//   host
	//   username
	//   password
	public function __construct()
	{
		global $config;
		$this->client = new MySqlClient($config["db"]);
	}
	
	public function getNotes($id = null, $offset = null, $limit = null, $category_id = null, $title = null)
	{
		try
		{
			$q = "select n.*, nc.name as category_name from note n inner join note_category nc on (n.category_id = nc.id) ";
			
			$wheres = [];
			if (!is_null($id)) $wheres[] = "n.id = $id";
			if (!is_null($category_id)) $wheres[] = "n.category_id = $category_id";
			if (!is_null($title)) $wheres[] = "n.title like '%$title%'";
			
			if (!empty($wheres))
				$q .= "where " . implode(" and ", $wheres) . " ";
			
			$q .= "order by n.when_updated desc ";
			if (!is_null($limit)) $q .= "limit $limit ";
			if (!is_null($offset)) $q .= "offset $offset ";
			$q .= ";";
			
			$rows = $this->client->executeQuery($q);
			
			// Return output:
			$items = array();
			
			foreach ($rows as $row)
			{
				$items[] = array(
					"id" => $row["id"],
					"category_id" => $row["category_id"],
					"title" => $row["title"],
					"content" => $row["content"],
					"category_name" => $row["category_name"],
					"when_created" => $row["when_created"],
					"when_updated" => $row["when_updated"]
				);
			}
			
			return $items;
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			return [];
		}
	}
	
	public function insertNote($title, $content, $category_id)
	{
		try
		{
			return $this->client->executeNonQuery(
				"insert into note (title, content, category_id) values ('$title' ,'$content', $category_id);"
				);
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			return null;
		}
	}
	
	public function updateNote($id, $title, $content, $category_id)
	{
		try
		{
			$q = "update note set ";
			
			$fields = [];
			if (!is_null($title)) $fields[] = "title = '$title' ";
			if (!is_null($content)) $fields[] = "content = '$content' ";
			if (!is_null($category_id)) $fields[] = "category_id = '$category_id' ";
			if (!empty($fields)) $q .= implode(", ", $fields) . " ";
			
			$q .= "where id = $id;";
			
			$this->client->executeNonQuery($q);
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
		}
	}
	
	public function deleteNote($id)
	{
		try
		{
			$this->client->executeNonQuery("delete from note where id = $id;");
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
		}
	}
	
	public function getNoteCategories($id = null)
	{
		try
		{
			$q = "select * from note_category ";
			if (!is_null($id)) $q .= "where id = $id ";
			$q .= ";";
			
			$rows = $this->client->executeQuery($q);
			
			// Return output:
			$items = array();
			
			foreach ($rows as $row)
			{
				$items[] = array(
					"id" => $row["id"],
					"name" => $row["name"],
					"description" => $row["description"],
					"when_created" => $row["when_created"],
					"when_updated" => $row["when_updated"]
				);
			}
			
			return $items;
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			return [];
		}
	}
	
	public function insertNoteCategory($name, $description)
	{
		try
		{
			return $this->client->executeNonQuery(
				"insert into note_category (name, description) values ('$name', '$description');"
				);
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			return null;
		}
	}
	
	public function updateNoteCategory($id, $name, $description)
	{
		try
		{
			$q = "update note_category set ";
			
			$fields = [];
			if (!is_null($name)) $fields[] = "name = '$name' ";
			if (!is_null($description)) $fields[] = "description = '$description' ";
			if (!empty($fields)) $q .= implode(", ", $fields) . " ";
			$q .= " where id = $id;";
			
			$this->client->executeNonQuery($q);
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
		}
	}
	
	public function deleteNoteCategory($id)
	{
		try
		{
			$this->client->executeNonQuery("delete from note_category where id = $id;");
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
		}
	}
}
?>