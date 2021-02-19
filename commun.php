<?php
$host="localhost"; 
$username="LCourse"; 
$password="passlc"; 
$db_name="listeCourses"; 
$connexion=mysql_connect($host, $username, $password)or die("Cannot Connect to Mysql Server"); 
mysql_select_db($db_name)or die("cannot select Database");

?>
