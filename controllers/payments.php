<?php

$ex = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

if(!isset($ex[1]) && !is_int((int)$ex[1]))
   echo "<script type='text/javascript'>
          function Redirect() 
          {  
          window.location='/Error404'; 
          } 
          setTimeout('Redirect()', 0);  
        </script>";

require_once 'core/Session.php';

if($_SESSION['user'] != false)

{

$clientsObj = require_once 'core/bootstrapClients.php';

$client = $clientsObj->get_client_by_id((int)$ex[1]);

Db::db_close();


if($client == NULL)
   echo "<script type='text/javascript'>
          function Redirect() 
          {  
          window.location='/Error404'; 
          } 
          setTimeout('Redirect()', 0);  
        </script>";

include('views/partials/header.php');
require 'views/payments.view.php';
include('views/partials/footer.php');

}

else

   echo "<script type='text/javascript'>
          function Redirect() 
          {  
          window.location='/'; 
          } 
          setTimeout('Redirect()', 0);  
        </script>";