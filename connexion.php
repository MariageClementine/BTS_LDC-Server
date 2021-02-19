<?php
session_start();
include("commun.php");
if(isset($_GET['action']))
{
	$action= $_GET['action'];
	switch ($action)
	{
		case 'connexion':
			$req = "SELECT membreId FROM membre WHERE login='".$_GET['login']."' AND mdp='".$_GET['mdp']."';";
			$occur = mysql_query($req);
			if($ligne= mysql_fetch_array($occur))
			{
				$_SESSION['idLog']=$ligne['membreId'];
				echo 'Connexion reussie';
			}
			else
			{
				echo "Connexion erronee";
			}
		break;
		case 'deconnexion':
			$_SESSION = array();
			session_destroy();
			echo "Deconnecte";
		break;
	}
}

?>