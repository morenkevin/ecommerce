<!Doctype html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
	$servername = "localhost";
	$username="root";
	$password="";
	$dbname="veepee";

	//Connexion BDD
	$conn= new mysqli($servername,$username,$password,$dbname);

	if($conn->connect_error) {
		die ("Erreur".$conn->connect_error);
		echo "Erreur";
	}
	?>	
</body>
</html>