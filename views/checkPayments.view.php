<main>
<div class="container">

<?php

if(empty($_POST['typedate']) || empty($_POST['avantdate']))

{

	echo("<div class='echec'>Erreur dans la modification</div>");
   	echo 	"<script type='text/javascript'>
      		function Redirect()
      		{
      		window.location='/gererclient/{$ex[1]}';
      		}
      		setTimeout('Redirect()', 1000);
    		</script>";
}

if(isset($_POST['oui'])):

    $update = $clientsObj->update_payment_client((int)$ex[1],$_POST['typedate'],$_POST['avantdate'],$client);
	if(!$update):
?>
		<div class="echec">
			Erreur dans la modification
			<script type='text/javascript'>
	          function Redirect()
	          {
	          window.location='/gererclient/<?=$ex[1]; ?>';
	          }
	          setTimeout('Redirect()', 2000);
	        </script>
		</div>

	<?php else: ?>
		<div class="success">
			Modification effectue avec succées
			<script type='text/javascript'>
	          function Redirect()
	          {
	          window.location='/gererclient/<?=$ex[1]; ?>';
	          }
	          setTimeout('Redirect()', 2000);
	        </script>

		</div>

<?php endif;?>
<?php else:?>
	<script type='text/javascript'>
      function Redirect()
      {
      window.location='/; ?>';
      }
      setTimeout('Redirect()', 1000);
    </script>
<?php endif;?>
</div>
</main>