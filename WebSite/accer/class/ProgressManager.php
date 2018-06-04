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
		if (is_int($id)
		{
			$req = $this->db->prepare('SELECT * FROM  user LEFT JOIN Game ON Game.ID_user == user.ID WHERE user.ID = ?');
			$req->execute(array($id));
			if ($req->rowCount() == 1)
			{
				$this->hydrate($req->fetch());
				return true;
			}
			return false;
		}
		return false;
	}
	
	public function __is_smaller(ProgressManager $m1, ProgressManager $m2)
	{
		return $m1->solostats() < $m2->solostats() && $m2->multistats()
	}
	
	public function setId_user($id)
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
		return $this->solo;
	}
	
	public function multistats()
	{
		return $this->multi;
	}
	
	public function lastupdate()
	{
		return $this->update;
	}
	
	public function setDb($db)
	{
		$this->db = $db;
	}
	
}