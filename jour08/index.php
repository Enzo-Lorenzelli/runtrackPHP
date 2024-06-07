<!--job 1-->
<?php
session_start();
if (isset($_SESSION["nbVisites"])) {
    $_SESSION["nbVisites"]++;
} else {
    $_SESSION["nbVisites"] = 1;
}
if (isset($_POST["reset"])) {
    $_SESSION["nbVisites"] = 0;
}
echo "Nombre de visites : " . $_SESSION["nbVisites"];
?>
<form method="post">
    <input type="submit" name="reset" value="Réinitialiser le compteur">
</form>

<!--job 2-->


<!DOCTYPE html>
<html>
<head>
    <title>Compteur de visites</title>
</head>
<body>
<?php
// Vérifier si le bouton "reset" a été cliqué
if (isset($_GET['reset'])) {
    setcookie('nbVisites', 0, time() - 3600, '/'); // Expirer le cookie
    $nbVisites = 0; // Réinitialiser le compteur
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// Vérifier si le cookie existe
if (isset($_COOKIE['nbVisites'])) {
    $nbVisites = $_COOKIE['nbVisites'];
} else {
    $nbVisites = 0;
}

// Incrémenter le compteur
$nbVisites++;

// Définir le cookie avec la nouvelle valeur
setcookie('nbVisites', $nbVisites, time() + (86400 * 30), '/'); // Expire dans 30 jours

// Afficher le contenu du cookie
echo "Nombre de visites: " . $nbVisites . "<br>";
?>

<form method="get">
    <input type="submit" name="reset" value="Reset">
</form>
</body>
</html>


<!--job 3-->

<?php

// Réinitialisation de la liste si le paramètre 'reset_liste' est présent dans l'URL
if (isset($_GET['reset_liste'])) {
    unset($_SESSION['prenoms']);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

if (!isset($_SESSION['prenoms'])) {
    $_SESSION['prenoms'] = [];
}

$prenom = '';
if (isset($_POST['prenom'])) {
    $prenom = trim($_POST['prenom']);
    if (!empty($prenom)) {
        $_SESSION['prenoms'][] = $prenom;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Saisie des prénoms</title>
</head>
<body>
<h1>Saisie des prénoms</h1>
<form action="" method="post">
    <input type="text" name="prenom" value="Prénom" onclick="this.value='';" />
    <input type="submit" />
</form>
<?php
if (isset($_SESSION['prenoms']) && count($_SESSION['prenoms']) > 0) {
    echo "<ul>";
    foreach ($_SESSION['prenoms'] as $prenom) {
        echo "<li>$prenom</li>";
    }
    echo "</ul>";
} else {
    echo "La liste est vide.";
}

if (isset($_SESSION['prenoms']) && count($_SESSION['prenoms']) > 0) {
    echo "<a href='?reset_liste=true'>Réinitialiser la liste</a>";
}

?>
</body>
</html>

<!--job 4-->

<?php


// Vérification si le prénom est déjà stocké dans un cookie
if (isset($_COOKIE['prenom'])) {
    $prenom = $_COOKIE['prenom'];
    echo "Bonjour $prenom !";
    // Bouton de déconnexion
    echo '<form method="post">';
    echo '<input type="submit" name="deco" value="Déconnexion">';
    echo '</form>';
} else {
    // Formulaire de connexion
    if (isset($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
        setcookie('prenom', $prenom, time() + (86400 * 30), '/');
        header("Refresh:0");
    }
    echo '<form method="post">';
    echo '<input type="text" name="prenom" placeholder="Prénom" required>';
    echo '<input type="submit" name="connexion" value="Connexion">';
    echo '</form>';
}

// Déconnexion
if (isset($_POST['deco'])) {
    setcookie('prenom', '', time() - 3600, '/');
    header("Refresh:0");
}
?>



<!--job 5-->



<?php


// Initialisation de la grille de jeu
if (!isset($_SESSION['grille'])) {
    $_SESSION['grille'] = array_fill(0, 9, '-');
    $_SESSION['joueur'] = 'X';
    $_SESSION['gagnant'] = '';
}

// Traitement des coups joués
if (isset($_POST['case'])) {
    $case = $_POST['case'];
    if ($_SESSION['grille'][$case] == '-') {
        $_SESSION['grille'][$case] = $_SESSION['joueur'];
        $_SESSION['joueur'] = ($_SESSION['joueur'] == 'X') ? 'O' : 'X';
        verifierGagnant();
    }
}

// Réinitialisation de la partie
if (isset($_POST['reinitialiser'])) {
    $_SESSION['grille'] = array_fill(0, 9, '-');
    $_SESSION['joueur'] = 'X';
    $_SESSION['gagnant'] = '';
}

// Fonction pour vérifier si un joueur a gagné
function verifierGagnant() {
    $grille = $_SESSION['grille'];
    $combinaisons = array(
        array(0, 1, 2), array(3, 4, 5), array(6, 7, 8), // Lignes
        array(0, 3, 6), array(1, 4, 7), array(2, 5, 8), // Colonnes
        array(0, 4, 8), array(2, 4, 6) // Diagonales
    );

    foreach ($combinaisons as $combo) {
        if ($grille[$combo[0]] != '-' && $grille[$combo[0]] == $grille[$combo[1]] && $grille[$combo[1]] == $grille[$combo[2]]) {
            $_SESSION['gagnant'] = $grille[$combo[0]];
            break;
        }
    }

    // Vérifier si toutes les cases sont remplies sans gagnant
    if (empty($_SESSION['gagnant']) && !in_array('-', $grille)) {
        $_SESSION['gagnant'] = 'Match nul';
    }
}

// Affichage de la grille de jeu
echo '<table>';
for ($i = 0; $i < 3; $i++) {
    echo '<tr>';
    for ($j = 0; $j < 3; $j++) {
        $case = $i * 3 + $j;
        echo '<td>';
        echo '<form method="post">';
        echo '<input type="submit" name="case" value="' . $_SESSION['grille'][$case] . '" style="width: 50px; height: 50px; font-size: 24px;">';
        echo '<input type="hidden" name="case" value="' . $case . '">';
        echo '</form>';
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';

// Affichage du gagnant ou réinitialisation de la partie
if (!empty($_SESSION['gagnant'])) {
    echo '<h3>' . $_SESSION['gagnant'] . ' a gagné !</h3>';
    echo '<form method="post">';
    echo '<input type="submit" name="reinitialiser" value="Réinitialiser la partie">';
    echo '</form>';
    $_SESSION['grille'] = array_fill(0, 9, '-');
    $_SESSION['joueur'] = 'X';
    $_SESSION['gagnant'] = '';
} else {
    echo '<form method="post">';
    echo '<input type="submit" name="reinitialiser" value="Réinitialiser la partie">';
    echo '</form>';
}
?>