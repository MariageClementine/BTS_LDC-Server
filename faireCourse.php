<?php
include ("commun.php");
//echo $_SESSION['idLog']; //debug
$reqNoListe = "SELECT listeId from liste natural join famille natural join membre where membreId=".$_SESSION['idLog']." AND enCours=1";
//echo $reqNoListe; //debug
$occurNoListe=mysql_query($reqNoListe);
$resultNoListe = mysql_fetch_array($occurNoListe);
$monNoListe = $resultNoListe['listeId'];
//requete sql
if(isset($_GET['action']))
{
	$action = $_GET['action'];
	switch ($action)
	{
		case "caddy" :
			$tabNoProd=$_GET['tabNoProd'];
			foreach($tabNoProd as $noProd)
			{
				$sqlCaddy="UPDATE contenuListe set dansCaddy = 1 , listeId =".$monNoListe." where listeId=".$monNoListe." and produitId=$noProd";
				mysql_query($sqlCaddy);
			}
		break;
		case "annuler" : 

			$tabNoProd=$_GET['tabNoProd'];
			foreach($tabNoProd as $noProd)
			{
				$sqlAnnuler="DELETE from contenuListe where listeId=".$monNoListe." and produitId=$noProd";
				mysql_query($sqlAnnuler);
			}
		break;
	}
}
//la requete
$sql = "SELECT produit.produitId AS produitId, produitLib, listeQte, rayon.rayonId AS rayonId, rayonLib
	 FROM rayon natural join produit natural join contenuListe natural join liste
	 WHERE listeId=".$monNoListe." AND dansCaddy=0"; 


//execution
$result = mysql_query($sql);

//le tableau
$monTableau = array();
if(mysql_num_rows($result))//s'il y a un resultat
{
	while($ligne=mysql_fetch_assoc($result))
	{
		$monTableau['coursesAFaire'][]=$ligne;
	}
}
echo json_encode($monTableau); 
?> 
