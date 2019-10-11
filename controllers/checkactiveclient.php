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

if(isset($_POST['oui'])):
$clientObj = require 'core/bootstrapClients.php';
$client = $clientObj->archive_to_active_client((int)$ex[1]);

if($client):
include 'views/partials/header.php';
?>
<div class="success">Vous avez Activez ce client</div>
<?php header('refresh:2; /archiveclient');?>
<script type='text/javascript'>
	function Redirect() 
	{  
	window.location='/home'; 
	} 
	setTimeout('Redirect()', 2000);  
</script>
<?php else:?>

<div class="alert alert-danger">Vous n'avez pas Activez ce client</div>
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
<?php include 'views/partials/footer.php'; endif;?> 	    
<?php endif;?> 	    

