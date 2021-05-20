<h1 class="text-logo"><span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span></h1>
<div class="container admin">
    <div class="row">
        <div class="col-sm-6">
            <br>
            <form method="POST" action="">
                <div class="form-group">
                    <style>
                        label 
                        {
                            display: block;
                        }
                    </style>
                    <label for="1">E-mail:</label>
                    <input id="1" type="email" name="adresseElectronique" class="form-control" required>
                    <br>
                    <label for="2">Mot de passe:</label>
                    <input id="2" type="password" name="motDePasseUtilisateur" class="form-control" required>
                    <br><br>
                    <button class="btn btn-primary" type="submit" name="page" value="2">Connexion</button>
                </div>
            </form>
            <br>
            <div class="form-actions">
                <a class="btn btn-primary" href="accueil.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                <a class="btn btn-warning" href="connexion.php?page=1"><span class="glyphicon glyphicon-envelope"></span> Inscription</a>
            </div>
        </div>
    </div>
</div>