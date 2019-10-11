<?php

	//var_dump($_SERVER['PATH_INFO']);
	require_once 'core/Session.php';

	$usersObj = require 'core/bootstrapUsers.php';

	if($_SESSION['user'] == false)
		
	{ 
		require 'views/index.view.php';

	}

	else

	 	Header('Location: /home');