<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Supprimer le produit</strong></h1>
        <br>
        <form class="form" action="panelVendeur.php?vente=4" role="form" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
            <div class="form-actions">
              <button type="submit" name="confirmation" value="true" class="btn btn-warning">Oui</button>
              <a class="btn btn-default" href="panelVendeur.php">Non</a>
            </div>
        </form>
    </div>
</div>   

