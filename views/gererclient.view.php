<main id="main">
<?php $ex = explode('/', trim($_SERVER['REQUEST_URI'],'/')); ?>    
<?php if(isset($ex[1]) && is_int((int)$ex[1])):?>

<div class="imageclient">
<?php if($client->img_id != 0): 
$name = $imageObj->selectNameImageById($client->img_id);?>
<a target="_blank" href="/public/imagesClients/<?=$name->img_nom; ?>"><img width="200px" height="200px" src="/public/imagesClients/<?=$name->img_nom; ?>" ></a>
<?php endif; ?>
</div>
<?php if($client->is_archive == 1): ?>
<h3 style="text-align: center;">Ce client est archivé</h3>     
<?php endif; ?>  
<table class="table">

<thead>
<tr style="background-color: #c2d3d2">
<th>Nom</th>
<th>Prenom</th>
<th>La date d'inscription</th>
<th>La date de payment fixe</th>
<th>La date de payment</th>
<th>La date aprés 30 jours</th>
<th>Assuré?</th>
<th>La date d'assurance</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php $timea = $clientObj->typeOfTime($client);?>

<?php if($timea == 1 ):?>

<!-- Start tr with color green-->
<tr style="background-color: #488e49;color:#fff;">
<td><?= $client->nom_user; ?></td>
<td><?= $client->prenom_user; ?></td>
<td><?= $clientObj->dateConvert($client->date_inscription_user); ?></td>
<td><?= 'Le ' . $clientObj->dateConvertSansAnneeEtMois($client->date_payment_obliger); ?></td>
<td><?= $clientObj->dateConvert($client->date_payment_mois); ?></td>
<td><?= $clientObj->dateConvert($client->date_plus_trente); ?></td>
<td>
<?php 
if($client->assurer == 1)

    echo "Assuré";
else

    echo "Non Assuré";
?>
</td>
<td><?= $clientObj->dateConvert($client->date_assurance); ?></td>
<td>
    <form name="form" >
        <select size="1"  onChange="location = this.options[this.selectedIndex].value;">
        <option value="0" >-- Choisis --</option>
        <option value="<?= "/payments"."/".$client->id_user; ?>" >Payé</option>
        <option value="<?= "/archiveclient"."/".$client->id_user; ?>" >Archivé</option>
        </select>
    </form>
</td>
</tr>
<!-- End tr with color green-->

<!-- Start tr with color red-->
<?php elseif($timea == 2 ) : ?>
<tr style="background-color: #a54247;color:#fff;">
<td><?= $client->nom_user; ?></td>
<td><?= $client->prenom_user; ?></td>
<td><?= $clientObj->dateConvert($client->date_inscription_user); ?></td>
<td><?= 'Le ' . $clientObj->dateConvertSansAnneeEtMois($client->date_payment_obliger); ?></td>
<td><?= $clientObj->dateConvert($client->date_payment_mois); ?></td>
<td><?= $clientObj->dateConvert($client->date_plus_trente); ?></td>
<td>
<?php 
if($client->assurer == 1)

    echo "Assuré";
else

    echo "Non Assuré";
?>
</td>
<td>
<?php 
    if($client->date_assurance == 0)
        echo "Pas d'assurance"; 
    else
        echo $clientObj->dateConvert($client->date_assurance);
?>
        
</td>
<td>
    <form name="form" >
        <select size="1"  onChange="location = this.options[this.selectedIndex].value;">
        <option value="0" >-- Choisis --</option>
        <option value="<?= "/payments"."/".$client->id_user; ?>" >Payé</option>
        <option value="<?= "/archiveclient"."/".$client->id_user; ?>" >Archivé</option>
        </select>
    </form>
</td>
</tr>

<!-- Start tr with color normal-->
<?php else:?>
<tr style="background-color: #e3e4e8">
<td><?= $client->nom_user; ?></td>
<td><?= $client->prenom_user; ?></td>
<td><?= $clientObj->dateConvert($client->date_inscription_user); ?></td>
<td><?= 'Le ' . $clientObj->dateConvertSansAnneeEtMois($client->date_payment_obliger); ?></td>
<td><?= $clientObj->dateConvert($client->date_payment_mois); ?></td>
<td><?= $clientObj->dateConvert($client->date_plus_trente); ?></td>
<td>
<?php 
if($client->assurer == 1)

    echo "Assuré";
else

    echo "Non Assuré";
