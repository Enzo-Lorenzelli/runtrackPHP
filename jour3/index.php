    <?php

    // Job 01
    function hello() {
        echo "Hello LaPlateforme!<br>";
    }
    hello();

    // Job 02
    function bonjour($jour) {
        if ($jour) {
            echo "Bonjour";
        } else {
            echo "Bonsoir<br>";
        }
    }
    bonjour(true);
    bonjour(false);

    // Job 03
    function getHello() {
        return "Hello LaPlateforme!";
    }
    $message = getHello();
    echo $message . "<br>";

    ?>


    <!-- job4 -->

    <?php

    function calcule($nombre1, $operateur, $nombre2) {
        switch($operateur) {
            case '+':
                $resultat = $nombre1 + $nombre2;
                break;
            case '-':
                $resultat = $nombre1 - $nombre2;
                break;
            case '*':
                $resultat = $nombre1 * $nombre2;
                break;
            case '/':
                if($nombre2 == 0) {
                    $resultat = "Erreur : division par zéro";
                } else {
                    $resultat = $nombre1 / $nombre2;
                }
                break;
            case '%':
                $resultat = $nombre1 % $nombre2;
                break;
            default:
                $resultat = "Erreur : opérateur inconnu";
                break;
        }
        return $resultat;
    }

    $nombre1 = 10;
    $nombre2 = 3;
    $operateur = '*';

    $resultat = calcule($nombre1, $operateur, $nombre2);

    echo "Le résultat de l'opération $nombre1 $operateur $nombre2 est : $resultat <br>";

    ?>

    <!-- job5 -->

    <?php
    function occurrences($str, $char) {
        $compteur = 0;
        for($i = 0; $i < strlen($str); $i++) {
            if($str[$i] == $char) {
                $compteur++;
            }
        }
        
        return $compteur;
    }

    $str = "Bonjour tout le monde";
    $char = "o";

    $nombre_occurrences = occurrences($str, $char);

    echo "Le nombre d'occurrences de la lettre '$char' dans la chaîne '$str' est de $nombre_occurrences. <br>";

    ?>

    <!-- job6 -->

    <?php

    function leetSpeak($str) {
        // Remplacer les lettres majuscules
        $str = str_replace("A", "4", $str);
        $str = str_replace("B", "8", $str);
        $str = str_replace("E", "3", $str);
        $str = str_replace("G", "6", $str);
        $str = str_replace("L", "1", $str);
        $str = str_replace("S", "5", $str);
        $str = str_replace("T", "7", $str);

        // Remplacer les lettres minuscules
        $str = str_replace("a", "4", $str);
        $str = str_replace("b", "8", $str);
        $str = str_replace("e", "3", $str);
        $str = str_replace("g", "6", $str);
        $str = str_replace("l", "1", $str);
        $str = str_replace("s", "5", $str);
        $str = str_replace("t", "7", $str);

        return $str;
    }

    $str_leet_speak = leetSpeak($str);

    echo "La chaîne '$str' convertie en leet speak est : $str_leet_speak";

    ?>

    <!-- job7 -->

<!DOCTYPE html>
<html>
<head>
  <title>Transformations de chaînes</title>
  <style>
    .bold {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <form method="post">
    <label for="str">Chaîne de caractères :</label>
    <input type="text" id="str" name="str" required>
    <br>
    <label for="fonction">Fonction :</label>
    <select id="fonction" name="fonction">
      <option value="gras">Gras</option>
      <option value="cesar">César</option>
      <option value="plateforme">Plateforme</option>
    </select>
    <br>
    <button type="submit">Appliquer</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $str = $_POST["str"];
    $fonction = $_POST["fonction"];

    switch ($fonction) {
      case "gras":
        $result = gras($str);
        break;
      case "cesar":
        $result = cesar($str, 2);
        break;
      case "plateforme":
        $result = plateforme($str);
        break;
      default:
        $result = "";
    }

    echo "<p>Résultat : $result</p>";
  }

  function gras($str) {
    $words = explode(" ", $str);
    $boldWords = array_map(function ($word) {
      if (preg_match('/^[A-Z]/', $word)) {
        return "<span class='bold'>$word</span>";
      }
      return $word;
    }, $words);
    return implode(" ", $boldWords);
  }

  function cesar($str, $shift = 2) {
    $result = "";
    for ($i = 0; $i < strlen($str); $i++) {
      $charCode = ord($str[$i]);
      if ($charCode >= 65 && $charCode <= 90) {
        $result .= chr((($charCode - 65 + $shift) % 26) + 65);
      } elseif ($charCode >= 97 && $charCode <= 122) {
        $result .= chr((($charCode - 97 + $shift) % 26) + 97);
      } else {
        $result .= $str[$i];
      }
    }
    return $result;
  }

  function plateforme($str) {
    $words = explode(" ", $str);
    $transformedWords = array_map(function ($word) {
      if (preg_match('/me$/', $word)) {
        return "$word\_";
      }
      return $word;
    }, $words);
    return implode(" ", $transformedWords);
  }
  ?>
