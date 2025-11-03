<!doctype html>
<html lang="fr">

<?php
// ---- Inclusions principales ----
require_once(__DIR__ . '/bloc/head.php'); // Head du site (balises <head>, CSS, meta…)
$oeuvres = require_once(__DIR__ . '/data/oeuvres.php'); // Chargement du tableau d'œuvres (fichier data/oeuvres.php retourne un tableau)
?>

<body>
    <?php require_once(__DIR__ . '/bloc/header.php'); ?> <!-- Inclusion du header (logo, menu…) -->

    <main>
        <div id="liste-oeuvres">
            <?php if (isset($oeuvres) && is_array($oeuvres)): ?> <!-- Vérifie que $oeuvres existe et est un tableau -->
                <?php foreach ($oeuvres as $oeuvre): ?> <!-- Boucle : crée une vignette pour chaque œuvre -->

                    <a class="oeuvre" href="oeuvre.php?id=<?= htmlspecialchars($oeuvre['id']) ?>"> <!-- Lien vers la page détail avec l'ID en paramètre -->
                        <img src="img/<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>"> <!-- Image dynamique -->
                        <h2><?= htmlspecialchars($oeuvre['titre']) ?></h2> <!-- Titre -->
                        <p class="description"><?= htmlspecialchars($oeuvre['description']) ?></p><!-- description courte -->
                    </a>

                <?php endforeach; ?> <!-- Fin de la boucle -->

            <?php endif; ?> <!-- Fin du test sur $oeuvres -->
        </div>
    </main>

    <?php require_once(__DIR__ . '/bloc/footer.php'); ?> <!-- Inclusion du footer -->
</body>

</html>