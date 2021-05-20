<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Ajouter un item</strong></h1>
        <br>
        <form class="form" action="panelVendeur.php" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
            </div>
            <div class="form-group">
                <label for="price">Prix: (en €)</label>
                <input type="number" min="0" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" required>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité:</label>
                <input type="number" min="1" step="1" class="form-control" id="quantite" name="quantite" placeholder="Quantité" required>
            </div>
            <div class="form-group">
                <label for="rayon">Catégorie:</label>
                <select class="form-control" id="rayon" name="rayon">
                    <?php
                        $rayons = Database::getToutLesRayons();
                        foreach($rayons as $rayon) 
                        {
                            echo '<option value="' . $rayon['ra_id'] . '">' . $rayon['ra_nom'] . '</option>';;
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="endroitVente">Magasin (Où vendre):</label>
                <select class="form-control" id="endroitVente" name="endroitVente">
                    <?php
                        $magasins = Database::getToutLesMagasins();
                        foreach($magasins as $magasin) 
                        {
                            echo '<option value="' . $magasin['sto_id'] . '">' . $magasin['sto_type'] . '</option>';;
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Sélectionner une image:</label>
                <input type="file" id="image" name="image" class="form-control" required>
                <span class="help-inline"><?php if(isset($imageErreur)){echo $imageErreur;} ?></span>
            </div>
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="vente" value="2"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                <a class="btn btn-primary" href="panelVendeur.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </form>
    </div>
</div>