    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>projet calculette</title>
    </head>

    <body>

        <div id="container">
            <div class="case" id="case0">
                <a href="index.php?projet=revision" id="revision">Révision</a>
            </div>
            <div class="case"id="case1">
                <a href="index.php?projet=test" id="test">Test</a>
            </div>
        </div>
        <br>
        <br>
        <br>
        <?php

        if (isset($_GET['table'])) $table = $_GET['table'];
        else $table = "";


        if ($table) {
            $rand = rand(1, 9);
            echo "--- combien font : = $rand * $table ---";
            $resultat = $rand * $table;


            echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

            echo "<input type=\"hidden\" name=\"rand\" value=\"$rand\">";

            echo "<input type=\"hidden\" name=\"table\" value=\"$table\">";

            echo "<input type=\"myNumber\" name=\"myNumber\"<br>";

            echo "<input type=\"hidden\" name=\"number\" value=\"result\"<br>";

            echo "<input type=\"submit\" name=\"result\"class= \"resultat\" value=\"Résultat\">";

            echo "</form>";

        }

        if (isset($_GET['result'])) $resultat = $_GET['result'];
        else $resultat = "";
       
        if (isset($_GET['number'])) $number = $_GET['number'];
        else $number = "";

        if (isset($_GET['myNumber'])) $myNumber = $_GET['myNumber'];
        else $myNumber = "";

        if ($number === $myNumber ) {

            echo "Bravo!";
        } else {
            echo "<a href=\index.php?projet=revision\">Révision</a>";
        }

        ?>

        <!--<script src="assets/js/app.js"></script>-->
    </body>

    </html>