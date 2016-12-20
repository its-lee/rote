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
	
	public function getNotes($id = null)
	{
		try
		{
			$q = "select n.*, nc.name as category_name from note n inner join note_category nc on (n.category_id = nc.id) ";
			if (!is_null($id)) $q .= "where n.id = $id";
			$q .= ";";
			
			$rows = $this->client->executeQuery($q);
			
			// Return output:
			$items = array();
			
			foreach ($rows as $row)
			{
				$items[] = array(
					"id" => $row["id"],
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
	
	public function insertNote($title, $content, $categoryId)
	{
		try
		{
			return $this->client->executeNonQuery(
				"insert into note (title,content,category_id) values ('$title','$content',$category_id);"
				);
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			return null;
		}
	}
	
	public function updateNote($id, $title, $content)
	{
		try
		{
			$q = "update note set ";
			if (!is_null($title)) $q .= "title = '$title'";
			if (!is_null($content)) $q .= "content = '$content'";
			$q .= " where id = $id;";
			
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
			if (!is_null($id)) $q .= "where id = $id";
			$q .= ";";
			
			$rows = $this->client->executeQuery($q);
			
			// Return output:
			$items = array();
			
			foreach ($rows as $row)
			{
				$items[] = array(
					"id" => $row["id"],
					"name" => $row["name"],
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
	
	public function insertNoteCategory($name)
	{
		try
		{
			return $this->client->executeNonQuery(
				"insert into note_category (name) values ('$name');"
				);
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			return null;
		}
	}
	
	public function updateNoteCategory($id, $name)
	{
		try
		{
			$this->client->executeNonQuery(
				"update note_category set name = '$name' where id = $id;"
				);
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