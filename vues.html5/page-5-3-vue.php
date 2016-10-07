<?php
	// Fonction de la vue page-5-3-vue.php : afficher la demande de changement de mdp
	// Cette vue est appelée par le contrôleur page-5-3-ctrl.php
	// Ecrit le 07/10/2016 par Killian BOUTIN
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>TP 5.3 / Validation de formulaire en PHP</title>
	<link rel="stylesheet" href="page-5-3.css" type="text/css">
	<script language="javascript" type="text/javascript" src="page-5-3.js"></script>
	<script>
		window.onload = initialisations;
		
		function initialisations() {
			document.getElementById("caseAfficherMdp").onchange = afficherMdp;
			document.getElementById("txtNouveauMdp").focus();

			<?php if ($typeMessage == 'avertissement') { ?>
				afficher_avertissement("<?php echo $message; ?>");
			<?php } ?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
		
		function afficherMdp()
		{	if (document.getElementById("caseAfficherMdp").checked == true)
			{	document.getElementById("txtNouveauMdp").type="text";
				document.getElementById("txtConfirmationMdp").type="text";
			}
			else
			{	document.getElementById("txtNouveauMdp").type="password";
				document.getElementById("txtConfirmationMdp").type="password";
			}
		}

		function validationGenerale(){
			if(document.getElementById("txtNouveauMdp").value == ""){
				afficher_avertissement("Le nouveau mot de passe doit être obligatoirement saisi !");
				document.getElementById("txtNouveauMdp").focus();
				return false;
			}
			if(document.getElementById("txtConfirmation").value == ""){
				afficher_avertissement("La confirmation du nouveau mot de passe doit être obligatoireemnt saisie !");
				document.getElementById("txtConfirmation").focus();
				return false;
			}
			if(estUnMdpCorrect(document.getElementById("txtNouveauMdp").value) == false){
				afficher_avertissement("Le mot de passe doit comporter 8 caractères, dont au moins une lettre minuscule, une lettre majuscule et un chiffre !");
				document.getElementById("txtNouveauMdp").focus();
				return false;
			}
			if(document.getElementById("txtNouveauMdp").value != document.getElementById("txtConfirmation").value){
				afficher_avertissement("Les 2 valeurs saisies sont différentes !");
				document.getElementById("txtNouveauMdp").focus();
				return false;
			}
			return true;			
		}

		function estUnMdpCorrect(leMdpATester){
			EXPRESSION = "^.+$";
			monExprRegul = new RegExp(EXPRESSION);
			if (monExprRegul.test(leMdpATester) == true && leMdpAtester.length >= 8) return true;
			else return false;
		}
	</script>
</head> 
<body>
	<div id="page">
		<h3>Modifier mon mot de passe</h3>
		<p><i>(8 caractères minimum avec au moins un chiffre, une lettre minuscule et une lettre majuscule)</i></p>
			<form name="formModificationMdp" id="formModificationMdp" action="#" method="post">
				<p>
					<label for="txtNouveauMdp">Nouveau mot de passe *:</label>
					<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtNouveauMdp" id="txtNouveauMdp" required value="<?php echo $nouveauMdp; ?>" >
				</p>
				<p>
					<label for="txtConfirmationMdp">Confirmation *:</label>
					<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtConfirmationMdp" id="txtConfirmationMdp" required value="<?php echo $confirmationMdp; ?>" >
				</p>
				<p>
					<label for="caseAfficherMdp">Afficher en clair</label>
					<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
				</p>
				<p>
					<input type="submit" name="btnEnvoyer" id="btnEnvoyer" value="Envoyer">
				</p>
			</form>
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>