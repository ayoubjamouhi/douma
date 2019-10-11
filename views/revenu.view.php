<main id="main">
<h1>Revenu</h1>
<table class="table">
	<thead>
      <tr style="background-color: #fff">
        <th>La date</th>
        <th>Revenu</th>
      </tr>
    </thead>
    <tbody>
     <?php
     	$arrays = $clientsObj->get_revenu();
     	$keys = array_keys($arrays);
        foreach ($arrays as $key => $array ) :

        ?>
    	<tr style="background-color: #e3e4e8">
    		<td><?=$key?></td>
    		<td><?=$array*100?> DH</td>
    	</tr>
    <?php endforeach;?>
    </tbody>
</table>    

</main>
