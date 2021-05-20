<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
            <h1><strong>Voir le produit</strong></h1>
            <br>
            <form>
                <div class="form-group">
                    <label>Nom:</label><?php echo '  ' . $produit['pr_nom']; ?>
                </div>
                <div class="form-group">
                    <label>Description:</label><?php echo '  ' . $produit['pr_description']; ?>
                </div>
                <div class="form-group">
                    <label>Prix:</label><?php echo '  ' . number_format((float)$produit['pr_cout'], 2, '.', '') . ' €'; ?>
                </div>
                <div class="form-group">
                    <label>Catégorie:</label><?php echo '  ' . $produit['ra_nom']; ?>
                </div>
                <div class="form-group">
                    <label>Image:</label><?php echo '  ' . $produit['pr_image']; ?>
                </div>
            </form>
            <br>
            <div class="form-actions">
                <a class="btn btn-primary" href="accueil.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            </div>
        </div>
        <div class="col-sm-6 site">
            <div class="thumbnail">
                <img src="<?php echo '../images/' . $produit['pr_image']; ?>" alt="...">
                <div class="price"><?php echo number_format((float)$produit['pr_cout'], 2, '.', '') . ' €'; ?></div>
                <div class="caption">
                    <h4><?php echo $produit['pr_nom']; ?></h4>
                    <p><?php echo $produit['pr_description']; ?></p>
                    <a href="" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</a>
                </div>
            </div>
        </div>
    </div>
</div>