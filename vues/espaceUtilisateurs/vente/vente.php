<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Liste de vos produits en vente </strong><br><br><a href="panelVendeur.php?vente=2" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter un produit</a></h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $produits = Database::getInfoProduitAvecNomRayon($_SESSION["ID"]);
                foreach($produits as $produit)
                {
                    echo '<tr>
                            <td>' . $produit['pr_nom'] . '</td>
                            <td>' . $produit['pr_description'] . '</td>
                            <td>' . number_format($produit['pr_cout'], 2, '.', '') . '</td>
                            <td>' . $produit['ra_nom'] . '</td>
                            <td width=300>
                                <a class="btn btn-default" href="panelVendeur.php?vente=1&id=' . $produit['pr_id'] . '"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>
                                <a class="btn btn-primary" href="panelVendeur.php?vente=3&id=' . $produit['pr_id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
                                <a class="btn btn-danger" href="panelVendeur.php?vente=4&id=' . $produit['pr_id'] . '"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>
                            </td>
                        </tr>';
                }   
                ?>
            </tbody>
        </table>
        <div class="form-actions">
            <a class="btn btn-primary" href="connexion.php?page=2"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        </div>
    </div>
</div>