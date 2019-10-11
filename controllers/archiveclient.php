<?php

require_once'core/Session.php';

if($_SESSION['user'] != FALSE)

{
	$clientObj = require 'core/bootstrapClients.php';
	$imageObj = require 'core/bootstrapImages.php';

	$ex = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

	if(isset($ex[1]) && is_int((int)$ex[1]))

	{

		
		if((int)$ex[1] <= 0)
		   die ("<script type='text/javascript'>
		          function Redirect() 
		          {  
		          window.location='/Error404'; 
		          } 
		          setTimeout('Redirect()', 0);  
		        </script>");


		$client = $clientObj->get_client_by_id((int)$ex[1]);

		if($client == NULL)
		   die ("<script type='text/javascript'>
		          function Redirect() 
		          {  
		          window.location='/Error404'; 
		          } 
		          setTimeout('Redirect()', 0);  
		        </script>");


	}

		include("views/partials/header.php");

		require 'views/archiveclient.view.php';

		include("views/partials/footer.php");
}

else

   die ("<script type='text/javascript'>
          function Redirect() 
          {  
          window.location='/home'; 
          } 
          setTimeout('Redirect()', 0);  
        </script>");
