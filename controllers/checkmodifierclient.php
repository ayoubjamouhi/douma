<?php

require_once 'core/Session.php';
if($_SESSION['user'] != FALSE)
{

if(!isset($_POST['submit']))
  Header('Location: /error404');

$ex = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

if(!isset($ex[1]) && !is_int((int)$ex[1]))
   echo "<script type='text/javascript'>
          function Redirect()
          {
          window.location='/home';
          }
          setTimeout('Redirect()', 0);
        </script>";

$nom = $_POST['nom'];

$prenom = $_POST['prenom'];

$dateinscription = $_POST['dateinscription'];

$datepaymentfixe = $_POST['datepaymentfixe'];

$dateassurance = $_POST['dateassurance'];

$assurer = $_POST['assurer'];

$image = $_FILES['fic'];


if(empty($nom) || empty($prenom))
  die("Error
    <script type='text/javascript'>
          function Redirect()
          {
          window.location='/gererclient/{$ex[1]}';
          }
          setTimeout('Redirect()', 1000);
        </script>
        ");

$clientsImage = require_once 'core/bootstrapImages.php';
$clientsObj = require_once 'core/bootstrapClients.php';

$datepaymentsmois = $clientsObj->get_client_by_id((int)$ex[1])->date_payment_mois;
$dateplustrente = $clientsObj->genererDateApres30($datepaymentfixe,date('Y-m-d',strtotime($datepaymentsmois)));

if($clientsObj->get_client_by_id((int)$ex[1]) == NULL)
  die("Error
    <script type='text/javascript'>
          function Redirect()
          {
          window.location='/gererclient/{$ex[1]}';
          }
          setTimeout('Redirect()', 1000);
        </script>
        ");

include("views/partials/header.php");

if(!empty($image["tmp_name"]))

{

  if( (int)$clientsObj->get_client_by_id((int)$ex[1])->img_id != 0 )

  {

    $updateImage = $clientsImage->updateImage($clientsObj->get_client_by_id((int)$ex[1])->img_id,$image);

    if($updateImage)
    {

      $updateClient =  $clientsObj->update_client((int)$ex[1],$nom,$prenom,$dateinscription,$datepaymentfixe,$dateplustrente,$assurer,$dateassurance,NULL,$datepaymentsmois);

      if($updateClient)
      {

        echo "<main><div class='success'>Mis à jour avec succès</div><br></main>";

        echo("<script type='text/javascript'>
              function Redirect()
              {
              window.location='/gererclient/{$ex[1]}';
              }
              setTimeout('Redirect()', 2000);
              </script>
              ");
      }
      else
      {
        echo "<main><div class='echec'>Echec Mis à jour</div><br></main>";

        echo("<script type='text/javascript'>
              function Redirect()
              {
              window.location='/gererclient/{$ex[1]}';
              }
              setTimeout('Redirect()', 2000);
              </script>
              ");
      }
    }
    else
    {
      var_dump('Error');
    }
  }

  else

  {

    $updateImage = $clientsImage->insererImage($image);

    if($updateImage)

    {

      $updateClient =  $clientsObj->update_client((int)$ex[1],$nom,$prenom,$dateinscription,$datepaymentfixe,$dateplustrente,$assurer,$dateassurance,$clientsImage->lastIdInserer(),$datepaymentsmois);

      if($updateClient)

      {

        echo "<main><div class='success'>Mis à jour avec succès</div><br></main>";

        echo("<script type='text/javascript'>
              function Redirect()
              {
              window.location='/gererclient/{$ex[1]}';
              }
              setTimeout('Redirect()', 2000);
              </script>
              ");
      }

      else

      {
        echo "<main><div class='echec'>Echec Mis à jour</div><br></main>";

        echo("<script type='text/javascript'>
              function Redirect()
              {
              window.location='/gererclient/{$ex[1]}';
              }
              setTimeout('Redirect()', 2000);
              </script>
              ");
      }
    }
  }

}

else

{

  $updateClient =  $clientsObj->update_client((int)$ex[1],$nom,$prenom,$dateinscription,$datepaymentfixe,$dateplustrente,$assurer,$dateassurance,NULL,$datepaymentsmois);

  if($updateClient)

  {
    echo "<main><div class='success'>Mis à jour avec succès</div><br></main>";

      echo("<script type='text/javascript'>
            function Redirect()
            {
            window.location='/gererclient/{$ex[1]}';
            }
            setTimeout('Redirect()', 2000);
            </script>
            ");
  }

  else

  {
    echo "<main><div class='echec'>Echec Mis à jour</div><br></main>";

    echo("<script type='text/javascript'>
          function Redirect()
          {
          window.location='/gererclient/{$ex[1]}';
          }
          setTimeout('Redirect()', 2000);
          </script>
          ");
  }
}


Db::db_close();



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
