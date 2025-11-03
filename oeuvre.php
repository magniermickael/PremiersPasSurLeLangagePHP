<!doctype html>
<html lang="fr">

<?php
// ---- Inclusions globales ----
require_once(__DIR__ . '/bloc/head.php'); // Partie <head> du site (balises <head>, CSS, meta…)
$oeuvres = require_once(__DIR__ . '/data/oeuvres.php'); // Chargement du tableau des œuvres


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Récupère l'ID depuis l'URL (ex : oeuvre.php?id=1)

// Recherche de l'œuvre correspondante dans le tableau
$oeuvre = null; // variable pour stocker l'œuvre trouvée
foreach ($oeuvres as $item) { // $item = chaque œuvre du tableau
    if ((int)$item['id'] === $id) { // comparaison des IDs
        $oeuvre = $item; // on a trouvé l'œuvre
        break; // stoppe la boucle dès qu'on a trouvé
    }
}

// Si l'œuvre n'existe pas → message 404
if (!$oeuvre) { // œuvre non trouvée
    http_response_code(404); // envoie un code 404 au navigateur
    require_once(__DIR__ . '/bloc/header.php'); // inclusion du header
    echo '<main><h1>Œuvre introuvable</h1><p>Cette œuvre n’existe pas ou l’ID est invalide.</p></main>'; // message d'erreur
    require_once(__DIR__ . '/bloc/footer.php'); // inclusion du footer
    exit; // stoppe l'exécution du script
}
?>

<body>
    <?php require_once(__DIR__ . '/bloc/header.php'); ?> <!-- Inclusion du header (menu, logo…) -->

    <main>
        <article id="detail-oeuvre"> <!-- Détail de l'œuvre -->
            <div id="img-oeuvre">
                <img src="img/<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>"> <!-- Image dynamique -->
            </div>

            <div id="contenu-oeuvre">
                <h1><?= htmlspecialchars($oeuvre['titre']) ?></h1><!-- Titre -->
                <p class="description"><?= htmlspecialchars($oeuvre['description']) ?></p><!-- description -->
                <p class="description-complete"><?= nl2br(htmlspecialchars($oeuvre['description-complete'])) ?></p><!-- Texte complet -->
                <p><a href="index.php" class="retour">← Retour à la galerie</a></p><!-- Lien retour -->
            </div>
        </article>
    </main>

    <?php require_once(__DIR__ . '/bloc/footer.php'); ?> <!-- Inclusion du footer -->

</body>

</html>