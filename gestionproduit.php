<?php
session_start();

require 'panier.class.php';

function autoloader($classname)
{
	require $classname.'.php';
}

try{
$pdo=new pdo('mysql:host=localhost;dbname=ecommerce','root','');

}
catch(PDOException $e)
{
echo 'impossible de se connecter a la bdd'.$e->getmessage();
}

spl_autoload_register('autoloader');


$manager= new manager($pdo);




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

if (isset($_POST['valider'])) {
	
	$produit=new produit(['ProdTitre'=>$_POST['prodtitre'],'ProdDescriptif'=>$_POST['proddescriptif'],'ProdPrix'=>$_POST['prodprix'],'CatId'=>$_POST['prodcat']]);
	$manager->InsertProduit($produit);
	unset($produit);

}
if (isset($_GET['modifier'])) {
	
	$produit=$manager->SelectProduit($_GET['modifier']);


}

if (isset($_POST['modifier'])) {
	
	$produit->SetProdTitre($_POST['prodtitre']);
	$produit->SetProdDescriptif($_POST['proddescriptif']);
	$produit->SetProdPrix($_POST['prodprix']);
	$produit->SetCatId($_POST['prodcat']);



	$manager->UpdateProduit($produit);

	unset($produit);


}

if (isset($_GET['supprimer'])) {
	
	$manager->deleteproduit($_GET['supprimer']);
	header('location:gestionproduit.php');
	
}


?>
	</ul>
	</nav>
	</div>

	<div class="main">



<table>


<tr>
<th>Produit Id</th>
<th>Produit Titre</th>
<th>Produit Descriptif</th>
<th>Produit Prix</th>
<th>Categorie Id</th>
<th>Action</th>
</tr>


<?php 

$listeprod=$manager->SelectLiProduit();
foreach ($listeprod as $unproduit) {
	

echo 
'<tr>
<td>'.$unproduit->ProdId().'</td>
<td>'.$unproduit->ProdTitre().'</td>
<td>'.$unproduit->ProdDescriptif().'</td>
<td>'.$unproduit->ProdPrix().'</td>
<td>'.$unproduit->CatId().'</td>
<td><a href="?modifier='.$unproduit->ProdId().'">modifier</a> | <a href="?supprimer='.$unproduit->ProdId().'">supprimer</a></td>
</tr>';
}

?>

</table>

		<fieldset>
		
	<legend>completer formulaire pour ajouter un objet :</legend>

	<form method="post">
		<p>Produit Titre:<input type="txt" name="prodtitre" value="<?php if(isset($produit)){echo $produit->ProdTitre() ;}?>"></p>
		<p>Produit Descriptif:<input type="txt" name="proddescriptif" value="<?php if(isset($produit)){echo $produit->ProdDescriptif() ;}?>"></p>
		<p>Produit Prix:<input type="txt" name="prodprix" value="<?php if(isset($produit)){echo $produit->ProdPrix() ;}?>"></p>
		<p>Produit Categorie:<input type="txt" name="prodcat" value="<?php if(isset($produit)){echo $produit->CatId() ;}?>"></p>

		<?php if(isset($produit)){echo'<input type="submit" name="modifier" value="modifier">';}else{echo'<input type="submit" name="valider">';}?>

	</form>



	</fieldset>


	</div>


	
	</header>

	<footer>
	


	</footer>



</body>