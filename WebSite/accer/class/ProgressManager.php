<?php
class ProgressManager {
	
	private $db;
	
	protected $id_user;
	protected $login;
	protected $solo;
	protected $multi;
	protected $update;
	
	public function __construct(PDO $db, $data = NULL)
	{
		$this->setDb($db);
		if ($data != NULL) {
			$this->hydrate($data);
		}
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
	
	public function __destruct()
	{
		$this->db = NULL;
	}
	
	
	public function GetList()
	{
		$req = $this->db->query('SELECT * FROM  user LEFT JOIN Game ON Game.ID_user == user.ID ORDER BY Game.SoloStats DESC, Game.MultiStats DESC');
		$req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'ProgressManager', array($this->db));
		return $req;
	}	
	
	public function GetById($id)
	{
		if (is_int($id))
		{
			$req_user = $this->db->prepare('SELECT * FROM user WHERE ID = ?');
			$req_user->execute(array($id));
			if ($req_user->rowCount() == 1)
			{
				$data = $req_user->fetch();
				$this->hydrate($data);
				$req_progress = $this->db->prepare('SELECT * FROM Game WHERE ID_user = ?');
				$req_progress->execute(array($id));
				if ($req_progress->rowCount() == 1)
				{
					$data_p = $req_progress->fetch();
					$this->hydrate($data_p);
				}
				
				return true;
			}
			return false;
		}
		return false;
	}
	
	public function __is_smaller(ProgressManager $m1, ProgressManager $m2)
	{
		return $m1->solostats() < $m2->solostats() && $m2->multistats();
	}
	
	public function setId($id)
	{
		$this->id_user = $id;
	}
	
	public function setLogin($login)
	{
		$this->login = $login;
	}
	
	public function setSolostats($solo)
	{
		$this->solo = $solo;
	}
	
	public function setMultistats($multi)
	{
		$this->multi = $multi;
	}
	
	public function setLasttime($time)
	{
		$this->update = $time;
	}
	
	public function ID_user()
	{
		return $this->id_user;
	}
	
	public function login()
	{
		return $this->login;
	}
	
	public function solostats()
	{
		if (empty($this->solo))
		{
			return 0;
		}
		return $this->solo;
	}
	
	public function multistats()
	{
		if (empty($this->multi))
		{
			return 0;
		}
		return $this->multi;
	}
	
	public function lastupdate()
	{
		if (empty($this->update))
		{
			return "Jamais";
		}
		return $this->update;
	}
	
	public function setDb($db)
	{
		$this->db = $db;
	}
	
}