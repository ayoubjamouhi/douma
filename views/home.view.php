<main>

<div class="recherche">
  <a href="#" id='minus' alt='close' class="moin">
    <i  id='icon' class="fa fa-minus-circle" aria-hidden="true"></i>
  </a>
  <h1>Recherche</h1>
  <form action="/rechercheclient" method="POST" class="formrecherche" id="formrecherche">
    
    <input type="hidden" name="hidden" value="1">

    <div>
      <span>Entrer le nom</span>
      <input  id="nom_recherche"  type="text"  name="nom" 
              placeholder="Nom ici" value="<?php 
                if(isset($_POST['nom'])) 
                  echo $_POST['nom']; 
                
                ?>"
       />
    </div>

    <div>
      <span>Entrer le prenom</span>
      <input  type="text"  name="prenom"  placeholder="Prenom ici" value="<?php 
                if(isset($_POST['prenom']) ) 
                  echo $_POST['prenom']; 
                
                ?>"
      />
    </div>

    <div>
      <span>Entrer le mois et l'année</span>
      <select name="mois">
            <option value="0">-- Select --</option>
            <option value="1">Janvier</option>
            <option value="2">Février</option>
            <option value="3">Mars</option>
            <option value="4">Avril</option>
            <option value="5">Mai</option>
            <option value="6">Juin</option>
            <option value="7">Juillet</option>
            <option value="8">Aout</option>
            <option value="9">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Decembre</option>
      </select>
      <select name="annee">
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
      </select>   
    </div>
    <div>
        <input type="submit" name="recherche" class="btn btn-primary" id="btnrecherche" value="Recherche">     
    </div>
  </form>
</div>

<h1>Tous les clients</h1>

<div style="overflow-x: auto;">
<table class="table">
    
<thead>
  <tr style="background-color: #fff">
    <th>Image</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>La date de payment fixe</th>
    <th>La date de payment</th>
    <th>La_date_aprés 30 jours</th>
    <th>Assuré?</th>
    <th>Action</th>
  </tr>
</thead>

<tbody>

  <?php $clients = $clientObj->get_clients("WHERE `is_archive` = 0 ORDER BY `date_plus_trente` ASC");?>

  <!-- Start Foreach -->
  <?php foreach ($clients as $client) : ?>
  <?php
    $timea = $clientObj->typeOfTime($client);
    $name = $imageObj->selectNameImageById($client->img_id);
  ?>

  <!-- Start if -->
  <?php if($timea == 1 ):?>
  <tr style="background-color: #488e49;color:#fff;">
      <td>
      <?php 


      if($client->img_id != 0)

      {
      echo "<a target='_blank' href='/public/imagesClients/{$name->img_nom}'><img width='75px' height='75px' src='/public/imagesClients/{$name->img_nom}'></a>";
      }
      else
      echo "<img width='75px' height='75px' src='/public/img/portrait-anonyme.jpg'>";

      ?>  
      </td>
      <td><?= $client->nom_user; ?></td>
      <td><?= $client->prenom_user; ?></td>
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
        <form name="form" >
        <select size="1"  onChange="location = this.options[this.selectedIndex].value;">
          <option value="0" >Action</option>
          <option value="<?= "/gererclient"."/".$client->id_user; ?>" >Géré</option>
          <option value="<?= "/payments"."/".$client->id_user; ?>" >Payé</option>
          <option value="<?= "/archiveclient"."/".$client->id_user; ?>" >Archivé</option>
        </select>
        </form>
      </td>
  </tr>
  <?php elseif($timea == 2 ) : ?>
  <tr style="background-color: #a54247;color:#fff;">
      <td>
      <?php 


      if($client->img_id != 0)

      {
      echo "<a target='_blank' href='/public/imagesClients/{$name->img_nom}'><img width='75px' height='75px' src='/public/imagesClients/{$name->img_nom}'></a>";
      }
      else
      echo "<img width='75px' height='75px' src='/public/img/portrait-anonyme.jpg'>";

      ?>  
      </td>
      <td><?= $client->nom_user; ?></td>
      <td><?= $client->prenom_user; ?></td>
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
        <form name="form" >
        <select size="1"  onChange="location = this.options[this.selectedIndex].value;">
          <option value="0" >Choisis</option>
          <option value="<?= "/gererclient"."/".$client->id_user; ?>" >Géré</option>
          <option value="<?= "/payments"."/".$client->id_user; ?>" >Payé</option>
          <option value="<?= "/archiveclient"."/".$client->id_user; ?>" >Archivé</option>
        </select>
        </form>
      </td>
  </tr>
  <?php else:?>
  <tr style="background-color: #e3e4e8">
      <td>
      <?php 


      if($client->img_id != 0)

      {
      echo "<a target='_blank' href='/public/imagesClients/{$name->img_nom}'><img width='75px' height='75px' src='/public/imagesClients/{$name->img_nom}'></a>";
      }
      else
      echo "<img width='75px' height='75px' src='/public/img/portrait-anonyme.jpg'>";

      ?>  
      </td>
      <td><?= $client->nom_user; ?></td>
      <td><?= $client->prenom_user; ?></td>
      <td><?= 'Le ' . $clientObj->dateConvertSansAnneeEtMois($client->date_payment_obliger); ?></td>
      <td><?= $clientObj->dateConvert($client->date_payment_mois); ?></td>
      <td><?= $clientObj->dateConvert($client->date_plus_trente); ?></td>
      <td>
      <?php 
      if($client->assurer == 1)

          echo "<span style='color:#295918'>Assuré</span>";
      else

          echo "<span style='color:#AE3242'>Non Assuré</span>";
      ?>
      </td>
      <td>
        <form name="form" >
        <select size="1"  onChange="location = this.options[this.selectedIndex].value;">
          <option value="0" >Action</option>
          <option value="<?= "/gererclient"."/".$client->id_user; ?>" >Géré</option>
          <option value="<?= "/payments"."/".$client->id_user; ?>" >Payé</option>
          <option value="<?= "/archiveclient"."/".$client->id_user; ?>" >Archivé</option>
        </select>
        </form>
      </td>
  </tr>
<?php  endif;?> 
<!-- End if -->

<?php endforeach;?> 
<!-- End Foreach -->
</tbody>   

</table>
</div>
</main>
