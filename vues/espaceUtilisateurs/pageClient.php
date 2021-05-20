<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
            <h3><span>Page client</span></h3>
            <br>
            <?php
                if(isset($_SESSION["ID"])) 
                {
                    echo "<a class=\"btn btn-warning\" href=\"connexion.php?page=4\"><span class=\"glyphicon glyphicon-alert\"></span> &ensp;Panel de vente</a><br><br>";
                    echo "<a class=\"btn btn-warning\" href=\"connexion.php?page=3\"><span class=\"glyphicon glyphicon-send\"></span> &ensp;Vos commandes</a><br><br>";
                    echo "<a class=\"btn btn-warning\" href=\"connexion.php?page=5\"><span class=\"glyphicon glyphicon-alert\"></span> &ensp;Se déconecter</a>";
                }
            ?>
            <br>
            <br>
            <div class="form-actions">
                <a class="btn btn-primary" href="accueil.php"><span class="glyphicon glyphicon-arrow-left"></span> &ensp;Retour</a>
            </div>
        </div>
    </div>
</div>