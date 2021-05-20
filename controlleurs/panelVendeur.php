<?php
$nbNiveauDossierHREF = 1; // La variable permet de définir combien de fois le "../" doit être répété dans le header.php

session_start();
if(isset($_SESSION["ID"]) && !empty($_SESSION["ID"]))
{
    if(isset($_GET["vente"]) && verifierVariable($_GET["vente"])) 
    {
        redirectionVers(intval($_GET["vente"]), $nbNiveauDossierHREF);
    }
    else if(isset($_POST["vente"]) && verifierVariable($_POST["vente"]))
    {
        redirectionVers(intval($_POST["vente"]), $nbNiveauDossierHREF);
    }
    else
    {
        include "../modeles/Database.php";
        include "../vues/header.php";
        include "../vues/espaceUtilisateurs/vente/vente.php";
        include "../vues/footer.php";
    }
}
else
{
    include "../vues/header.php";
    include "../vues/accueil.php";
    include "../vues/footer.php";
}





/**
 * On vérifie que la variable n'est pas vide et qu'elle est un nombre.
 * 
 * @param string $variable
 * 
 * @return bool
 */
function verifierVariable(string $variable) : bool
{
    if(!empty($variable) && is_numeric($variable))
    {
        return true;
    }
    return false;
}

/**
 * Permet d'éxécuter le bon code pour afficher et gérer les demandes de l'utilisateurs (Voir, Ajouter, Mettre à jour et supprimer)
 * 
 * @param int $page
 * 
 * @return void
 */
function redirectionVers(int $page, int $nbNiveauDossierHREF) : void
{
    include "../modeles/Database.php";

    switch($page) 
    {
        case 1:
            voir($nbNiveauDossierHREF);
        break;
        case 2:
            inserer($nbNiveauDossierHREF, $_POST);
        break;
        case 3:
            mettreAJour($nbNiveauDossierHREF);
        break;
        case 4:
            supprimer($nbNiveauDossierHREF);
        break;
        default:
            $nbNiveauDossierHREF = 1;
            include "../modeles/Database.php";
            include "../vues/header.php";
            include "../vues/espaceUtilisateurs/vente/vente.php";
            include "../vues/footer.php";
        break;
    }
}

/**
 * Permet d'éxécuter le code pour voir un produit
 * 
 * @param int $nbNiveauDossierHREF
 * 
 * @return void
 */
function voir(int $nbNiveauDossierHREF) : void
{
    $produit = null;
    if (isset($_GET["id"]) && !empty($_GET['id']) && is_numeric($_GET["id"])) 
    {
        $id = checkInput($_GET['id']);
        $produit = Database::getInfoProduitAvecNomRayonEtImage($_GET['id']);
    }

    include "../vues/header.php";
    include "../vues/espaceUtilisateurs/vente/voir.php";
    include "../vues/footer.php";
}

/**
 * Permet d'éxécuter le code pour ajouter un produit.
 * 
 * @param int $nbNiveauDossierHREF
 * @param array $post
 * 
 * @return void
 */
function inserer(int $nbNiveauDossierHREF, array $post) : void
{
    $imageErreur = "";
            
    if (isset($post, $_FILES["image"]) && !empty($post)) 
    {
        unset($post["admin"]); // on enlève cette variable car on en a plus besoin et qu'elle risque de géner la requète sql.
        $tableau = verifierTableau($post);
        $tableau["image"] = checkInput($_FILES["image"]["name"]);
        $messageErreur = imageEstUpload($tableau["image"]);

        if(empty($messageErreur))
        {
            $imageErreur = $messageErreur;
        }

        Database::insererUnProduit($tableau, "", true); //  A revoir
    }

    include "../vues/header.php";
    include "../vues/espaceUtilisateurs/vente/inserer.php";
    include "../vues/footer.php";
}

/**
 * Permet d'éxécuter le code pour mettre à jour un produit.
 * 
 * @param int $nbNiveauDossierHREF
 * @return void
 */
