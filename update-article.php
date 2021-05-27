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
                <h2>Modifier un article</h2>

                <form method="POST">
                    <?php
                    // Affichage des articles
                    $articles = 'SELECT * FROM articles WHERE id = ' . $_GET['id'] . '';

                    // Exécution de la requête
                    $resultat = $connexion->query($articles);

                    // Affichage de l'article
                    while($article = $resultat->fetch_assoc()) {

                        echo "<label>Titre de l'article</label>
                        <input type='text' name='titre' value='" . $article['titre'] . "'>
                        <br>
                        <br>
                        <label>Contenu de l'article</label>
                        <textarea name='contenu'>" . $article['contenu'] . "</textarea>
                        <br>
                        <br>
                        <label>Image de l'article</label>
                        <input type='text' name='image' value='" . $article['image'] . "'>
                        <br>
                        <br>
                        <label>Auteur de l'article</label>
                        <input type='text' name='auteur' value='" . $article['auteur'] . "'>
                        <br>
                        <br>
                        <label>Catégorie de l'article</label>
                        <select name='categorie'>
                            <option value='nourriture'>nourriture</option>
                            <option value='hébergement'>hébergement</option>
                            <option value='automobile'>automobile</option>
                            <option value='vacances'>vacances</option>
                        </select>
                        <input type='hidden' name='id' value='" . $article['id'] . "'>
                        <br>
                        <br>
                        ";
                        ?>

                        <input type="submit" name="modifier-article" value="Modifier l'article">

                        <?php
                    }

                    // Soumission du formulaire de modification d'articles
                    if(isset($_POST['modifier-article'])) {

                        // Récupération des champs du formulaire
                        $titre = $_POST['titre'];
                        $contenu = $_POST['contenu'];
                        $image = $_POST['image'];
                        $auteur = $_POST['auteur'];
                        $categorie = $_POST['categorie'];
                        $date = date("j, n, Y");
                        $id = $_POST['id'];

                        echo $titre . " | ";
                        echo $contenu . " | ";
                        echo $image . " | ";
                        echo $auteur . " | ";
                        echo $categorie;
                        echo $id;

                        // Modification de l'article
                        $update_article = "UPDATE articles SET
                                            titre = '$titre',
                                            contenu = '$contenu',
                                            date = '$date',
                                            image = '$image',
                                            auteur = '$auteur',
                                            categorie = '$categorie'
                                            WHERE id = $id";

                        if($connexion->query($update_article) === TRUE){
                            echo "L'article a bien été modifié";
                        }
                        else {
                            echo "Erreur: " . $update_article . "<br>" . $connexion->error;
                        }
                    }
                    ?>
                </form>
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