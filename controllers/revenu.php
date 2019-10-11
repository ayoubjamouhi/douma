<?php
	
	require_once'Core/Session.php';
    $clientsObj = require 'core/bootstrapClients.php';

	if($_SESSION['user'] != FALSE)

	{

		include("views/partials/header.php");

		require 'views/revenu.view.php';

		include("views/partials/footer.php");
	}

	else

		Header("Location: /home");
