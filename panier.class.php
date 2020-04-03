<?php

class panier
{
	
	function __construct()
	{
		if (!isset($_SESSION['panier'])) {
		
			$_SESSION['panier']= array();



		}
	}

	public function add_panier(produit $produit)
	{
		if (isset($_SESSION['panier'][$produit->ProdId()])) {
			
			$_SESSION['panier'][$produit->ProdId()]++;
			die('le produit a bien été ajouté !');

					}
					else
					{
		$_SESSION['panier'][$produit->ProdId()] = 1;
		die('le produit a bien été ajouté !');

					}



	}

	public function delete($productid)
	{

		unset($_SESSION['panier'][$productid]);




	}

	


	}














?>