<?php
/**
* 
*/
class user
{
	
	protected $UserId;
	protected $UserLogin;
	protected $UserMdp;
	protected $UserNom;
	protected $UserPrenom;
	protected $UserAdresse;


	function __construct($donne= [])
	{
		
		$this->hydrate($donne);
	}

	public function hydrate($donne)
	{
		foreach ($donne as $key => $value) {
			$methode='Set'.ucfirst($key);

			if (method_exists($this,$methode)) {
				
				$this->$methode($value);
			}

		}

	}

	//SETTER
	public function SetUserid($id)
	{
		$this->UserId=$id;
	}

	public function SetUserlogin($login)
	{
		$this->UserLogin=$login;
	}
	public function SetUsermdp($mdp)
	{
		$this->UserMdp=$mdp;
	}
	public function SetUsernom($nom)
	{
		$this->UserNom=$nom;
	}
	public function SetUserprenom($prenom)
	{
		$this->UserPrenom=$prenom;
	}
	public function SetUserAdresse($adresse)
	{
		$this->UserAdresse=$adresse;
	}

	//GETTER

	public function Userid()
	{
		return $this->UserId;
	}

	public function Userlogin()
	{
		return $this->UserLogin;
	}

	public function Usermdp()
	{
		return $this->UserMdp;
	}
	

	public function Usernom()
	{
		return $this->UserNom;
	}

	public function Userprenom()
	{
		return $this->UserPrenom;
	}

	public function Useradresse()
	{
		return $this->UserAdresse;
	}





}






?>