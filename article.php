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
?>




	</ul>
	</nav>
	</div>

	<div class="main">

<?php

if (isset($_GET['id']) && isset($_GET['categorie'])) {
	
	$produit=$manager->SelectProduit($_GET['id']);
	
	$panier=new panier();
	$panier->add_panier($produit);

	



}
else{

die('vous n\'avez pas selectionner de produit !');



}



?>



	</div>


	
	</header>

	<footer>
	


	</footer>



</body>