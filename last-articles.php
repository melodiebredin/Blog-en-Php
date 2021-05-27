<h2>Articles récents</h2>

<p>Les 3 derniers</p>

<?php
// Affichage des articles
$articles = "SELECT * FROM articles ORDER BY id DESC LIMIT 0,3";

// Exécution de la requête
$resultat = $connexion->query($articles);

echo "<ul class='articles'>";

// Si il y a au moins 1 article
if($resultat->num_rows > 0) {

    // Affichage de chaque article
    while($article = $resultat->fetch_assoc()) {

        echo "<li>
            <h3>" . $article['titre'] . "</h3>
            <br>
            " . $article['date'] . "
            <br>
            Article créé par " . $article['auteur'] . "
            <a href='article.php?id=" . $article['id'] . "'>Lire l'article</a>
        </li>";
    }
}

echo "</ul>";
?>