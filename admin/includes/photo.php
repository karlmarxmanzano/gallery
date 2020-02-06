<?php
	
class Photo extends DatabaseObject {

	protected static $DB_TABLE = "photos";
	protected static $DB_TABLE_FIELDS = array('id', 'title', 'description', 'filename', 'type', 'size');

	public $id;
	public $title;
	public $caption;
	public $alternate_text;
	public $description;
	public $filename;
	public $type;
	public $size;

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

	public function set_file($file){

		if(empty($file) || !$file || !is_array($file)){

			$this->custom_err[] = "File is not available or missing.";
			return false;

		} else if($file['error'] != 0){

			$this->custom_err[] = $this->upload_err[$file['error']];
			return false;

		} else {

			$this->filename = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type = $file['type'];
			$this->size = $file['size'];

		}

	}

	public function img_path(){

		return $this->directory . DS . $this->filename;

	}

	public function updateOrCreate(){

		if($this->id){

			$this->update();

		} else {

			if(!empty($this->custom_err)){

				return false;

			}

			if(empty($this->filename) || empty($this->tmp_path)){

				$this->custom_err[] = "File is not available or missing.";
				return false;

			}

			$target_path = SITE_ROOT . DS . "admin" . DS . $this->directory . DS . $this->filename;

			if(file_exists($target_path)){

				$this->custom_err[] = "The file {$this->filename} already exists.";
				return false;

			}

			if(move_uploaded_file($this->tmp_path, $target_path)){

				if($this->create()) {

					unset($this->tmp_path);
					return true;

				}

			} else {

				$this->custom_err[] = "The file directory may not have persmissions.";
				return false;
				
			}

		}

	}

	public function delete_photo(){

		if($this->delete()){

			$target_path = SITE_ROOT . DS . "admin" . DS . $this->img_path();

			return unlink($target_path) ? true : false;

		} else {

			return false;

		}
		
	}

}

?>