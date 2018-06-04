<?php
class ForumManager {
	
	private $db;
	protected $forum = array
	
	public function __construct(PDO $db)
	{
		$this->setDb($db);
	}
	
	public function __destruct()
	{
		$this->db = NULL;
	}
	
	public function setDb($db)
	{
		$this->db = $db;
	}
	
}