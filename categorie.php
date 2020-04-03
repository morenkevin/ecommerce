<?php



class categorie
{
	protected $CatId;
	protected $CatLib;


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

	public function SetCatId($id)
	{

		$this->CatId=$id;

	}
	public function SetCatLib($lib)
	{

		$this->CatLib=$lib;

	}

	public function CatId()
	{
		return $this->CatId;
	}
	public function CatLib()
	{
		return $this->CatLib;
	}








}


?>