<?php
include ("commun.php");
$occurNoListe=mysql_query("SELECT listeId from liste natural join famille natural join membre where membreId=".$_SESSION['idLog']." AND enCours=1");
$resultNoListe = mysql_fetch_array($occurNoListe);
$monNoListe = $resultNoListe['listeId'];

//appelé par remplirListe
if(isset($_GET['action']))
{
	$action=$_GET['action'];
	$noProduit=$_GET['produitId'];
	$qte=$_GET['qte'];

	if($action=="ajout")
	{
		$sql = "insert into contenuListe(listeId,produitId,listeQte,dansCaddy) values($monNoListe,$noProduit,$qte,0)"; 
		$result = mysql_query($sql);
	}
}
//on recupere la lise en cours, en construction
$json = array();
$sql2="SELECT listeLib, produit.produitId AS produitId, produitLib, listeQte
	 FROM produit natural join contenuListe natural join liste
	 WHERE listeId=".$monNoListe." AND dansCaddy=0 ";


if($result2=mysql_query($sql2))
{
	while($row=mysql_fetch_assoc($result2))
	{
		$json['listeDeCourse'][]=$row;
	}
}
else
{
	$sql3 = "SELECT listeLib FROM liste Where listeId=".$monNoListe;
	$result3 = mysql_query($sql3);
	$row = mysql_fetch_assoc($result3);
	$json['listeDeCourse'][]=$row;
}
echo json_encode($json);
?> 
