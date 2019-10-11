<?php 
		$clientObj = require 'core/bootstrapClients.php';

		$client = $clientObj->get_clients();
$array = [

		'gererclient/id' 		=> 'controllers/gererclientid.php',
		'logout' 				=> 'controllers/logout.php',
		'checkajouterClient' 	=> 'controllers/checkajouterClient.php',
		'geerclient/id' 		=> 'controllers/gererclientid.php'

		];

$ar = array_keys($array);
$routes = [];
foreach($ar as $arr)
{
	$pos = strpos($arr, '/id');

	if($pos)
	{
		$a =explode('/', $arr);

		foreach ($client as $c)
		
		{

			$routes[$a[0]."/". $c->id_user] = $array[$arr] . "?id=" . $c->id_user;
		}
	}
	else

	{

		$routes[$arr] = $array[$arr];
	}

}

var_dump($routes);

