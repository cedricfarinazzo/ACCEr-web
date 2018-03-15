<?php
class ShadowMinerProgressManager {

	protected $ID;
	protected $ID_user;
	protected $titre;
	protected $description;
	protected $date_created;
	protected $etat;
	private $cb;
	
	public function __construct(PDO $db, $data = NULL)
	{
		$this->setDb($db);
		if ($data != NULL) {
			$this->hydrate($data);
		}
	}
	
	public function __destruct()
	{
		$this->db = NULL;
	}
	
	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
	}
	
	//method
	
	
	
	public function create($id_user, $titre, $description) 
	{
		$req_insert = $this->db->prepare("INSERT INTO progress(ID_user, titre, description, date_created) VALUES(?, ?, ?, NOW())");
		$b = $req_insert->execute(array($id_user, $titre, $description));
		return $b;		
	}
	
	public function update($id, $etat) 
	{
		if ((int)$id > 0 && (int)$etat > 0) {
			$req_update = $this->db->prepare("UPDATE progress SET etat = ? WHERE ID = ?");
			$b = $req_update->execute(array((int) $etat, (int)$id));
			return $b;
		}
		return false;	
	}
	
	public function remove($id) 
	{
		if ((int)$id > 0) {
			$req_del = $this->db->prepare("DELETE FROM progress WHERE ID = ?");
			$req_del->execute(array((int)$id));
			return true;
		}
		return false;
	}
	
	public function getbyid($id) 
	{
		if ((int)$id > 0) {
			$req_get = $this->db->prepare("SELECT * FROM progress WHERE ID = ?");
			$req_get->execute(array((int)$id));
			if ($req_get->rowCount() == 1) {
				$this->hydrate($req_get->fetch());
				return true;
			}
			return false;
		}
		return false;
	}
	
	public function GetAllTask() 
	{
		$req = $this->db->query('SELECT * FROM progress');
		$req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'ShadowMinerProgressManager', array($this->db));
		return $req;
	}
	
	//getters and setters
	public function setDb(PDO $db)
	{
		$this->db = $db;
	}

	public function setId($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->ID = $id;
		}
	}
	
	public function setId_user($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->ID_user = $id;
		}
	}
	
	public function setTitre($t)
	{
		if (is_string($t))
		{
			$this->titre = $t;
		}
	}
	
	public function setDescription($data)
	{
		if (is_string($data))
		{
			$this->description = str_replace("<br />", "/n", $data);
		}
	}
	
	public function setDate_created($date)
	{
		if (is_string($date)) {
			$this->date_created = $date;
		}
	}
	
	public function setEtat($etat) 
	{
		if (is_int($etat)) {
			$this->etat = $etat;
		}
	}
	
	public function ID()
	{
		return (int)$this->ID;
	}

	public function ID_user()
	{
		return (int)$this->ID_user;
	}

	public function titre() 
	{
		return htmlspecialchars($this->titre);
	}
	
	public function description($service = NULL) 
	{
		if ($service == 'input') {
			return (str_replace(["<","script","/>",">"],"",$this->description));
		}
		if ($service == 'nochange') {
			return ($this->description);
		}
		return nl2br(htmlspecialchars($this->description));
	}
	
	public function date_created()
	{
		return strftime($this->date_created);
	}
	
	public function etat()
	{
		return (int) $this->etat;
	}

}