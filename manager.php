<?php

class manager
{
	protected $pdo;
	
	function __construct(PDO $pdo)
	{
		$this->SetPDO($pdo);
	}

	public function SetPDO($pdo)
	{
		$this->pdo=$pdo;
	}

	public function InsertUser(user $user)
	{
		$requete=$this->pdo->prepare('INSERT INTO user (UserLogin,UserMdp,UserNom,UserPrenom,UserAdresse) VALUES (:userlogin,:usermdp,:usernom,:userprenom,:useradresse)');

		$requete->bindValue(':userlogin',$user->UserLogin());
		$requete->bindValue(':usermdp',$user->UserMdp());
		$requete->bindValue(':usernom',$user->UserNom());
		$requete->bindValue(':userprenom',$user->UserPrenom());
		$requete->bindValue(':useradresse',$user->UserAdresse());
		$requete->execute();
	}

	public function SelectUser($login,$mdp)
	{

		$requete=$this->pdo->prepare('SELECT * FROM user WHERE UserLogin=:login AND UserMdp=:mdp');
		$requete->bindValue(':login',$login);
		$requete->bindValue(':mdp',$mdp);
		$requete->execute();
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'user');
		$user=$requete->fetch();

		return $user;





	}

	public function SelectLiProduit()
	{
		$requete=$this->pdo->query('SELECT ProdId, ProdTitre, ProdDescriptif, ProdPrix, CatId FROM PRODUIT');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'produit');
		$listeproduit=$requete->fetchAll();
		return $listeproduit;


	}

	public function SelectLiCategorie()
	{
		$requete=$this->pdo->query('SELECT CatId, CatLib FROM categorie');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'categorie');
		$listecategorie=$requete->fetchAll();
		return $listecategorie;


	}

	public function SelectliProduitCategorie($catid)
	{

		$requete=$this->pdo->prepare('SELECT produit.ProdId,produit.ProdTitre,produit.ProdDescriptif,produit.ProdPrix FROM categorie INNER JOIN produit ON categorie.CatId = produit.CatId WHERE categorie.CatId=:catid');
		$requete->bindValue(':catid',$catid);
		$requete->execute();
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'produit');
		$listeproduitcategorie=$requete->fetchAll();

		return $listeproduitcategorie;

	}

	public function SelectProduit($id)
	{

		$requete=$this->pdo->prepare('SELECT * FROM produit WHERE ProdId=:id');
		$requete->bindValue(':id',$id);
		$requete->execute();
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'produit');
		$produit=$requete->fetch();
		return $produit;


	}

	public function InsertLigneCommande(lignecommande $lignecommande)
	{

		$requete=$this->pdo->prepare('INSERT INTO lignecommande (CmdId,ProdId,Qte) VALUES (:cmdid,:prodid,:qte)');
		$requete->bindValue(':cmdid',$lignecommande->CmdId());
		$requete->bindValue(':prodid',$lignecommande->ProdId());
		$requete->bindValue(':qte',$lignecommande->Qte());
		$requete->execute();

	}

	public function InsertCommande(commande $commande)
	{
		$requete=$this->pdo->prepare('INSERT INTO commande (UserId) VALUES (:userid)');
		$requete->bindValue(':userid',$commande->UserId());
		$requete->execute();


	}

	public function SelectProdPanier()
	{
		$ids=array_keys($_SESSION['panier']);
		$requete=$this->pdo->query('SELECT * FROM produit WHERE ProdId IN ('.implode(',',$ids).')');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'produit');
		$products=$requete->fetchAll();
		return $products;





}

	public function total()
	{
		if (!empty($_SESSION['panier'])) {
			# code...

	$total=0;
		$ids=array_keys($_SESSION['panier']);
		$requete=$this->pdo->query('SELECT * FROM produit WHERE ProdId IN ('.implode(',',$ids).')');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'produit');
		$products=$requete->fetchAll();
		
		foreach ($products as $produit) {

			$total += $produit->ProdPrix();



			
		}
		return $total;

		
	}
	else {
		echo 'aucun produit dans le panier';
	}
	

}

