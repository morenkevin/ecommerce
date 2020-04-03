<?php
/**
* 
*/
class produit 
{
	
	protected $ProdId;
	protected $ProdTitre;
	protected $ProdDescriptif;
	protected $ProdPrix;
	protected $CatId;


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
	public function SetProdId($id)
	{
		$this->ProdId=$id;
	}
	public function SetProdTitre($titre)
	{
		$this->ProdTitre=$titre;
	}
	public function SetProdDescriptif($descriptif)
	{
		$this->ProdDescriptif=$descriptif;
	}
	public function SetProdPrix($prix)
	{
		$this->ProdPrix=$prix;
	}
	public function SetCatId($catid)
	{
		$this->CatId=$catid;
	}

	//GETTER

	public function ProdId()
	{
		return $this->ProdId;
	}	
	public function ProdTitre()
	{
		return $this->ProdTitre;
	}	
	public function ProdDescriptif()
	{
		return $this->ProdDescriptif;
	}	
	public function ProdPrix()
	{
		return $this->ProdPrix;
	}	
	public function Catid()
	{
		return $this->CatId;
	}	






}




?>