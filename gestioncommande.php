<?php

session_start();

require 'panier.class.php';
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

if (isset($_POST['valider'])) {
	
	$commande=new commande(['CmdDate'=>$_POST['CmdDate'],'CmdMontant'=>$_POST['CmdMontant'],'UserId'=>$_POST['UserId']]);
	$manager->InsertCommande($commande);
	unset($commande);

}
if (isset($_GET['modifier'])) {
	
	$commande=$manager->SelectCommande($_GET['modifier']);

}

if (isset($_POST['modifier'])) {
	
	$commande->SetCmdDate($_POST['CmdDate']);
	$commande->SetCmdMontant($_POST['CmdMontant']);
	$commande->SetUserId($_POST['UserId']);

	$manager->UpdateCommande($commande);

	unset($commande);


}

if (isset($_GET['supprimer'])) {


	$manager->deletecommande($_GET['supprimer']);

}

?>
	</ul>
	</nav>
	</div>

	<div class="main">

<table>
<tr>
<th>Commande Id</th>
<th>Commande Date</th>
<th>Commande Montant</th>
<th>User Id</th>
<th>Action</th>
</tr>

<?php 

$listeCommande=$manager->SelectLiCommande();
foreach ($listeCommande as $unecommande) {

echo 
'<tr>
<td>'.$unecommande->CmdId().'</td>
<td>'.$unecommande->CmdDate().'</td>
<td>'.$unecommande->CmdMontant().'</td>
<td>'.$unecommande->UserId().'</td>
<td><a href="?modifier='.$unecommande->CmdId().'">modifier</a> | <a href="?supprimer='.$unecommande->CmdId().'">supprimer</a></td>
</tr>';
}

?>

</table>

		<fieldset>
		
	<legend>completer formulaire pour ajouter une commande :</legend>

	<form method="post">
		<p>Produit Titre:<input type="txt" name="CmdDate" value="<?php if(isset($commande)){echo $commande->CmdDate() ;}?>"></p>
		<p>Produit Descriptif:<input type="txt" name="CmdMontant" value="<?php if(isset($commande)){echo $commande->CmdMontant() ;}?>"></p>
		<p>Produit Prix:<input type="txt" name="UserId" value="<?php if(isset($commande)){echo $commande->UserId() ;}?>"></p>

		<?php if(isset($commande)){echo'<input type="submit" name="modifier" value="modifier">';}else{echo'<input type="submit" name="valider">';}?>

	</form>

	</fieldset>

	</div>

	</header>

	<footer>
	
	</footer>



</body>