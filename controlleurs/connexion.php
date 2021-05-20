<?php
include "../modeles/Database.php";

$nbNiveauDossierHREF = 1; 

session_start();
if(isset($_GET["page"]))
{
    redirectionVers(intval($_GET["page"]) , $nbNiveauDossierHREF);
}
else if(isset($_POST["page"]))
{
    redirectionVers(intval($_POST["page"]), $nbNiveauDossierHREF);
}
else
{
    include "../vues/header.php";
    include "../vues/accueil.php";
    include "../vues/footer.php";
}


// Fonctions après ce commentaire


function redirectionVers(int $page, int $nbNiveauDossierHREF)
{
    switch($page) 
    { 
        case 1:
            pageInscription($nbNiveauDossierHREF);
        break;
        
        case 2: // Visualisation de la page de contrôle d'un utilisateur (Si bien sur les identifiants sont corrects)
            pageClient($nbNiveauDossierHREF);
        break;

        case 3: // Visualisation des produits pour l'utilisateur
            pageVisualisationCommandesUtilisateur($nbNiveauDossierHREF);
        break;

        case 4: // Accès au panel de vente
            pagePanelVente($nbNiveauDossierHREF);
        break;

        case 5: // Déconnexion volontaire pour l'utilisateur (Quand il appuie sur le bouton "Déconnexion")
            ramenerVersPageAccueil(true);
        break;

        default: // Pour éviter une quelconque page blanche sur la site, on ramène l'utilisateur vers la page d'accueil et on le déconnecte au cas ou.
            ramenerVersPageAccueil(true);
        break;
    }
}

function pageInscription(int $nbNiveauDossierHREF)
{
    if(!empty($_POST["nomUtilisateur"]) && !empty($_POST["motDePasseUtilisateur"]) && !empty($_POST["motDePasseUtilisateur2"]) && !empty($_POST["adresseElectronique"]) && !empty($_POST["adresseElectronique2"]) && isset($_POST["nom"]) && !empty($_POST["adresse"])) 
    {
        include "VerificationInscription.php";
        $message = VerificationInscription::startVerification($_POST["nomUtilisateur"], $_POST["adresseElectronique"], $_POST["adresseElectronique2"], $_POST["motDePasseUtilisateur"], $_POST["motDePasseUtilisateur2"], $_POST["nom"], $_POST["adresse"]);
    }
    include "../vues/header.php";
    include "../vues/espaceUtilisateurs/inscription.php";
    include "../vues/footer.php";
}

function pageClient(int $nbNiveauDossierHREF)
{
    if(estConnecter())
    {
        include "../vues/header.php";
        include "../vues/espaceUtilisateurs/pageClient.php";
        include "../vues/footer.php";
    }
    else if(isset($_POST["adresseElectronique"], $_POST["motDePasseUtilisateur"]) && !empty($_POST["adresseElectronique"]) && !empty($_POST["motDePasseUtilisateur"])) 
    {
        $resultat = Database::getUtilisateur($_POST["adresseElectronique"], $_POST["motDePasseUtilisateur"]);
        var_dump($resultat);
        if(isset($resultat) && $resultat != false) 
        {
            $_SESSION["ID"] = $resultat["ut_email"];
            include "../vues/header.php";
            include "../vues/espaceUtilisateurs/pageClient.php";
            include "../vues/footer.php";
        }
        else 
        {
            include "../vues/header.php";
            include "../vues/espaceUtilisateurs/connexion.php";
            include "../vues/footer.php";
        }
    }
    else
    {
        include "../vues/header.php";
        include "../vues/espaceUtilisateurs/connexion.php";
        include "../vues/footer.php";
    }
}

function pageVisualisationCommandesUtilisateur(int $nbNiveauDossierHREF)
{
    if(estConnecter())
    {
        $resultats = Database::getProduitsCommandes($_SESSION["ID"]);
        include "../vues/header.php";
        include "../vues/espaceUtilisateurs/pageCommandesUtilisateur.php";
        include "../vues/footer.php";
    }
    else
    {
        ramenerVersPageAccueil(false);
    }
}

function pagePanelVente(int $nbNiveauDossierHREF)
{
    include "../vues/header.php";
    include "../vues/espaceUtilisateurs/vente/vente.php";
    include "../vues/footer.php";
}

/**
 * Permet de vérifier si l'utilisateur est connecté.
 * 
 * @return bool
 */
function estConnecter() : bool
{
    if(isset($_SESSION["ID"]) && !empty($_SESSION["ID"]))
    {
        return true;
    }
    return false;
}


/**
 * Permet de ramener l'utilisateur vers la page d'accueil et le fait déconnecter si besoin.
 */
function ramenerVersPageAccueil(bool $deconnecterUtilisateur)
{
    if($deconnecterUtilisateur)
    {
        $_SESSION["ID"] = null;
        session_destroy();
    }
    $nbNiveauDossierHREF = 1;
    include "../vues/header.php";
    include "../vues/accueil.php";
    include "../vues/footer.php";
}

/**
 * Cette fonction permet de vérifier si l'adresse email n'est pas une injection de POST
 * 
 * @param string $adresseEmail
 * @return bool
 */
function verifierAdresseEmail(string $adresseEmail) : bool
{
    $caracteresEmail = str_split($adresseEmail);

    foreach($caracteresEmail as $caractere)
    {
        if($caractere == "@")
        {
            return true;
        }

        $codeASCII = ord($caractere);

        if($codeASCII < 64 && $codeASCII > 90 && $codeASCII < 97 && $codeASCII > 122)
        {
            return false;
        }
    }

    return false;
}



?>