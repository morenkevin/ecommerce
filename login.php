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


if (isset($_POST['envoyer'])) {
	
$user=$manager->SelectUser($_POST['login'],$_POST['mdp']);

if ($user) {
	$_SESSION['USER']=serialize($user);

	header('location:menu.php');
}
else
{
	echo 'mot de passe incorrect';
}

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
	}


	if (isset($_GET['deconnection'])) {
		session_destroy();
	}
	?>
		
	<li><a href="register.php">enregistrez vous</a></li>

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
	<legend>veuillez vous connecter</legend>
	<form method="post">
		
	<p>login :<input type="text" name="login"></p>
	<p>mot de passe :<input type="password" name="mdp"></p>
	</br>
	<input type="submit" name="envoyer" value="envoyer">



	</form>

<a href="register.php">pas de compte ?venez vous en créer un !</a>
</fieldset>




	</div>


	
	</header>

	<footer>
	


	</footer>



</body>