</body>
</html>

    <!-- job 4.2 -->

<?php
// Fonction pour créer un nouveau produit
function createProduct($name, $price, $quantity) {
    $product = [
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity
    ];

    if ($price > 100) {
        $product['discountedPrice'] = $price * 0.9; // Réduction de 10%
    } else {
        $product['discountedPrice'] = $price;
    }

    return $product;
}

// Fonction pour afficher un produit
function displayProduct($product) {
    $output = "<div>";
    $output .= "<h3>{$product['name']}</h3>";
    $output .= "<p>Prix: {$product['price']}€</p>";
    if (isset($product['discountedPrice'])) {
        $output .= "<p>Prix après réduction: {$product['discountedPrice']}€</p>";
    }
    $output .= "<p>Quantité: {$product['quantity']}</p>";
    $output .= "</div>";

    return $output;
}

// Création d'un tableau de produits
$products = [
    createProduct('Produit A', 80, 5),
    createProduct('Produit B', 120, 3),
    createProduct('Produit C', 95, 8),
    createProduct('Produit D', 150, 2)
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste de produits</title>
    <style>
        div {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Liste de produits</h1>
    <?php
    // Affichage de chaque produit
    foreach ($products as $product) {
        echo displayProduct($product);
    }
    ?>
</body>
</html>

<!--- job 1.2  --->

<?php
// ------------------------ Job 01 ------------------------

$variable1 = "LaPlateforme";
echo $variable1 . "<br>";

$variable2 = "Vive";
$variable3 = "!";
echo $variable2 . " " . $variable1 . " " . $variable3 . "<br>";

$variable4 = 6;
echo $variable4 . "<br>";
$variable4 += 4;
echo $variable4 . "<br>";

$variable5 = true;
echo $variable5 . "<br>";
$variable5 = false;
echo $variable5 . "<br>";

// ------------------------ Job 02 ------------------------

echo "Hello all !<br>";
// Commentaire sur une ligne
/* Commentaire
   sur plusieurs
   lignes */
echo "Hello all !<br>";

// ------------------------ Job 03 ------------------------

$int = 42;
$bool = true;
$str = "LaPlateforme";
$float = 3.14;

echo "<table>
        <tr>
            <th>Type</th>
            <th>Nom</th>
            <th>Valeur</th>
        </tr>
        <tr>
            <td>Integer</td>
            <td>int</td>
            <td>$int</td>
        </tr>
        <tr>
            <td>Boolean</td>
            <td>bool</td>
            <td>$bool</td>
        </tr>
        <tr>
            <td>String</td>
            <td>str</td>
            <td>$str</td>
        </tr>
        <tr>
            <td>Float</td>
            <td>float</td>
            <td>$float</td>
        </tr>
      </table>";

// ------------------------ Job 04 ------------------------

for ($i = 0; $i <= 50; $i++) {
    if ($i == 42) {
        echo "<b><u>$i</u></b><br>";
    } else {
        echo $i . "<br>";
    }
}

// ------------------------ Job 05 ------------------------

for ($i = 0; $i <= 120; $i++) {
    if ($i != 26 && $i != 37 && $i != 88 && $i != 111) {
        echo $i . "<br>";
    }
}

// ------------------------ Job 06 ------------------------

for ($i = 0; $i <= 100; $i++) {
    if ($i == 42) {
        echo "La Plateforme_<br>";
    } elseif ($i >= 0 && $i <= 20) {
        echo "<i>$i</i><br>";
    } elseif ($i >= 25 && $i <= 50) {
        echo "<u>$i</u><br>";
    } else {
        echo $i . "<br>";
    }
}

// ------------------------ Job 07 ------------------------

for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz<br>";
    } elseif ($i % 3 == 0) {
        echo "Fizz<br>";
    } elseif ($i % 5 == 0) {
        echo "Buzz<br>";
    } else {
        echo $i . "<br>";
    }
}

