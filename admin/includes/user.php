<?php

class User extends DatabaseObject {

	protected static $DB_TABLE = "users";
	protected static $DB_TABLE_FIELDS = array('id', 'username', 'password', 'first_name', 'last_name', 'user_img');

	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_img;
	public $img_placeholder = "https://via.placeholder.com/250";

	public $tmp_path;
	public $directory = "images";
	public $custom_err = array();
	public $upload_err = array(
							UPLOAD_ERR_OK => "No error found.",
							UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the UPLOAD_MAX_SIZE.",
							UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE.",
							UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
							UPLOAD_ERR_NO_FILE => "No file was uploaded.",
							UPLOAD_ERR_NO_TMP_DIR => "Temporary folder missing.",
							UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
							UPLOAD_ERR_EXTENSION => "A PHP Extension stopped the file upload."
						);

	public function img_path(){
		return !empty($this->user_img) ? $this->directory . DS . $this->user_img : $this->img_placeholder;
	}

	public static function verify_user($username, $password){

		global $database;

		$username = $database->escape_string($username);
		$password = $database->escape_string($password);

		$result = self::find_by_query("SELECT * FROM " . self::$DB_TABLE . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1");

		return !empty($result) ? array_shift($result) : false;

	}

	public function delete_photo(){

		if($this->delete()){

			$target_path = SITE_ROOT . DS . "admin" . DS . $this->img_path();

			return unlink($target_path) ? true : false;

		} else {

			return false;

		}
		
	}

	public function set_file($file){

		if(empty($file) || !$file || !is_array($file)){

			$this->custom_err[] = "File is not available or missing.";
			return false;

		} else 

		if($file['error'] != 0){

			$this->custom_err[] = $this->upload_err[$file['error']];
			return false;

		} else {

			$this->user_img = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];

		}

	}

	public function uploadUserPhoto(){

		// if($this->id){

		// 	$this->update();

		// } else {

			if(!empty($this->custom_err)){

				return false;

			}

			if(empty($this->user_img) || empty($this->tmp_path)){

				$this->custom_err[] = "File is not available or missing.";
				return false;

			}

			$target_path = SITE_ROOT . DS . "admin" . DS . $this->directory . DS . $this->user_img;

			if(file_exists($target_path)){

				$this->custom_err[] = "The file {$this->user_img} already exists.";
				return false;

			}

			if(move_uploaded_file($this->tmp_path, $target_path)){

				// if($this->create()) {

					unset($this->tmp_path);
					return true;

				// }

			} else {

				$this->custom_err[] = "The file directory may not have persmissions.";
				return false;
				
			}

		// }

	}

}

?>