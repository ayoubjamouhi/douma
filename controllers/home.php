<?php

	require_once'core/Session.php';



	if($_SESSION['user'] != FALSE)

	{ 

		$clientObj =  require_once 'core/bootstrapClients.php';

  		$imageObj =  require_once 'core/bootstrapImages.php';

		include('views/partials/header.php'); 

		require 'views/home.view.php';

		include('views/partials/footer.php');

  	}

  	else

		Header("Location: /");
	