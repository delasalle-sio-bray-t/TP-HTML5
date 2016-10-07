<?php
// Fonction du contrôleur page-5-3-ctrl.php : traiter la demande de changement de mot de passe
// Ecrit le 07/10/2016 par Killian BOUTIN

if ( ! isset ($_POST ["txtNouveauMdp"]) && ! isset ($_POST ["txtConfirmationMdp"]) ) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$nouveauMdp = '';
		$confirmationMdp = '';
		$afficherMdp = 'off';
		$message = '';
		$typeMessage = '';					// 2 valeurs possibles : 'information' ou 'avertissement'
		include_once ('page-5-3-vue.php');
	}
else {
	// récupération des données postées
	if ( empty ($_POST ["txtNouveauMdp"]) == true)  $nouveauMdp = "";  else   $nouveauMdp = $_POST ["txtNouveauMdp"];
	if ( empty ($_POST ["txtConfirmationMdp"]) == true)  $confirmationMdp = "";  else   $confirmationMdp = $_POST ["txtConfirmationMdp"];
	if ( empty ($_POST ["caseAfficherMdp"]) == true)  $afficherMdp = 'off';  else   $afficherMdp = $_POST ["caseAfficherMdp"];
			
	if ( $nouveauMdp == "" || $confirmationMdp == "" ) {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$message = 'Données incomplètes !';
		$typeMessage = 'avertissement';
		include_once ('page-5-3.php');
	}
	else {
		if ( $nouveauMdp != $confirmationMdp ) {
			// si les données sont incorrectes, réaffichage de la vue avec un message explicatif
			$message = 'Le nouveau mot de passe et sa confirmation sont différents !';
			$typeMessage = 'avertissement';
			include_once ('page-5-3-vue.php');
		}
		else {
			if (strlen($nouveauMdp) < 8 ) {
				// si les données sont incorrectes, réaffichage de la vue avec un message explicatif
				$message = 'Le nouveau mot de passe doit comporter au moins 8 caractères!';
				$typeMessage = 'avertissement';
				include_once ('page-5-3-vue.php');
			}
			else{
			$sujet = "Modification de votre mot de passe";
			$message = "Votre mot de passe a été modifié.\n\n";
			$message .= "Votre nouveau mot de passe est : " .$nouveauMdp;
			$adresseEmetteur = "delasalle.sio.eleves@gmail.com";
			// pour l'adresse du destinataire, utilisez votre adresse personnelle
			$adresseDestinataire = "votre.adresseMail";
		
			// utilisation d'une expression régulière pour vérifier si c'est une adresse Gmail
			if (preg_match("#^.+@gmail.com$#", $adresseDestinataire) == true )
			{	// on commence par enlever les points dans l'adresse gmail car ils ne sont pas pris en compte
				$adresseDestinataire = str_replace(".","",$adresseDestinataire);
				// puis on remet le point de "@gmail.com"
				$adresseDestinataire = str_replace("@gmailcom","@gmail.com", $adresseDestinataire);
			}
			// envoi du mail avec la fonction de PHP
			$ok = mail($adresseDestinataire, $sujet, $message, "From :" . $adresseEmetteur);
			if ($ok){
				$message = "Enregistrement effectué.<br> Vous allez recevoir un mail de confirmation.";
				$typeMessage = "information";
			}
			else{
				$message = "Enregistrement effectué.<br>L'envoi du mail de confirmation a rencontré un problème.";
				$typeMessage = 'avertissement';
			}
			include_once ('page-5-3-vue.php');
			}			
		}		
	}
}