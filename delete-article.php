<?php
echo "
    <form method='POST'>
        <p>Etes-vous sûr de vouloir supprimer cet article ?</p>
        <input type='radio' name='choix' value='oui'> Oui
        <input type='radio' name='choix' value='non'> Non
        <input type='submit' name='supprimer' value='Supprimer'>
    </form>
";

if(isset($_POST['supprimer'])){

    $choix = $_POST['choix'];

    if($choix == 'oui') {

        include_once('mysql-config.php');

        $id = $_GET['id'];

        $delete_article = "DELETE FROM articles WHERE id = $id";

        if($connexion->query($delete_article) === TRUE) {
            echo "L'article a bien été supprimé";
        }
        else {
            echo "Erreur: " . $delete_article . "<br>" . $connexion->error;
        }
    }

    echo "<a href='index.php'>Revenir à la page d'accueil</a>";
}