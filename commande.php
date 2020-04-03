<?php

class commande
{
	protected $CmdId;
	protected $CmdDate;
	protected $CmdMontant;
	protected $UserId;

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

	public function SetCmdId($id)
	{
		$this->CmdId=$id;
	}
		public function SetCmdDate($date)
	{
		$this->CmdDate=$date;
	}
		public function SetCmdMontant($montant)
	{
		$this->CmdMontant=$montant;
	}
		public function SetUserId($userid)
	{
		$this->UserId=$userid;
	}

	public function CmdId()
	{
		return $this->CmdId;
	}
	public function CmdDate()
	{
		return $this->CmdDate;
	}
	public function CmdMontant()
	{
		return $this->CmdMontant;
	}
	public function UserId()
	{
		return $this->UserId;
	}

}

?>