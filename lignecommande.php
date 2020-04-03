<?php
/**
* 
*/
class lignecommande
{
	protected $LigneId;
	protected $CmdId;
	protected $ProdId;
	protected $Qte;

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


	public function SetLigneId($id)
	{
		$this->LigneId=$id;
	}
		public function SetCmdId($cmdid)
	{
		$this->CmdId=$cmdid;
	}
		public function SetProdId($prodid)
	{
		$this->ProdId=$prodid;
	}
		public function SetQte($Qte)
	{
		$this->Qte=$Qte;
	}

	public function LigneId()
	{
		return $this->LigneId;
	}
	public function CmdId()
	{
		return $this->CmdId;
	}
	public function ProdId()
	{
		return $this->ProdId;
	}
	public function Qte()
	{
		return $this->Qte;
	}





}









?>