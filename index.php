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
            <div class="case">
                <a href="index.php?projet=revision" id="revision">Révision</a>
            </div>
            <div class="case">
                <a href="test.php">Test</a>
            </div>
        </div>
        <br>
        <br>
        <br>
        <?php
        $numbers = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
        //var_dump($numbers);

        if (isset($_GET['projet'])) $projet = $_GET['projet'];
        else $projet = "";

        if ($projet == "revision") {

            echo "<form method='GET' action='index.php' id='formulaire'>";

            for ($i = 0; $i < sizeof($numbers); $i++) {
                //var_dump($numbers[$i]);
                echo "<input type='checkbox' name='numbers[]' value='" . $numbers[$i] . "'>" . $numbers[$i] . "<br>";
            }
    
            echo "<input type='submit' name='result' value='Résultat'>";
        }
        if (isset($_GET['numbers'])) $checkboxes = $_GET['numbers'];
        else $checkboxes = "";

        if ($checkboxes) $ctrl = sizeof($checkboxes);
        else $ctrl = "";

        if ($ctrl == 0 && isset($_GET['result'])) {
            echo "Attention vous n'avez pas cochez le bon nombre de cases !!";
            exit;
        } else if (isset($_GET['result'])) {

            echo "Vous avez choisi :<br>";
            foreach ($checkboxes as $valeur) {

                echo "le " . $valeur . ".<br>";
                tablemultiplication($valeur);
            }
        }


        function tablemultiplication($table)
        {
            for ($i = 1; $i < 11; $i++) {
                $result = $i * $table;
                echo "$i * $table = $result<br>";
            }

            echo "<br>";
            echo "<a href=\"test.php?table=" . $table . "\">Test</a>";
        }


        ?>

        <!--<script src="assets/js/app.js"></script>-->
    </body>

    </html>