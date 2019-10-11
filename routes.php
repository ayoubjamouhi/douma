<?php

$router->get(
	[
		'' 							=> 'controllers/index.php',
		'home' 						=> 'controllers/home.php',
		'checklogin' 				=> 'controllers/checklogin.php',
		'gererclient' 				=> 'controllers/gererclient.php',
		'logout' 					=> 'controllers/logout.php',
		'checkajouterClient' 		=> 'controllers/checkajouterClient.php',
		'rechercheclient' 			=> 'controllers/rechercheclient.php',
		'error404' 					=> 'controllers/error404.php',
		'revenu' 					=> 'controllers/revenu.php',
		'test' 						=> 'controllers/test.php',
		'archiveclient' 			=> 'controllers/archiveclient.php',
		'gererclient/id' 			=> 'controllers/gererclient.php',
		'payments/id' 				=> 'controllers/payments.php',
		'checkPayments/id' 			=> 'controllers/checkPayments.php',
		'checkmodifierclient/id'   	=> 'controllers/checkmodifierclient.php',
		'archiveclient/id' 			=> 'controllers/archiveclient.php',
		'checkarchiveclient/id' 	=> 'controllers/checkarchiveclient.php',
		'activeclient/id' 			=> 'controllers/activeclient.php',
		'checkactiveclient/id' 		=> 'controllers/checkactiveclient.php'
	]
);


