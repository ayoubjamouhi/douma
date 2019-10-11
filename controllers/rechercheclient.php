<?php

require_once'core/Session.php';

if($_SESSION['user'] != FALSE)

{

	if($_POST['recherche'] == NULL)
  	    echo "<script type='text/javascript'>
        function Redirect() 
        {  
        window.location='/home'; 
        } 
        setTimeout('Redirect()', 0);  
      	</script>";

	$nom = $_POST['nom'];

	$prenom = $_POST['prenom'];

	$mois = (int)$_POST['mois'];
	
	$annee = (int)$_POST['annee'];

	
	include("views/partials/header.php"); 

	/*if(empty($nom) && empty($prenom) && $mois=0 && $annee = 2017)
	{
		die("<main><div class='echec'>Error des données</div></main>
				<script type='text/javascript'>
		        function Redirect() 
		        {  
		        window.location='/Error404'; 
		        } 
		        setTimeout('Redirect()', 0);  
		      	</script>
		   ");
	}*/
	  
	$imageObj = require_once 'core/bootstrapImages.php';
	$clientObj = require_once 'core/bootstrapClients.php';
	Db::db_close();

	if($_POST['hidden'] == '2')
	$clients = $clientObj->search_client(1,$nom,$prenom,$mois,$annee);
	elseif($_POST['hidden'] == '1')
	$clients = $clientObj->search_client(0,$nom,$prenom,$mois,$annee);
	
	//	var_dump($clients);
	
	require 'views/rechercheclient.views.php';	
	include("views/partials/footer.php");

}

else

  header("Location : /Error404");