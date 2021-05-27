<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Blog en PHP</title>

        <link href="css/style.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <?php
        include_once('header.php');
        ?>

        <main>
            <section>
                <?php
                // Affichage des articles
                $articles = 'SELECT * FROM articles WHERE id = ' . $_GET['id'] . '';

                // Exécution de la requête
                $resultat = $connexion->query($articles);

                // Si il y a au moins 1 article
                if($resultat->num_rows > 0) {

                    // Affichage de chaque article
                    while($article = $resultat->fetch_assoc()) {

                        echo "<div class='image'>
                                <img src='images/" . $article['image'] . "'>
                            </div>
                            <h3>" . $article['titre'] . "</h3>
                            <br>
                            <p>" . $article['contenu'] . "</p>
                            <br>
                            " . $article['date'] . "
                            <br>
                            Article créé par " . $article['auteur'] . "";
                    }
                }
                ?>
            </section>
            <section>
                <?php
                include_once('last-articles.php');
                ?>
            </section>
        </main>

        <?php
        include_once('footer.php');
        ?>
    </body>
</html>