?>
</td>
<td><?= $clientObj->dateConvert($client->date_assurance); ?></td>
<td>
    <form name="form" >
        <select size="1"  onChange="location = this.options[this.selectedIndex].value;">
        <option value="0" >-- Choisis --</option>
        <option value="<?= "/payments"."/".$client->id_user; ?>" >Payé</option>
        <option value="<?= "/archiveclient"."/".$client->id_user; ?>" >Archivé</option>
        </select>
    </form>
</td>
</tr>
<?php  endif;?> 


</tbody> 

</table>

<form action="/checkmodifierclient/<?=(int)$ex[1];?>" method="POST" class="form-ajouter-client" enctype="multipart/form-data">

    <div>
        <span>Nom a modifier: </span>
        <input value="<?=$client->nom_user?>" type="text" name="nom"  required>         
    </div>
     <br>  

    <div>
        <span>Prenom a modifier: </span>
        <input value="<?=$client->prenom_user?>" type="text" name="prenom" required >          
    </div>
    <br>

    <div>
        <span for="img">Modfier l'image</span><br>
        <input type="file" name="fic" size=50/>        
    </div>
    <br>

    <div>
        <span for="assurer">Modifier si le client est assuré</span><br>
        <select name="assurer" id="assurer1" onchange="MyFunction1()">
            <?php if($client->assurer == 0 ) :?>
                <option value="0">-- Choisis --</option>
                <option value="1" >Assuré</option>
                <option value="2" selected="">Non Assuré</option>
            <?php else: ?>
                <option value="0">-- Choisis --</option>
                <option value="1"  selected="">Assuré</option>
                <option value="2">Non Assuré</option>
            <?php endif; ?>
        </select>       
    </div>
    <br>

    
    <?php if($client->assurer == 1): ?>
    <div id="date_assurance_hidden1" style="display: block;">
        <span style="color: red">Modifier La date d'assurance</span><br>
        <input type="date" name="dateassurance" value=
                "<?php echo $dateassurance;?>"
                >          
    </div>
    <?php else: ?>
    <div id="date_assurance_hidden1" style="display: none;">
        <span style="color: red">Modifier La date d'assurance</span><br>
        <input type="date" name="dateassurance" value=
                "<?php echo $dateassurance;?>"
                >          
    </div>
    <?php endif; ?>
    <br>

    <div>
        <span>Modifier La date de payment fixe</span><br>
        <input type="date" name="datepaymentfixe" value=
                "<?php echo $datepaymentfixe;?>"
                >          
    </div> 

    <div>
        <span for="dateinscription">Modifier La date d'inscription</span><br>
        <input type="date" name="dateinscription" value=
                "<?php echo $dateinscvalue;?>"
                >          
    </div>        
    <br><br>

    <div class="form-group">
        <input type="submit" name="submit" value="Modifier ce client" class="btn btn-primary">           
    </div>
</form>

    <?php else: ?>
    <!-- Start Form ajouter client -->
    <h1>Ajoutez nouveau client</h1>
    <form enctype="multipart/form-data" action="checkajouterClient" method="post" class="form-ajouter-client">
    	
        <div>
    		<span style="color: red">Nom*</span><br>
    		<input type="text" name="nom" placeholder="Entrer le nom" required >			
    	</div>
        <br>

    	<div>
    		<span style="color: red">Prenom*</span><br>
    		<input type="text" name="prenom" placeholder="Entrer le prenom" required >			
    	</div>
        <br>

        <div>
            <span style="color: red">Date de payments fixe*</span><br>
            <input type="date" name="datepaymentsfixe" required>          
        </div>
        <br>

        <div>
            <span style="color: red">Le client est assuré?*</span><br>
            <select name="assurer" required="" id="assurer" onchange="myFunction()">

                <option value="0">-- Choisis --</option>
                <option value="1" class="assurer">Assuré</option>
                <option value="2">Non Assuré</option>
            </select>       
        </div>
        <br>

        <div id="date_assurance_hidden" style="display: none;">
            <span style="color: red">La date d'assurance*</span>
            <input type="date" name="dateassurance">
        </div>
        <br>

        <div>
            <span>La date de payment</span><br>
            <input type="date" name="datepaymentmois">          
        </div>        
        <br>

        <div>
            <span>Image de ce client</span><br>
            <input type="file" name="fic" size=50/>        
        </div>
        <br>

        <div>
            <span>La date d'inscription</span><br>
            <input type="date" name="dateinscription">          
        </div>        
        <br><br>

    	<div>
    		<input type="submit" name="submit" value="Ajoutez ce client">			
    	</div>	
    </form>
    <!-- End Form ajouter client -->

    <?php endif;?>
</main>
