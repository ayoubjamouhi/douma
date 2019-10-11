<?php

require_once 'core/Session.php';

if(isset($_SESSION['user']) != false)

{
	
	$_SESSION['user'] = false;

	include("views/partials/header.php");

	require 'views/logout.view.php';

	include("views/partials/footer.php");	
}
?>
<script type='text/javascript'>   
    setTimeout(window.location='/', 3000);   
 </script>