public function count()
	{
		if (isset($_SESSION['panier'])) {
			return array_sum($_SESSION['panier']);
		}
		

	}

	public function UpdateLigneCommande($idprod,$id)
	{
		$requete=$this->pdo->prepare('UPDATE lignecommande SET CmdId=:id WHERE ProdId=:idprod');
		$requete->bindValue(':id',$id);
		$requete->bindValue(':idprod',$idprod);
		$requete->execute();
		

	}

	public function SelectLastIdCommande($iduser)
	{

		$requete=$this->pdo->prepare('SELECT MAX(CmdId) from commande inner join user on commande.UserId = user.Userid where user.UserId = :iduser');
		$requete->bindValue(':iduser',$iduser);
		$requete->execute();
		$idcommande=$requete->fetch();
		return $idcommande['0'];
	}

	public function UpdateCommande(commande $commande)
	{

		$requete=$this->pdo->prepare('UPDATE commande SET CmdDate=NOW(),CmdMontant=:cmdmontant WHERE CmdId=:id');
		$requete->bindValue(':cmdmontant',$commande->CmdMontant());
		$requete->bindValue(':id',$commande->CmdId());
		$requete->execute();


	}

	public function SelectCommande($id)
	{
		$requete=$this->pdo->prepare('SELECT * FROM commande WHERE CmdId=:id');
		$requete->bindValue(':id',$id);
		$requete->execute();
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'commande');
		$commande=$requete->fetch();
		return $commande;
	}

	public function SelectLastIdLigneCommande($iduser)
	{

		$requete=$this->pdo->prepare('SELECT MAX(CmdId) from commande inner join user on commande.UserId = user.Userid where user.UserId = :iduser');
		$requete->bindValue(':iduser',$iduser);
		$requete->execute();
		$idcommande=$requete->fetch();
		return $idcommande['0'];
	}

	public function InsertProduit(produit $prod)
	{
		$requete=$this->pdo->prepare('INSERT INTO produit (ProdTitre,ProdDescriptif,ProdPrix,CatId) VALUES (:prodtitre,:proddescriptif,:prodprix,:catid)');
		$requete->bindValue(':prodtitre',$prod->ProdTitre());
		$requete->bindValue(':proddescriptif',$prod->ProdDescriptif());
		$requete->bindValue(':prodprix',$prod->ProdPrix());
		$requete->bindValue(':catid',$prod->CatId());
		$requete->execute();


	}

	public function deleteproduit($id)
	{
	$requete=$this->pdo->prepare('DELETE FROM produit WHERE ProdId=:id');
	$requete->bindValue(':id',$id);
	$requete->execute();
	}

	public function UpdateProduit(produit $produit)
	{

		$requete=$this->pdo->prepare('UPDATE produit SET ProdTitre=:titre,ProdDescriptif=:descriptif,ProdPrix=:prix,CatId=:catid WHERE ProdId=:id');
		$requete->bindValue(':titre',$produit->ProdTitre());
		$requete->bindValue(':descriptif',$produit->ProdDescriptif());
		$requete->bindValue(':prix',$produit->ProdPrix());
		$requete->bindValue(':catid',$produit->CatId());
		$requete->bindValue(':id',$produit->ProdId());
		$requete->execute();


	}

		public function InsertCategorie(categorie $categ)
	{
		$requete=$this->pdo->prepare('INSERT INTO categorie (CatLib) VALUES (:catlib)');
		$requete->bindValue(':catlib',$categ->CatLib());
		$requete->execute();


	}

	public function deletecategorie($id)
	{
	$requete=$this->pdo->prepare('DELETE FROM categorie WHERE CatId=:id');
	$requete->bindValue(':id',$id);
	$requete->execute();

}

	public function UpdateCateg(categorie $categ)
	{

		$requete=$this->pdo->prepare('UPDATE categorie SET CatLib=:catlib WHERE CatId=:id');
		$requete->bindValue(':catlib',$categ->CatLib());
		$requete->bindValue(':id',$categ->CatId());
		$requete->execute();


	}

		public function SelectCategorie($id)
	{
		$requete=$this->pdo->prepare('SELECT * FROM categorie WHERE CatId=:id');
		$requete->bindValue(':id',$id);
		$requete->execute();
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'categorie');
		$categorie=$requete->fetch();
		return $categorie;
	}


	public function SelectLiCommande()
	{
		$requete=$this->pdo->query('SELECT * FROM commande');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'commande');
		$listecommande=$requete->fetchAll();
		return $listecommande;


	}


}
?>