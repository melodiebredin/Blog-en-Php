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
                <h2>Publier un article</h2>
                <form method="POST" enctype="multipart/form-data">
                    <label>Titre de l'article</label>
                    <input type="text" name="titre" placeholder="Titre de l'article">
                    <br>
                    <br>
                    <label>Contenu de l'article</label>
                    <textarea name="contenu" placeholder="Contenu de l'article"></textarea>
                    <br>
                    <br>
                    <label>Image</label>
                    <input type="file" name="image">
                    <br>
                    <br>
                    <label>Auteur</label>
                    <input type="text" name="auteur" placeholder="Auteur de l'article">
                    <br>
                    <br>
                    <label>Catégorie</label>
                    <select name="categorie">
                        <option value="nourriture">nourriture</option>
                        <option value="hébergement">hébergement</option>
                        <option value="automobile">automobile</option>
                        <option value="vacances">vacances</option>
                    </select>
                    <br>
                    <br>
                    <input type="submit" name="publier-article" value="Publier l'article">
                </form>

                <?php
                // Soumission du formulaire de publication d'articles
                if(isset($_POST['publier-article'])) {

                    // Si le fichier à uploader est valide
                    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

                        echo "Le fichier est valide";

                        // Récupération des informations du fichier à uploader
                        // chemin temporaire
                        $chemin_temporaire = $_FILES['image']['tmp_name'];
                        // nom du fichier
                        $nom_image = $_FILES['image']['name'];
                        // Taille de l'image
                        $taille_image = $_FILES['image']['size'];
                        // Type du fichier
                        $type_image = $_FILES['image']['type'];
                        // Séparation du nom et de l'extension de l'image
                        $separation = explode(".", $nom_image);
                        // Extension de l'image en minuscle
                        $extension_minuscule = strtolower(end($separation));

                        // Réécriture du nom de l'image
                        $nouveau_nom_image = $nom_image . '.' . $extension_minuscule;

                        // Autorisation de certaines extensions
                        $extensions_autorisees = array('jpg', 'gif', 'png', 'jpeg');

                        if(in_array($extension_minuscule, $extensions_autorisees)) {

                            $dossier_destination = 'images/';
                            $chemin_destination = $dossier_destination . $nouveau_nom_image;

                            // UPLOAD !!!!
                            if(move_uploaded_file($chemin_temporaire, $chemin_destination)) {

                                $message = "L'image a bien été uploadée";

                                // Récupération des champs du formulaire
                                $titre = $_POST['titre'];
                                $contenu = $_POST['contenu'];
                                $image = $nouveau_nom_image;
                                $auteur = $_POST['auteur'];
                                $categorie = $_POST['categorie'];
                                $date = date("j, n, Y");

                                $new_article = "INSERT INTO articles (titre, contenu, date, image, auteur, categorie)
                                                VALUES ('$titre', '$contenu', '$date', '$image', '$auteur', '$categorie')";

                                if($connexion->query($new_article) === TRUE) {
                                    echo "L'article a bien été ajouté";
                                }
                                else {
                                    echo "Erreur: " . $new_article . "<br>" . $connexion->error;
                                }
                            }
                            else {

                                $message = "Erreur lors de l'upload de l'image dans : " . $chemin_destination;
                            }
                        }
                        else {

                            $message = "L'extension du fichier n'est pas autorisé";
                        }
                    }
                    else {
                        $message = "Erreur lors de l'upload de l'image";
                    }

                    echo $message;
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