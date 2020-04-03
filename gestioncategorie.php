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
	
	$categ=new categorie(['CatLib'=>$_POST['catlib']]);
	$manager->InsertCategorie($categ);
	unset($categ);
	header('location:gestioncategorie.php');

}
if (isset($_GET['modifier'])) {
	
	$categ=$manager->SelectCategorie($_GET['modifier']);


}

if (isset($_POST['modifier'])) {
	
	
	$categ->SetCatLib($_POST['catlib']);




	$manager->UpdateCateg($categ);

	unset($categ);
	header('location:gestioncategorie.php');

}

if (isset($_GET['supprimer'])) {


	$manager->deletecategorie($_GET['supprimer']);
	header('location:gestioncategorie.php');

}





?>




	</ul>
	</nav>
	</div>

	<div class="main">



<table>


<tr>
<th>Categorie Id</th>
<th>Cat Libéllé</th>
<th>Action</th>
</tr>


<?php 

$listecateg=$manager->SelectLiCategorie();

foreach ($listecateg as $unecategorie) {
	

echo 
'<tr>
<td>'.$unecategorie->CatId().'</td>
<td>'.$unecategorie->CatLib().'</td>

<td><a href="?modifier='.$unecategorie->CatId().'">modifier</a> | <a href="?supprimer='.$unecategorie->CatId().'">supprimer</a></td>
</tr>';
}

?>

</table>

		<fieldset>
		
	<legend>completer formulaire pour ajouter un objet :</legend>

	<form method="post">
		<p>Categorie Libéllé:<input type="txt" name="catlib" value="<?php if(isset($categ)){echo $categ->CatLib() ;}?>"></p>

		<?php if(isset($categ)){echo'<input type="submit" name="modifier" value="modifier">';}else{echo'<input type="submit" name="valider">';}?>

	</form>



	</fieldset>


	</div>


	
	</header>

	<footer>
	


	</footer>



</body>