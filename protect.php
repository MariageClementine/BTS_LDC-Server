<?php
session_start();
if(isset($_SESSION['idLog']))
{
	switch($_GET['page'])
	{
		case 'faireCourse':
			include("faireCourse.php");
		break;

		case 'listeCourse':
			include("listeCourse.php");
		break;

		case 'choixListe':
			include("choixListe.php");
		break;

		case 'listeProduits':
			include("listeProduits.php");
		break;

		case 'listeRayons':
			include("listeRayons.php");
		break;
	}
}
else
{
	//envoi d'une erreur exploitable
	echo 'Non connecté';
}