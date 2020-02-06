<?php

require_once('config.php');

class Database {

	public $connection;

	public function __construct(){

		$this->open_db_connection();

	}

	public function open_db_connection(){

		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if($this->connection->connect_errno){

			die("Database connection failed. " . $this->connection->connect_error);

		} else {

			// echo "Database successfully connected.";

		}

	}

	public function query($sql){

		$result = $this->connection->query($sql);

		$this->confirm_query($result);

		return $result;

	}

	private function confirm_query($result){

		if(!$result){

			die("Query failed. " . $this->connection->error);

		} else {

			// echo "Query successful.";

		}

	}

	public function escape_string($string){

		$escaped_string = $this->connection->real_escape_string($string);

		return $escaped_string;

	}

	public function the_insert_id(){

		return $this->connection->insert_id;

	}

	public function last_inserted_id(){

		return mysqli_insert_id($this->connection);
		
	}

}

$database = new Database();

?>