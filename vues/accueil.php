<?php

    if(isset($_SESSION["ID"]))
    {
        echo "
        <div class=\"form-actions\">
            <a class=\"btn btn-warning\" href=\"connexion.php?page=-1\"><span class=\"glyphicon glyphicon-user\"></span>Déconnexion</a>
        </div>
        <div class=\"form-actions\">
            <a class=\"btn btn-warning\" href=\"connexion.php?page=2\"><span class=\"glyphicon glyphicon-user\"></span> Compte</a>
        </div>";
    }
    else
    {
        echo "
        <div class=\"form-actions\">
            <a class=\"btn btn-warning\" href=\"connexion.php?page=2\"><span class=\"glyphicon glyphicon-user\"></span> Connexion</a>
        </div>";
    }

?>

    <div class="container site">
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-hand-right"></span> All4Sport <span class="glyphicon glyphicon-hand-left"></span><a href="" class="danger btn-lg disabled" role="button" aria-disabled="true"></a>
        </h1>

        <?php

        echo '<nav><ul class="nav nav-pills">';

        $rayons = Database::getToutLesRayons();
        foreach ($rayons as $rayon) 
        {
            if ($rayon['ra_id'] == '1')
            {
                echo '<li role="presentation" class="active"><a href="#' . $rayon['ra_id'] . '" data-toggle="tab">' . $rayon['ra_nom'] . '</a></li>';
            }
            else
            {
                echo '<li role="presentation"><a href="#' . $rayon['ra_id'] . '" data-toggle="tab">' . $rayon['ra_nom'] . '</a></li>';
            }
        }

        echo    '</ul></nav><div class="tab-content">';

        foreach ($rayons as $rayon) 
        {
            if ($rayon['ra_id'] == '1')
            {
                echo '<div class="tab-pane active" id="' . $rayon['ra_id'] . '">';
            }
            else
            {
                echo '<div class="tab-pane" id="' . $rayon['ra_id'] . '">';
            }
               
            echo '<div class="row">';
        
            $produits = Database::getProduitsParRayon($rayon['ra_id']);
            foreach($produits as $produit)
            {
                echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="../images/' . $produit['pr_image'] . '" alt="...">
                                    <div class="price">' . number_format($produit['pr_cout'], 2, '.', '') . ' €</div>
                                    <div class="caption">
                                        <h4>' . $produit['pr_nom'] . '</h4>
                                        <a href="voirProduit/index.php?id=' . $produit['pr_id'] . '" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Voir</a>
                                    </div>
                                </div>
                            </div>';
            }
            echo    '</div>
                </div>';
        }
        ?>
        </div>
    </div>