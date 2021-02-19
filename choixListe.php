<?php
include ("commun.php");
$reqNoFamille = mysql_query("SELECT familleId from famille natural join membre where membreId=".$_SESSION['idLog']);
$occurNoFamille = mysql_fetch_array($reqNoFamille);
$noFamille = $occurNoFamille['familleId'];

//appelé par remplirListe
if(isset($_GET['action']))
{
	$action=$_GET['action'];

	switch($action)
	{
		case 'choix':
			$noListe = $_GET['noListe'];
			$req = "UPDATE liste set enCours=0 WHERE familleId=$noFamille";
			mysql_query($req);
			$req2 = "UPDATE liste set enCours=1 WHERE listeId=$noListe";
			mysql_query($req2);
		break;
		case 'ajout':
			$nomListe=$_GET['nomListe'];
			//req

			$occur = mysql_query("SELECT max(listeId)+1 as liste from liste");
			$row = mysql_fetch_array($occur);
			
			$req = "UPDATE liste set enCours=0 where familleId=$noFamille";
			$req2 = "INSERT INTO liste values (".$row['liste'].",'".$nomListe."',".$noFamille.",1)";
			mysql_query($req);
			mysql_query($req2);
			//ajouter magasin
		break;
	}
}

$json = array();
$req = "SELECT listeId,listeLib FROM liste WHERE familleId=$noFamille";
$occur = mysql_query($req);
while($row = mysql_fetch_assoc($occur))
{
	$json['liste'][]=$row;
}
echo json_encode($json);
?>