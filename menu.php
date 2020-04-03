<?php
session_start();

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
			
		


	echo '<br>';
	echo '<li><a href="listeproduit.php?categorie='.$uncategorie->CatId().'">'.$uncategorie->CatLib().'</a></li>';
	

}
?>

	</ul>
	</nav>
	</div>

	<div class="main">
	<p>Mise en forme contextuelle Le concepteur d’un style peut aussi utiliser les informations contextuelles relatives au document HTML. C'est-à-dire qu’il est possible d’indiquer qu’une balise, une classe, un id utilise une mise en forme prédéfinie si les balises, classes ou id ancêtres de celui-ci correspondent au contexte indiqué. 
 
Prenons pour exemple la définition suivante :    span div   { text-transform:uppercase; color:#0000FF} 
 
Le style défini ici s’applique exclusivement aux balises div qui ont pour ancêtre une balise span</p>

	<div class="slider">
	<p>Offres Promotionnelles :</p>
		<a href="https://fr.pornhub.com/"><div class="item"></div></a>
		<a href="https://fr.pornhub.com/"><div class="item1"></div></a>
		<a href="https://fr.pornhub.com/"><div class="item2"></div></a>

	</div>
	<div class="block1"><p>CMoinsChere.com <br>34 rue du Faubourg Vivian <br>56450<br>Le hézo</p> </div>
	<div class="block2"><p>Contacts : <br>Mail:contact@CMoinsCher.com <br>Tél:0202020200</p></div>



	</div>


	
	</header>

	<footer>
	


	</footer>



</body>

