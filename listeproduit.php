<?php

session_start();

include("connexionBDD.php");

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



if(isset($_GET['categorie'])){

$listeproduitcategorie=$manager->SelectliProduitCategorie($_GET['categorie']);

$categorie=$_GET['categorie'];

foreach ($listeproduitcategorie as $unproduit ) {
	
	
	echo '<a href="?produit='.$unproduit->ProdId().'&amp;categorieprod='.$categorie.'"><div class="itemcateg">'.$unproduit->ProdTitre().'</div></a>';
	echo '<br>';





}

}

if (isset($_GET['produit']) && isset($_GET['categorieprod'])) {

	$unproduit=$manager->SelectProduit($_GET['produit']);

	$categorie=$_GET['categorieprod'];
	

echo '<fieldset>
	<legend>Produit :</legend>
	<h1>'.$unproduit->ProdTitre().'</h1>
	<p>'.$unproduit->ProdDescriptif().'</p>
	<p>'.$unproduit->ProdPrix().' euros</p>







	<a href="article.php?id='.$unproduit->ProdId().'&amp;categorie='.$categorie.'">ajouter</a>
	</fieldset>';


}



?>






	</div>


	
	</header>

	<footer>
	


	</footer>



</body>


