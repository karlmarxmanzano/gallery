<?php
	
class DatabaseObject {

	public static function instantiation($records){

		$class = get_called_class();

		$obj = new $class;

        foreach ($records as $attr => $value) {
        	
        	if($obj->has_attribute($attr)){

        		$obj->$attr = $value;

        	}

        }

        return $obj;

	}

	public function has_attribute($attr){

		$properties = get_object_vars($this);

		return array_key_exists($attr, $properties);

	}

	protected function properties(){

		global $database;

		$properties = array();

		foreach (static::$DB_TABLE_FIELDS as $fields) {

			if(property_exists($this, $fields)){

				$properties[$fields] = $this->$fields;

			}
			
		}

		return $properties;

	}

	protected function escape_properties(){

		global $database;

		$escape_properties = array();

		foreach ($this->properties() as $key => $value) {
			
			$escape_properties[$key] = $database->escape_string($value);

		}

		return $escape_properties;

	}

	public static function find_by_query($sql){

		global $database;

		$results = $database->query($sql);

		$obj = array();

		while ($row = mysqli_fetch_array($results)) {
			
			$obj[] = static::instantiation($row);

		}

		return $obj;

	}

	public static function find_all(){

		return static::find_by_query("SELECT * FROM " . static::$DB_TABLE);

	}

	public static function find_by_id($id){

		global $database;

		$results = static::find_by_query("SELECT * FROM " . static::$DB_TABLE . " WHERE id = $id LIMIT 1");

		return !empty($results) ? array_shift($results) : false;

	}

	public function create(){

		global $database;

		$properties = $this->escape_properties();

		$sql = "INSERT INTO " . static::$DB_TABLE . " (" . implode(", ", array_keys($properties)) . ") VALUES('" . implode("', '", array_values($properties)) . "')";

		if($database->query($sql)){

			$this->id = $database->last_inserted_id();
			return true;

		} else {

			return false;

		}

	}

	public function update(){

		global $database;

		$properties = $this->escape_properties();
		$property_pairs = array();

		foreach ($properties as $key => $value) {
			
			$property_pairs[] = "{$key} = '{$value}'";

		}

		$sql = "UPDATE " . static::$DB_TABLE . " SET " . implode(", ", $property_pairs) .  " WHERE id = '" . $database->escape_string($this->id) . "'";

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}

	public function updateOrCreate(){

		return isset($this->id) ? $this->update() : $this->create();

	}

	public function delete(){

		global $database;

		$sql = "DELETE FROM " . static::$DB_TABLE . " WHERE id = " . $database->escape_string($this->id);

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}

}

?>