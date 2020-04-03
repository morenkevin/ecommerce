<?php
session_start();

include("connexionBDD.php");

if (isset($_POST['valider'])) {

	$user = new user(['UserLogin'=>$_POST['login'],'UserMdp'=>$_POST['mdp'],'UserNom'=>$_POST['nom'],'UserPrenom'=>$_POST['prenom'],'UserAdresse'=>$_POST['adresse']]);

	$manager->InsertUser($user);

	$user=$manager->SelectUser($_POST['login'],$_POST['mdp']);

	$_SESSION['USER']=serialize($user);
	
	header('location:menu.php');

	
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
			
		


	echo '<br>';
	echo '<li><a href="listeproduit.php?categorie='.$uncategorie->CatId().'">'.$uncategorie->CatLib().'</a></li>';
	

}
?>






	</ul>
	</nav>
	</div>

	<div class="main">



<fieldset>
<legend>création de compte:</legend>	
<form method="post">
	
<p>login:<input type="text" name="login"></p>
<p>mot de passe:<input type="text" name="mdp"></p>
<p>nom:<input type="text" name="nom"></p>
<p>prenom:<input type="text" name="prenom"></p>
<p>adresse:<input type="text" name="adresse"></p>

<input type="submit" name="valider" value="valider">
</form>

</fieldset>




	</div>


	
	</header>

	<footer>
	


	</footer>



</body>



















