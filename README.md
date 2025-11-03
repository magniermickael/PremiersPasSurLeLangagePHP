<img alt="Static Badge" src="https://img.shields.io/badge/Projet%20finalis%C3%A9-vert?style=flat&logoColor=vert">

# 🎨 The Artbox – Refonte PHP

## 🧭 Projet 1 – Premiers pas sur le langage PHP

Ce projet a pour objectif de transformer le site **The Artbox**, initialement développé en HTML/CSS statique, en un site **dynamique avec PHP** tout en conservant le visuel d’origine.

### 🎯 Objectif
- Réduire la maintenance du code  
- Centraliser le contenu pour faciliter les mises à jour  
- Découvrir les bases du langage PHP (inclusions, tableaux, boucles, URL dynamiques)

---

## ⚙️ Environnement

- **Serveur local :** XAMPP
- **Éditeur :** Visual Studio Code  
- **Gestion de version :** Git / GitHub  
- **Branche principale :** `main`  
- **Branche développement :** `dev` 
- **Branche de travail :** `refonte-php`

---

## 🧩 Étapes du projet

### 1. Factorisation des blocs communs
But : éviter les répétitions de code.  
Les sections récurrentes (head, header, footer) ont été isolées dans des fichiers partiels.

**Fichiers créés :**
```
bloc/head.php
bloc/header.php
bloc/footer.php
```
**Inclusion dynamique :**
```php
<?php include __DIR__ . '/bloc/head.php'; ?>
<?php include __DIR__ . '/bloc/header.php'; ?>
<?php include __DIR__ . '/bloc/footer.php'; ?>
```

---

### 2. Centralisation des données
Toutes les informations sur les œuvres sont regroupées dans un fichier unique :
```
data/oeuvres.php
```
Chaque œuvre est un tableau associatif contenant :
- id  
- titre  
- artiste  
- image  
- description courte et complète

**Exemple :**
```php
return [
  [
    'id' => 1,
    'titre' => 'Dodomu',
    'artiste' => 'Clark Van Der Beken',
    'image' => 'clark-van-der-beken.png',
    'description' => 'Mia Tozerski',
    'description-complete' => 'Peinture évoquant la souffrance du peuple ukrainien...'
  ]
];
```

---

### 3. Accueil dynamique (`index.php`)
L’affichage des œuvres est automatisé grâce à une boucle `foreach` :
```php
<?php foreach ($oeuvres as $oeuvre): ?>
  <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
    <img src="img/<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    <h2><?= $oeuvre['titre'] ?></h2>
    <p><?= $oeuvre['description'] ?></p>
  </a>
<?php endforeach; ?>
```
➡️ Résultat : une seule modification dans `oeuvres.php` met à jour toute la galerie.

---

### 4. Page détail unique (`oeuvre.php`)
Une seule page gère toutes les œuvres via un paramètre d’URL (`?id=`) :
```php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
foreach ($oeuvres as $item) {
    if ($item['id'] === $id) {
        $oeuvre = $item;
        break;
    }
}
```
En cas d’ID invalide :
```php
http_response_code(404);
echo "Œuvre introuvable";
```

---

## 📁 Structure finale
```
/bloc
  head.php
  header.php
  footer.php
/data
  oeuvres.php
/img
index.php
oeuvre.php
README.md
```
> La structure finale sépare clairement les blocs réutilisables, les données et les pages principales, pour une maintenance simplifiée.

---

## 🔒 Bonnes pratiques et sécurité

| Fonction | Rôle | Exemple |
|-----------|------|----------|
| **`htmlspecialchars()`** | Évite l’exécution de code HTML injecté (protection XSS). | `<?= htmlspecialchars($titre) ?>` |
| **`require_once()`** | Importe un fichier une seule fois. | `require_once(__DIR__.'/data/oeuvres.php');` |
| **`isset()`** | Vérifie l’existence d’une variable. | `isset($_GET['id'])` |
| **`foreach`** | Parcourt un tableau sans connaître sa taille. | `foreach ($oeuvres as $oeuvre)` |
| **`http_response_code()`** | Définit le code HTTP (404, 200, etc.). | `http_response_code(404);` |
| **`nl2br()`** | Conserve les retours à la ligne dans le texte. | `nl2br($description)` |
| **`__DIR__`** | Fournit le chemin absolu du fichier courant. | `__DIR__.'/bloc/header.php'` |

---

## ✅ Bilan du projet

- Code factorisé et plus propre  
- Données centralisées pour un contenu cohérent  
- Maintenance simplifiée (une seule modification = tout le site mis à jour)  
- Sécurité renforcée avec `htmlspecialchars()` et gestion d’erreurs 404  
 
