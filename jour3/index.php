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