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
                <h2>Articles</h2>

                <a href="filtre.php?categorie=nourriture">Filter les articles Nourriture</a>
                <a href="filtre.php?categorie=hébergement">Filter les articles Hébergement</a>

                <?php
                // Affichage des articles
                $articles = "SELECT * FROM articles ORDER BY id DESC";

                // Exécution de la requête
                $resultat = $connexion->query($articles);

                echo "<ul class='articles'>";

                // Si il y a au moins 1 article
                if($resultat->num_rows > 0) {

                    // Affichage de chaque article
                    while($article = $resultat->fetch_assoc()) {

                        echo "<li>
                            <div class='image'>
                                <img src='images/" . $article['image'] . "'>
                            </div>
                            <h3>" . $article['titre'] . "</h3>
                            <br>
                            " . $article['date'] . "
                            <br>
                            Article créé par " . $article['auteur'] . "
                            <a href='article.php?id=" . $article['id'] . "'>Lire l'article</a>

                            <a href='update-article.php?id=" . $article['id'] . "'>Modifier l'article</a>

                            <a href='delete-article.php?id=" . $article['id'] . "'>Supprimer l'article</a>
                        </li>";
                    }
                }

                echo "</ul>";
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