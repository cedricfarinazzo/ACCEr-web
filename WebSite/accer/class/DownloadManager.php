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
			$this->exe_name = array();
			$folder_data = array_slice(scandir($this->build_folder), 2);
			foreach($folder_data as $val) {
				if (explode(".", $val)[count(explode(".", $val)) - 1] == "exe")
					array_push($this->exe_name, $val);
			return $this->exe_name != array();
			}
		} catch(Exception $e) {
			return false;
		}
		
	}
	
	public function download(bool $lite = false)
	{
		if ($this->exe_name != NULL) {
			$req_ins = $this->db->prepare("INSERT INTO download(IP) VALUES(?)");
			$req_ins->execute(array($_SERVER["REMOTE_ADDR"]));
			$exe_name = NULL;
			if ($lite)
			{
				foreach($this->exe_name as $val)
				{
					if (strpos($val, 'lite') !== false) {
						$exe_name = $val;
					}
				}
			}
			else
			{
				foreach($this->exe_name as $val)
				{
					if (strpos($val, 'lite') === false) {
						$exe_name = $val;
					}
				}
			}
			$path = $this->build_folder.$exe_name;
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