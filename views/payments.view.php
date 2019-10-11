<main>
<div class="container">

	<div class="payments">

		<h1>Tu es sur ?</h1>
		<form action="/checkPayments/<?=(int)$ex[1];?>" method="POST">

			<div>
				<span>Type de date</span><br>
				<select name="typedate" required>
					<option value="0">-- Choisis --</option>
					<option value="2" selected>Continue sur la date fixe</option>
					<option value="1">Nouveau date</option>
				</select>
			</div>
			<br>

			<div>
				<span>Payé avant le date fixe?</span><br>
				<select name="avantdate" required>
					<option value="0">-- Choisis --</option>
					<option value="1" selected>No</option>
					<option value="2">Oui</option>
				</select>
			</div>

			<input name="oui" type="submit" value="Oui" class="oui">
			<input name="no" type="submit" value="No" class="no">
		</form> 

	</div>

</div>
</main>