<main>
 
<h2 style="text-align: center;color: #FFF">Activez <?=$client->nom_user . ' ' . $client->prenom_user;  ?></h2>
<form action="/checkactiveclient/<?=(int)$ex[1]?>" method="post" class="archive_argument">
	<h3>Tu es sûr?</h3>
	<input type="submit" name="oui" value='Oui' class="oui"> 
	<input type="submit" name="no"  value="No" class="no"> 
</form>
</main>