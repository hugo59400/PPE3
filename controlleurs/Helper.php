<?php
class Helper
{
    /**
     * Permet de faire afficher une page
     * Remarque: le $variable peut être de n'importe quel type, 
     * elle sert pour l'affichage dans les pages (Par éxemple un produit avec ces infos)
     * 
     * @param string $chemin
     * @param int $nbNiveauDossierHREF
     * @param $variable
     * @return void
     */
    public static function afficherPage(string $chemin, int $nbNiveauDossierHREF, $variable = null) : void
    {
        $retourEnArriere = "";

        for($i = 0; $i < $nbNiveauDossierHREF; $i++)
        {
            $retourEnArriere .= "../";
        }

        include $retourEnArriere . "vues/header.php";
        include $retourEnArriere . "vues/" . $chemin;
        include $retourEnArriere . "vues/footer.php";
    }
}
?>