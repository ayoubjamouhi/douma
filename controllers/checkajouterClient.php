<?php
require_once 'core/Session.php';
if($_SESSION['user'] != FALSE)

{

if(!isset($_POST['submit']))
  	die("Error");

$nom = $_POST['nom'];

$prenom = $_POST['prenom'];

$date = $_POST['dateinscription'];

$datepaymentmois = $_POST['datepaymentmois'];

$datepaymentfixe = $_POST['datepaymentsfixe'];

$dateassurance = $_POST['dateassurance'];

$assurer = $_POST['assurer'];

$image = $_FILES['fic'];
  
if(empty($nom) || empty($prenom))
  die("Error");

  
$imageObj = require_once 'core/bootstrapImages.php';
$clientsObj = require_once 'core/bootstrapClients.php';

$insertImage = $imageObj->insererImage($image);

if($insertImage)

{


  
  if(empty($datepaymentmois))
    $dateplustrente = $clientsObj->genererDateApres30($datepaymentfixe,date('Y-m-d'));

  else
    $dateplustrente = $clientsObj->genererDateApres30($datepaymentfixe,$datepaymentmois);

  $insertClient = $clientsObj->insert_clients($nom,$prenom,$date,$datepaymentfixe,$datepaymentmois,$dateplustrente,$imageObj->lastIdInserer(),$assurer,$dateassurance);
}
else

{

  if(empty($datepaymentmois))
    $dateplustrente = $clientsObj->genererDateApres30($datepaymentfixe,date('Y-m-d'));

  else
    $dateplustrente = $clientsObj->genererDateApres30($datepaymentfixe,$datepaymentmois);
  

  $insertClient = $clientsObj->insert_clients($nom,$prenom,$date,$datepaymentfixe,$datepaymentmois,$dateplustrente,0,$assurer,$dateassurance);
}

Db::db_close();

include("views/partials/header.php");

require 'views/checkajouterClient.views.php';	

include("views/partials/footer.php");

}

else

   echo "<script type='text/javascript'>
            function Redirect() 
            {  
            window.location='/'; 
            } 
            setTimeout('Redirect()', 0);  
          </script>";