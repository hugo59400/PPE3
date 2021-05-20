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
                    <label>Nom utilisateur</label>
                    <input type="text" name="nomUtilisateur" class="form-control" required>
                    <br>
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                    <br>
                    <label>Adresse</label>
                    <input type="text" name="adresse" class="form-control" required>
                    <br>
                    <label>E-mail</label>
                    <input type="email" name="adresseElectronique" class="form-control" required>
                    <br>
                    <label>Confirmez votre E-mail</label>
                    <input type="email" name="adresseElectronique2" class="form-control" required>
                    <br>
                    <label>Mot de passe</label>
                    <input type="password" name="motDePasseUtilisateur" class="form-control" required>
                    <br>
                    <label>Confirmez votre mot de passe</label>
                    <input type="password" name="motDePasseUtilisateur2" class="form-control" required>
                    <br><br>
                    <input class="btn btn-primary" type="submit" value="Inscription">
                </div>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="connexion.php?page=2"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
        </div>
    </div>
</div>
<?php
if (isset($message)) 
{
    echo $message;
}
?>
</form>