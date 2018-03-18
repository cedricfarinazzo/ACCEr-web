<?php
class DownloadManager {
	
	public $build_folder = WEB_PATH."/data/shadowminer/build/";
	public $exe_name = NULL;
	
	public function __construct(PDO $db)
	{
		$this->setDb($db);
	}
	
	public function __destruct()
	{
		$this->db = NULL;
	}
	
	public function search()
	{
		try {
			$folder_data = array_slice(scandir($this->build_folder), 2);
			foreach($folder_data as $val) {
				if (explode(".", $val)[count(explode(".", $val)) - 1] == "exe")
					$this->exe_name = $val;
					return true;
			return false;
			}
		} catch(Exception $e) {
			return false;
		}
		
	}
	
	public function download()
	{
		if ($this->exe_name != NULL) {
			$req_ins = $this->db->prepare("INSERT INTO download(IP) VALUES(?)");
			$req_ins->execute(array($_SERVER["REMOTE_ADDR"]));
			$path = $this->build_folder.$this->exe_name;
			header("Content-Description: File Transfer"); 
			header("Content-Type: application/octet-stream"); 
			header("Content-Disposition: attachment; filename='".$this->exe_name."'"); 
			readfile($path);
		}
	}	
	
	//getters and setters
	
	public function setDb(PDO $db)
	{
		$this->db = $db;
	}
}