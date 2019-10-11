<main>
<div class="container">
  <?php if(!$insertClient): ?>
  	<div class="echec">
  		Error dans l'insertion
      <script type='text/javascript'>
        function Redirect() 
        {  
        window.location='/gererclient'; 
        } 
        setTimeout('Redirect()', 1000);  
      </script>
  	</div>
  <?php else : ?>
  	<div class="success">
  		Insertion avec succées
      <script type='text/javascript'>
        function Redirect() 
        {  
        window.location='/'; 
        } 
        setTimeout('Redirect()', 1000);  
      </script>

  	</div>
  <?php endif;?>
</div>
	</main>