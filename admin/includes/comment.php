<?php
	
class Comment extends DatabaseObject {

	protected static $DB_TABLE = "comments";
	protected static $DB_TABLE_FIELDS = array('id', 'photo_id', 'author', 'body');

	public $id;
	public $photo_id;
	public $author;
	public $body;

	public static function createComment($photo_id, $author, $body){

		if(!empty($photo_id) && !empty($body)){

			$comment = new Comment();

			$comment->photo_id = (int)$photo_id;
			$comment->author = $author;
			$comment->body = $body;

			return $comment->updateOrCreate() ? true : false;

		} else {

			return false;

		}

	}

	public static function find_comments($photo_id = 0){

		global $database;

		$sql = "SELECT * FROM " . static::$DB_TABLE . " WHERE photo_id = " . $database->escape_string($photo_id) . " ORDER BY photo_id";

		return self::find_by_query($sql);

	}


}

?>