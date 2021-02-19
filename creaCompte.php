<?php
include ("commun.php");
if(isset($_GET['action']))
{
	$action= $_GET['action'];
	switch ($action)
	{
		case 'creaFamille':
			$nomFamille = strtoupper($_GET['nomFam']);
			//echo $nomFamille."<br>";
			preg_match("#^[a-zA-Z]{3}#", $nomFamille,$match);
			//echo strtolower($match[0]);
			$code = strtolower($match[0]);
			$codeSuite = "";
			$ok = false;
			//on tente un premier code
			while($ok == false)
			{
				//on crée les chiffres
				for($i=0;$i<3;$i++)
				{        
					$codeSuite = $codeSuite.(string)rand(0,9);
				}
				//on les ajoute au code
				$code=$code.$codeSuite;
				//on vérifie si ce code existe deja
				$req = mysql_query("select familleId from famille where familleCode='".$code."'");
				//si c'est bon, on a le code, on sort de la boucle
				if(!mysql_fetch_array($req))
				{
					$ok = true;
				}
			}
			$reqMax = mysql_query("select max(familleId)+1 as familleId from famille");
			$ligne = mysql_fetch_array($reqMax);

			if(mysql_query("insert into famille values(".$ligne['familleId'].",'".$nomFamille."','".$code."')"))
			{
				echo "ajout de la famille reussi. code: ".$code;
			}
			else
			{
				echo "erreur lors de l'ajout de la famille";
			}
		break;

		case 'creaCompte':
		$code = $_GET['code'];
		$req = mysql_query("select familleId from famille where familleCode='".$code."'");
		if($ligne = mysql_fetch_array($req))
		{
			$nom = strtoupper($_GET['nom']);
			$prenom = $_GET['prenom'];
			$login = $_GET['login'];
			$mdp = $_GET['mdp'];
			$reqMax = mysql_query("select max(membreId)+1 as membreId from membre");
			$ligneMax = mysql_fetch_array($reqMax);
			//echo "insert into membre values (".$ligneMax['membreId'].",'".$nom."','".$prenom."','".$login."','".$mdp."',".$ligne['familleId'].")";
			if(mysql_query("insert into membre values (".$ligneMax['membreId'].",'".$nom."','".$prenom."','".$login."','".$mdp."',".$ligne['familleId'].")"))
			{
				echo "ajout effectue avec succes";
			}
			else
			{
				echo "erreur lors de l'ajout, reessayez ulterieurement.";
			}
		}
		else
		{
			echo "erreur verifiez le code famille";
		}
			
		break;

		case 'modifCompte':
		$login = $_GET['login'];
		$oldMdp = $_GET['oldMdp'];
		$mdp = $_GET['newMdp'];

		$reqVerif = mysql_query("select membreId from membre where login='".$login."' and mdp='".$oldMdp."'");
		if($ligne = mysql_fetch_array($reqVerif))
		{
			$reqUpdate = "update membre set mdp='".$mdp."' where membreId = ".$ligne['membreId'];
			//echo $reqUpdate;
			if(mysql_query($reqUpdate))
			{
				echo "modification effectuée";
			}
			else
			{
				echo "erreur lors de la modification. reessayez plus tard.";
			}
		}
		else
		{
			echo "erreur, votre login ou votre ancien mot de passe est incorrect";
		}
		break;

		case 'supprCompte':

		$login = $_GET['login'];
		$mdp = $_GET['mdp'];

		$reqVerif = mysql_query("select membreId from membre where login='".$login."' and mdp='".$mdp."'");
		if($ligne = mysql_fetch_array($reqVerif))
		{
			$reqSuppr = "delete from membre where membreId=".$ligne['membreId'];
			if(mysql_query($reqSuppr))
			{
				echo "suppression effectuee";
			}
			else
			{
				echo "erreur lors de la suppression. reessayez plus tard.";
			}
		}
		else
		{
			echo "suppression non effectuee. verifiez vos identifiants";
		}
		break;
	}
}
else
{
	echo "connexion operationelle";
}
?>