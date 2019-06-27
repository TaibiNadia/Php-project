<fieldset>
	<legend> Identification Responsable </legend> 
	<form  method="post" action="../../controllers/remise/remiseVoirCl.php">
	<input type="hidden" name="id" id="idRemise" maxlength=40  value"<?php echo $idRemise?>"/>
	<input type="hidden" name="action" id="idRemise" maxlength=40  value"3"/>
		<p>
			<label for="login">nom :</label> <input type="text" name="nom" id="nom" maxlength=40  />
		</p>
		<p>
			<label for="pwd">pwd :</label>  <input type="password" name="pwd" id="pwd" maxlength=10 />
		</p>						
		<p>
			<input name="annuler" type="reset" value="Annuler" / >
			<input name="envoyer" type="submit" value="Connexion"/>							
		</p>						
	</form>
</fieldset>	