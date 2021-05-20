<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <div class="col-sm-12">
            <h1><u> Vos commandes: </u></h1>
            <br><br>

            <?php
            foreach($resultats as $resultat) 
            {
                if(isset($resultat["nomProduitCommande"], $resultat["dateCommande"], $resultat["quantiteCommande"], $resultat["prixUnitaireProduitCommande"], $resultat["totalCommande"], $resultat["lieuExpedition"], $resultat["adresseLivraison"])) 
                {
                    echo"
                    <table class=\"table table-striped table-bordered\">
                    <thead>
                        <tr>
                            <th style=\"text-align: center;\">Nom</th>
                            <th style=\"text-align: center;\">Date</th>
                            <th style=\"text-align: center;\">Quantité</th>
                            <th style=\"text-align: center;\">Prix unitaire</th>
                            <th style=\"text-align: center;\">Prix total</th>
                            <th style=\"text-align: center;\">Lieu d'expédition</th>
                            <th style=\"text-align: center;\">Adresse d'expédition</th>
                            <th style=\"text-align: center;\">Etat</th>
                        </tr>
                    </thead>
                    <tbody>
                    ";

                    echo "
                    <td>" . $resultat["nomProduitCommande"] . 
                    "</td><td>" . $resultat["dateCommande"] . 
                    "</td><td>" . $resultat["quantiteCommande"] . 
                    "</td><td>" . $resultat["prixUnitaireProduitCommande"] . 
                    "</td><td>" . $resultat["totalCommande"] . 
                    "</td><td>" . $resultat["lieuExpedition"] . 
                    "</td><td>" . $resultat["adresseLivraison"] . 
                    "</td><td>" . $resultat["etatCommande"] . 
                    "</td>
                    </tbody>
                    </table>
                    
                    <br><br><hr></b><br><br>
                    
                    ";
                }
            }
            ?>

            <a class="btn btn-primary" href="connexion.php?page=2"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        </div>
    </div>
</div>