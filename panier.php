<?php
session_start();

require 'panier.class.php';

include("connexionBDD.php");

if (isset($_GET['delete'])) {
	$panier=new panier();
	$panier->delete($_GET['delete']);



}
if (isset($_SESSION['USER'])) {
	$user=unserialize($_SESSION['USER']);



}

if (isset($_POST['valider'])) {


	
	
	$commande=$manager->SelectCommande($manager->SelectLastIdCommande($user->Userid()));
	$commande->SetCmdMontant($_POST['total']);
	$commande->SetCmdId($manager->SelectLastIdCommande($user->Userid()));
	$manager->UpdateCommande($commande);

	$products=$manager->SelectProdPanier();

	$tableaulignecommande = [];
	foreach ($products as $unproduit) {
		$lignecommande=new lignecommande(['ProdId'=>$unproduit->ProdId(),'Qte'=>1]);
		$tableaulignecommande[$unproduit->ProdId()]=$lignecommande;
	


}
foreach ($tableaulignecommande as $lignecommande) {
		$lignecommande->SetCmdId($manager->SelectLastIdCommande($user->Userid()));
		$manager->InsertLigneCommande($lignecommande);

}

unset($_SESSION['panier']);
unset($_SESSION['commande']);
die('votre commande a bien été faite !<a href="menu.php"> retour a la page au menu</a>');



}








?>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css" type="txt/css">




</head>


	
<body>
	<header>
	<div class="en-tete">
	<a href="menu.php"><div class="logo"></div></a>



	</div>		
	<div class="sider"><nav>Rayon :
	<ul>
	<?php

	if (isset($_SESSION['USER'])) {
		
	$user=unserialize($_SESSION['USER']);
	echo'Bonjour '.$user->UserLogin();
	
	echo '<li><a href="?deconnection">deconnection</a></li>';
	echo '<li><a href="panier.php">mon panier ('.$manager->count().')</a></li>';

	}
	else
	{
		echo '<li><a href="login.php">Identifiez vous</a></li>';
		echo'<li><a href="register.php">enregistrez vous</a></li>';
	}


	if (isset($_GET['deconnection'])) {
		session_destroy();
	}
	?>
		
	

		<?php 

		foreach ($manager->SelectLiCategorie() as $uncategorie) {
			# code...
		


	echo '<br>';
	echo '<li><a href="listeproduit.php?categorie='.$uncategorie->CatId().'">'.$uncategorie->CatLib().'</a></li>';
	

}
?>




	</ul>
	</nav>
	</div>

	<div class="main">

<?php
if (empty($_SESSION['panier'])) {
	echo 'votre panier est vide';
}
else
{
	if (!isset($_SESSION['commande'])) {
		
	
if (!isset($commande)) {
	$commande =new commande(['UserId'=>$user->Userid()]);
	$manager->InsertCommande($commande);
	$_SESSION['commande']=serialize($commande);
	

}
}

	

$products=$manager->SelectProdPanier();


	
foreach ($products as $unproduit) {

	
	
	echo '<fieldset>
	<legend>Prod</legend>'.$unproduit->ProdTitre().' | '.$unproduit->ProdDescriptif().' | '.$unproduit->ProdPrix().'euros | <a href="?delete='.$unproduit->ProdId().'">supprimer</a></fieldset>';
	

}

	



}




?>

<p>total :<?php if (!empty($manager->total())){ echo $manager->total().'euros';} ?></p>

<form method="post">
<input type="hidden" name="total" value="<?= $manager->total() ?>">
<input type="submit" name="valider" value="valider">

</form>
	</div>


	
	</header>

	<footer>
	


	</footer>



</body>