<?php 
$ex = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

if(isset($ex[1]) && is_int((int)$ex[1])):

if(!isset($_POST['oui']) && !isset($_POST['no']))
   	echo 	"<script type='text/javascript'>
      		function Redirect() 
      		{  
      		window.location='/archiveclient'; 
      		} 
      		setTimeout('Redirect()', 0);  
    		</script>";

if(isset($_POST['oui']) && !empty($_POST['argument'])):
$clientObj = require 'core/bootstrapClients.php';
$client = $clientObj->archive_client((int)$ex[1],$_POST['argument']);

if($client):

include 'views/partials/header.php';
?>
<main>
<div class="success">Vous avez Archivez ce client</div>
<script type='text/javascript'>
	function Redirect() 
	{  
	window.location='/archiveclient'; 
	} 
	setTimeout('Redirect()', 2000);  
</script>
<?php else:?>

<div class="alert alert-danger">Vous n'avez pas Archivez ce client</div>
<script type='text/javascript'>
	function Redirect() 
	{  
	window.location='/home'; 
	} 
	setTimeout('Redirect()', 2000);  
</script>

<?php endif;?>
<?php elseif(isset($_POST['no'])) : ?>
<div class="alert alert-danger">Merci!</div>
<script type='text/javascript'>
	function Redirect() 
	{  
	window.location='/home'; 
	} 
	setTimeout('Redirect()', 2000);  
</script>
</main>
<?php include 'views/partials/footer.php'; ?>
<?php endif;?> 	    
<?php endif;?> 	    