function mettreAJour(int $nbNiveauDossierHREF) : void
{
    $imageErreur = "";
    if (isset($_POST, $_FILES["image"]) && !empty($_POST)) 
    {
        $tableau = verifierTableau($_POST);
        $tableau["image"] = checkInput($_FILES["image"]["name"]);

        $image = "";

        if(empty($tableau["image"]))
        {
            unset($tableau["image"]);
            $image = $tableau["imageOriginal"];
            $imageErreur = imageEstUpload($image);
        }
        else
        {
            $image = $tableau["image"];
            $imageErreur = imageEstUpload($image);
        }

        Database::mettreAJourUnproduit($tableau);
        $name           = $tableau['name'];
        $description    = $tableau['description'];
        $price          = $tableau['price'];
        $category       = $tableau['rayon'];

    } 
    else 
    {
        if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) 
        {
            $id = checkInput($_GET['id']);
            $produit = Database::getInfoProduitAvecNomRayonEtImage($id);
            $name           = $produit['pr_nom'];
            $description    = $produit['pr_description'];
            $price          = $produit['pr_cout'];
            $category       = $produit['ra_nom'];
            $image          = $produit['pr_image'];
        }
    }

    include "../vues/header.php";
    include "../vues/espaceUtilisateurs/vente/mettreAJour.php";
    include "../vues/footer.php";
}

/**
 * Permet d'éxécuter le code pour supprimer un produit.
 * 
 * @param int $nbNiveauDossierHREF
 * @return void
 */
function supprimer(int $nbNiveauDossierHREF) : void
{
    $id = "";
    if(isset($_GET["id"]) && !empty($_GET['id']) && is_numeric($_GET["id"])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(isset($_POST["id"]) && !empty($_POST["id"]) && is_numeric($_POST["id"]) && $_POST["confirmation"])
    {
        $id = checkInput($_POST['id']);
        Database::supprimerProduitParID(intval($id));
        header("Location: panelVendeur.php");
    }

    include "../vues/header.php";
    include "../vues/espaceUtilisateurs/vente/supprimer.php";
    include "../vues/footer.php";
}





/**
 * Pour faire simple, c'est une fonction de sécurité.
 * 
 * @param string $data
 * @return string
 */
function checkInput(string $data) : string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Cette fonction permet d'éleminer les variables qui sont défini à null ou d'éliminer celles qui sont vide.
 * 
 * @param array $tableau
 * @return array
 */
function verifierTableau(array $tableau) : array
{
    $nouveauTableau = array();
    foreach($tableau as $index => $variable)
    {
        if($variable !== null && !empty($variable))
        {
            $nouveauTableau[$index] = checkInput($variable);
        }
    }
    return $nouveauTableau;
}

/**
 * Cette fonction permet de vérifier:
 * 
 * -> l'extension du fichier (Rappel: On ne veut que les types: "JPG", "PNG", "JPEG", "GIF").
 * -> si le fichier éxiste.
 * -> si la taille du fichier est en dessous de 500 kb (Kilo octet ou Kilo byte)
 * -> si le fichier à bien été déplacé dans le dossier "images".
 * 
 * @param $image
 * @return string
 */
function imageEstUpload(string $image) : string
{
    $imagePath = '../images/' . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

    if(verifierExtensionDuFichier($imageExtension)) 
    {
        if(!file_exists($imagePath)) 
        {
            if($_FILES["image"]["size"] < 500000) 
            {
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                   return "";
                }
                return "Il y a eu une erreur lors de l'upload";
            }
            return "Le fichier ne doit pas depasser les 500KB";
        }
        return "Le fichier existe deja";
    }
    return "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
}

/**
 * Vérifie l'extension du fichier donnée en paramètre.
 * Si elle est de type JPG, ou PNG, ou JPEG, ou GIF alors la fonction renvoie true.
 * Sinon la fonction renvoie false.
 * 
 * @param string $extension
 * @return bool
 */
function verifierExtensionDuFichier(string $extension) : bool
{
    if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") 
    {
        return false;
    }
    return true;
}



?>