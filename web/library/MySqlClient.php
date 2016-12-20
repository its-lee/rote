<?php
class MySqlClientException extends Exception
{
	public function __construct($message, $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}

class MySqlClient
{
	private $conn;
	
	// Expects a map with entries:
	//   dbname
	//   host
	//   username
	//   password
	public function __construct($config)
	{
		// Create connection
		$this->conn = new mysqli(
			$config["host"], 
			$config["username"], 
			$config["password"], 
			$config["dbname"]
			);
		
		$this->checkConnection();
	}
	
	private function checkConnection()
	{
		// Check connection
		if ($this->conn->connect_error)
			throw new MySqlClientException("Connection failed: " . $this->conn->connect_error);
	}
	
	public function escapeString($str)
	{
		$this->checkConnection();
		
		return $this->conn->real_escape_string($str);
	}
	
	public function executeNonQuery($query)
	{
		try
		{
			$this->checkConnection();
			
			$result = $this->conn->query($query);
			
			if ($result === FALSE)
				throw new MySqlClientException("Query failed: " . $query . " with error" . $this->conn->error);
			
			return $this->conn->insert_id;
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			throw $e;
		}
	}
	
	public function executeQuery($query)
	{
		try
		{
			$this->checkConnection();
			
			$result = $this->conn->query($query);
			
			if ($result === FALSE)
				throw new MySqlClientException("Query failed: " . $query . " with error" . $this->conn->error);
			
			try
			{
				$rows = array();
				
				while ($row = $result->fetch_array())
					$rows[] = $row;
				
				return $rows;
			}
			finally
			{
				$result->close();
			}
		}
		catch (Exception $e)
		{
			error_log($e->getMessage());
			throw $e;
		}
	}
	
	public function __destruct()
	{
		try
		{
			$this->conn->close();
		}
		catch (Exception $e) {}
	}
}
?>