<?php

$ex = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

if(isset($ex[1]) && is_int((int)$ex[1]))


{

	$clientObj = require 'core/bootstrapClients.php';

	$imageObj =  require_once 'core/bootstrapImages.php';

	$client = $clientObj->get_client_by_id((int)$ex[1]);

	$dateinscvalue = date('Y-m-d',strtotime($client->date_inscription_user));

	$datepaymentfixe = date('Y-m-d',strtotime($client->date_payment_obliger));

	$dateassurance = date('Y-m-d',strtotime($client->date_assurance));

	$name = $imageObj->selectNameImageById((int)$ex[1]);	

	if($client == NULL)

		Header('Location: /error404');

}

require_once'core/Session.php';

if($_SESSION['user'] != FALSE)

{

	include("views/partials/header.php");

	require 'views/gererclient.view.php';

	include("views/partials/footer.php");
}

else

	Header("Location: /home");
