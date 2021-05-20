<?php
class Database
{
    private static string $dbHost = "localhost";
    private static string $dbName = "all4stock";
    private static string $dbUsername = "root";
    private static string $dbUserpassword = "";

    /**
     * Cette fonction permet d'obtenir une connexion à la base de donnée.
     * 
     * @return PDO
     */
    public static function seConnecter() : PDO
    {
        try
        {
            return  new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUsername, self::$dbUserpassword);
        } 
        catch (PDOException $e) 
        {
            return null;
        }
    }

    /////////////////////////////////////////
    // Requètes de récupération de données //
    /////////////////////////////////////////

    /**
     * Permet de trouver un produit par son nom, cout et description
     * 
     * @return array
     */
    public static function getProduitID(string $nom, float $cout, string $description) : array
    {
        $connexion = self::seConnecter();

        $requete = "SELECT pr_id FROM produit WHERE pr_nom = ? AND pr_cout = ? AND pr_description = ?";

        $requete = $connexion->prepare($requete);

        $requete->bindParam(1, $nom);
        $requete->bindParam(2, $cout);
        $requete->bindParam(3, $description);

        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idProduit
     * 
     * @return array
     */
    public static function getInfoProduitAvecNomRayonEtImage(int $idProduit) : array
    {
        $connexion = self::seConnecter();

        $requete = "SELECT pr_nom, pr_description, pr_cout, pr_image, ra_nom 
        FROM produit 
        LEFT JOIN rayon ON fk_rayon = ra_id 
        WHERE pr_id = ?";

        $requete = $connexion->prepare($requete);
        $requete->bindParam(1, $idProduit);
        $requete->execute();

        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Cette fonction permet d'obtenir des infos du produits avec leur nom de leur rayon.
     * 
     * @return array
     */
    public static function getInfoProduitAvecNomRayon(string $emailUtilisateur) : array
    {
        $connexion = self::seConnecter();

        $requete = "SELECT produit.pr_id, produit.pr_nom, produit.pr_description , produit.pr_cout, rayon.ra_nom 
        FROM produit 
        LEFT JOIN rayon ON produit.fk_rayon = rayon.ra_id 
        JOIN vente ON pr_id = fk_produit
        WHERE pr_id = fk_produit
        AND fk_utilisateur = ?
        ORDER BY produit.pr_id DESC";

        $requete = $connexion->prepare($requete);

        $requete->execute([self::getUtilisateurID($emailUtilisateur)]);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idRayon
     * 
     * @return array
     */
    public static function getProduitsParRayon(int $idRayon) : array
    {
        $connexion = self::seConnecter();

        $requete = $connexion->prepare("SELECT pr_id, pr_nom ,pr_cout, pr_image, pr_description 
        FROM produit
        JOIN rayon ON ra_id = fk_rayon 
        WHERE ra_id = ?;");

        $requete->execute(array($idRayon));

        $produits = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $produits;
    }

    /**
     * Cette fonction permet d'obtenir tout les rayons enregistrés dans la base de données.
     * 
     * @return array
     */
    public static function getToutLesRayons() : array
    {
        $connexion = self::seConnecter();

        $requete = $connexion->query("SELECT ra_id, ra_nom FROM rayon;");

        $rayons = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $rayons;
    }

    /**
     * Cette fonction permet d'obtenir tout les magasins enregistrés dans la base de données.
     */
    public static function getToutLesMagasins() : array
    {
        $connexion = self::seConnecter();

        $requete = $connexion->query("SELECT sto_id, sto_type FROM stock;");

        $magasins = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $magasins;
    }


    public static function getUtilisateur(string $adresseEmail, string $motDePasse)
    {
        $connexion = self::seConnecter();

        $requete = $connexion->prepare("SELECT ut_email FROM utilisateur WHERE ut_email= ? AND ut_mdp= ?;");

        $requete->bindParam(1, $adresseEmail);
        $requete->bindParam(2, $motDePasse);

        $requete->execute();
        $resultats = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    }

    public static function savoirSiUtilisateurExiste(string $adresseEmail) : bool
    {
        $connexion = self::seConnecter();

        $requete = $connexion->prepare("SELECT ut_surnom FROM utilisateur WHERE ut_email= ?;");

        $requete->bindParam(1, $adresseEmail);

        $requete->execute();
        $resultat = $requete->fetch();

        if(isset($resultat))
        {
            return true;
        }
        return false;
    }

    /**
     * Cette fonction permet d'obtenir tout les produits commandé par un certain utilisateur donnée en paramètre.
     * 
     * @param int $identifiantUtilisateur
     * @return array
     */
    public static function getProduitsCommandes(string $identifiantUtilisateur) : array
    {
        $connexion = self::seConnecter();

        $requete = $connexion->prepare("SELECT 
        pr_nom AS nomProduitCommande, 
        com_date AS dateCommande, 
        com_quantite AS quantiteCommande, 
        pr_cout AS prixUnitaireProduitCommande, 
        com_quantite*pr_cout AS totalCommande, 
        sto_type AS lieuExpedition, 
        ut_adresse AS adresseLivraison, 
        et_nom AS etatCommande 
        FROM commande 
        JOIN produit ON pr_id = fk_produit 
        JOIN utilisateur ON ut_id = fk_utilisateur 
        JOIN etat ON et_id = fk_etat 
        JOIN stock ON sto_id = fk_stock 
        WHERE ut_email = ?;");
        
        $requete->bindParam(1, $identifiantUtilisateur);
        
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Permet d'obtenir l'id d'un utilisateur par son adresse mail
     */
    private static function getUtilisateurID(string $email) : int
    {
        $connexion = self::seConnecter();

        $requete = $connexion->prepare("SELECT ut_id FROM utilisateur WHERE ut_email= ?");

        $requete->bindParam(1, $email);

        $requete->execute();
        $resultats = $requete->fetch(PDO::FETCH_ASSOC);

        if($resultats == false)
        {
            return -1;
        }

        return intval($resultats["ut_id"]);
    }

    /////////////////////////////////////
    // Requètes d'insertion de données //
    /////////////////////////////////////

    /**
     * @param array $parametres
     * @param string $emailUtilisateur
     * @param bool $estUneVente
     * 
     * @return void
     */
    public static function insererUnProduit(array $parametres, string $emailUtilisateur, bool $estUneVente) : void
    {
        $connexion = self::seConnecter();

        $requete = "INSERT INTO produit VALUES(null, ?, ?, ?, ?, ?)";

        $requete = $connexion->prepare($requete);

        $requete->bindParam(1, $parametres["name"]);
        $requete->bindParam(2, $parametres["price"]);
        $requete->bindParam(3, $parametres["description"]);
        $requete->bindParam(4, $parametres["image"]);
        $requete->bindParam(5, $parametres["rayon"]);

        $requete->execute();

        if($estUneVente)
        {
            self::insererUneVente($connexion, $parametres, $emailUtilisateur);
        }
    }

    private static function insererUneVente(PDO $connexion, array $parametres, string $emailUtilisateur)
    {
        $idProduit = $connexion->lastInsertId();

        $requete = "INSERT INTO vente VALUES(null, ?, ?, ?, ?, ?)";

        $requete = $connexion->prepare($requete);

        $requete->execute([date("Y/m/d"), $parametres["quantite"], $parametres["endroitVente"], self::getUtilisateurID($emailUtilisateur), $idProduit]);
    }

    /**
     * Permet d'insérer un utilisateur dans la base de donnée.
     * 
     * @param string $surnom
     * @param string $nom
     * @param string $adresse
     * @param string $email
     * @param string $motDePasse
     * 
     * @return void
     */
    public static function insererUtilisateur(string $surnom, string $nom, string $adresse, string $email, string $motDePasse) : void
    {
        $connexion = self::seConnecter();

        $requete = $connexion->prepare("INSERT INTO utilisateur VALUES(NULL, ?, ?, ?, ?, ?, ?);");

        $requete->execute([$surnom, $nom, $adresse, $email, $motDePasse]);
    }


    ////////////////////////////////////////
    // Requètes de mise à jour de données //
    ////////////////////////////////////////

    /**
     * Cette fonction permet de mettre à jour les produits
     * 
     * @param array $parametres
     * @return void
     */
    public static function mettreAJourUnproduit(array $parametres) : void
    {
        $connexion = self::seConnecter();
        $requete = "";
    
        if(isset($parametres["image"]))
        {
            $requete = "UPDATE produit 
            SET pr_nom = ?, pr_cout = ?, pr_description = ?, pr_image = ?, fk_rayon = ? 
            WHERE pr_id = ?";
    
            $requete = $connexion->prepare($requete);
    
            
            $requete->bindParam(1, $parametres["name"]);
            $requete->bindParam(2, $parametres["price"]);
            $requete->bindParam(3, $parametres["description"]);
            $requete->bindParam(4, $parametres["image"]);
            $requete->bindParam(5, $parametres["rayon"]);
            $requete->bindParam(6, $parametres["idProduit"]);
        }
        else
        {
            $requete = "UPDATE produit 
            SET pr_nom = ?, pr_cout = ?, pr_description = ?, fk_rayon = ? 
            WHERE pr_id = ?";
    
            $requete = $connexion->prepare($requete);
    
            
            $requete->bindParam(1, $parametres["name"]);
            $requete->bindParam(2, $parametres["price"]);
            $requete->bindParam(3, $parametres["description"]);
            $requete->bindParam(4, $parametres["rayon"]);
            $requete->bindParam(5, $parametres["idProduit"]);
        }

        $requete->execute();
    }

    
    ///////////////////////////////////////
    // Requètes de supression de données //
    ///////////////////////////////////////


    /**
     * Cette fonction permet de supprimer un produit avec sa vente
     * 
     * @param int $idProduit
     * 
     * @return void
     */
    public static function supprimerProduitParID(int $idProduit) : void
    {
        $connexion = self::seConnecter();

        $requete = $connexion->prepare("SELECT pr_image FROM produit WHERE pr_id = ?");
        $requete->bindParam(1, $idProduit);
        $requete->execute();

        unlink("../images/" . $requete->fetch()["pr_image"]);

        $requete = $connexion->prepare("DELETE FROM vente WHERE fk_produit = ?");
        $requete->bindParam(1, $idProduit);
        $requete->execute();

        $requete = $connexion->prepare("DELETE FROM produit WHERE pr_id = ?");
        $requete->bindParam(1, $idProduit);
        $requete->execute();
    }
}