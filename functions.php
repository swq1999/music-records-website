<?php
	// Database connection
	function getConnection() {
		try {
			$connection = new PDO(/*REMOVED FOR PREVACY REASONS*/);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $connection;
		} 
		catch (Exception $e) {
			throw new Exception("Connection error ". $e->getMessage(), 0, $e);
		}
	}
?>
	