?>

<!------------------JOB 2.2 Job 01 -->

<form method="get">
    <input type="text" name="param1" value="Valeur 1">
    <input type="text" name="param2" value="Valeur 2">
    <input type="submit" value="Envoyer">
</form>

<?php
// Affiche le nombre d'arguments $_GET
echo "Nombre d'arguments GET : " . count($_GET) . "<br>";
?>

<!-- Job 02 -->
<table>
    <tr>
        <th>Argument</th>
        <th>Valeur</th>
    </tr>
    <?php
    // Affiche les arguments $_GET dans un tableau HTML
    foreach ($_GET as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    ?>
</table>

<!-- Job 03 -->
<form method="post">
    <input type="text" name="param1" value="Valeur 1">
    <input type="text" name="param2" value="Valeur 2">
    <input type="submit" value="Envoyer">
</form>

<?php
// Affiche le nombre d'arguments $_POST
echo "Nombre d'arguments POST : " . count($_POST) . "<br>";
?>

<!-- Job 04 -->
<table>
    <tr>
        <th>Argument</th>
        <th>Valeur</th>
    </tr>
    <?php
    // Affiche les arguments $_POST dans un tableau HTML
    foreach ($_POST as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    ?>
</table>

<!-- Job 05 -->
<form method="post">
    <label for="username">Username :</label>
    <input type="text" name="username" id="username"><br>

    <label for="password">Password :</label>
    <input type="password" name="password" id="password"><br>

    <input type="submit" value="Se connecter">
</form>

<?php
// Vérifie les identifiants après validation du formulaire
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === 'John' && $_POST['password'] === 'Rambo') {
        echo "Ce n'est pas ma guerre";
    } else {
        echo "Votre pire cauchemar";
    }
}
?>

<!-- Job 06 -->
<form method="get">
    <label for="nombre">Entrez un nombre :</label>
    <input type="number" name="nombre" id="nombre">
    <input type="submit" value="Valider">
</form>

<?php
// Vérifie si le nombre est pair ou impair
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    if ($nombre % 2 == 0) {
        echo "Nombre pair";
    } else {
        echo "Nombre impair";
    }
}
?>

<!-- Job 07 -->
<form method="get">
    <label for="largeur">Largeur :</label>
    <input type="number" name="largeur" id="largeur">
    <label for="hauteur">Hauteur :</label>
    <input type="number" name="hauteur" id="hauteur">
    <input type="submit" value="Dessiner">
</form>

<?php
// Affiche la maison en fonction de la largeur et la hauteur
if (isset($_GET['largeur']) && isset($_GET['hauteur'])) {
    $largeur = $_GET['largeur'];
    $hauteur = $_GET['hauteur'];

    // Toit
    for ($i = 0; $i < $hauteur; $i++) {
        echo str_repeat('&nbsp;', $largeur - $i - 1);
        echo str_repeat('/\\', $i * 2 + 1);
        echo "<br>";
    }

    // Corps
    for ($i = 0; $i < $hauteur; $i++) {
        echo str_repeat('|', 1);
        echo str_repeat('&nbsp;', $largeur - 2);
        echo str_repeat('|', 1);
        echo "<br>";
    }

    // Base
    echo str_repeat('_', $largeur);
}
?>