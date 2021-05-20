<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>Modifier un item</strong></h1>
            <br>
            <form class="form" action="panelVendeur.php?vente=3" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom:
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Prix: (en €)
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>" required>         
                </div>
                <div class="form-group">
                    <label for="rayon">Rayon:
                        <select class="form-control" id="rayon" name="rayon">
                            <?php
                            $rayons = Database::getToutLesRayons();
                            foreach($rayons as $rayon) 
                            {
                                if ($rayon['ra_nom'] == $category)
                                {
                                    echo '<option selected="selected" value="' . $rayon['ra_id'] . '">' . $rayon['ra_nom'] . '</option>';
                                }                                    
                                else
                                {
                                    echo '<option value="' . $rayon['ra_id'] . '">' . $rayon['ra_nom'] . '</option>';
                                }
                                    
                            }
                            ?>
                        </select>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label><br>
                    <input type="text" value="<?php echo $image; ?>" class="form-control" name="imageOriginal" readonly>
                </div>
                <div class="form-group">
                    <label for="image">Sélectionner une nouvelle image:</label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php if(isset($imageErreur)){echo $imageErreur;} ?></span>
                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success" name="idProduit" value="<?php echo $_GET["id"]; ?>"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                    <a class="btn btn-primary" href="panelVendeur.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </form>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img src="<?php echo '../images/' . $image; ?>" alt="...">
                <div class="price"><?php echo number_format((float)$price, 2, '.', '') . ' €'; ?></div>
                <div class="caption">
                    <h4><?php echo $name; ?></h4>
                    <p><?php echo $description; ?></p>
                    <a href="" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Voir</a>
                </div>
            </div>
        </div>
    </div>
</div>