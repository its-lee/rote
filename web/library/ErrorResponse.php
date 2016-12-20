<?php
	function createErrorResponse($e = null)
	{
		return json_encode(
			array("error" => 
				array(
					"uri" => $_SERVER['REQUEST_URI'],
					"qs" => $_SERVER['QUERY_STRING'],
					"msg" => is_null($e) ? $e->getMessage() : ""
				)
			)
		);
	}
?>