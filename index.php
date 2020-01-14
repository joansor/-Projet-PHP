
<?php 

    require("header.php");

    if (isset($_GET['op'])) $op = $_GET['op']; else $op = ""; // pour switch sur : index, test, result

    if (isset($_GET['listeTablesacocher'])) $listeTablesacocher = $_GET['listeTablesacocher']; else $listeTablesacocher = "";
    if ($listeTablesacocher) $ctrl = sizeof($listeTablesacocher); else $ctrl = "";

    //if (isset($_GET['ok'])) $ok = $_GET['ok']; else $ok = "";
    if (isset($_GET['nb[]'])) $nb = $_GET['nb']; else $nb = "";
    if (isset($_GET['select'])) $i = $_GET['select']; else $i = "";

    if (isset($_GET['aleatoire'])) $aleatoire = $_GET['aleatoire']; else $aleatoire = "";
    if (isset($_GET['table'])) $table = $_GET['table']; else $table = "";
    if (isset($_GET['reponse'])) $reponse = $_GET['reponse']; else $reponse = "";

    function index()
    {
        echo" --- index ----<br>";

        echo"<div id=\"container\">

            <div class=\"case\" id=\"case0\">

                <a href=\"index.php?op=revision\" id=\"revision\" id=\"revision\">Révision</a>

            </div>

            <div class=\"case\" id=\"case1\">

                <a href=\"index.php?op=testGlobal\" id=\"test\">Test</a>

            </div>

        </div>";
    }

    function revision()
    {
        global $listeTablesacocher, $resultat, $ctrl;

        echo" --- revision ----<br>";

        echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

            echo "<input type=\"hidden\" name =\"op\" value=\"revision\">"; 

            for ($i = 1; $i < 10; $i++) 
            {
                
                if (in_array($i, $listeTablesacocher)) $checked = "checked"; else $checked = "";

                echo "<input type='checkbox' name='listeTablesacocher[]' value='" . $i . "' $checked>Table de " . $i . "<br>";
            }

            echo "<input type=\"submit\" value=\"valider\" class =\"resultat\"><br><br><br>"; 

        echo"</form>";

        if($listeTablesacocher)
        {
            foreach ($listeTablesacocher as $table) 
            {
                echo "le " . $table . ".<br>";
                tablemultiplication($table);
            }
        }
        
        if ($ctrl == 0 && $resultat) 
        {
            echo "Merci de sélectionner une table de multiplication !!";
        } 
        else if ($resultat) 
        {
            echo "Vous avez choisi :<br>";
            foreach ($listeTablesacocher as $valeur) 
            {
                echo "le " . $valeur . ".<br>";
                tablemultiplication($valeur);
            }
        }
    }

    function testGlobal()
    {   
        global $i;

        echo" --- testGlobal ---<br>";

        $aleatoire = rand(1, 10); // génere un nombre aléatoire entre 1 et 10
        $table = rand(1, 10); // génere un nombre aléatoire entre 1 et 10 (table de multiplication)

        $question = "$aleatoire * $table"; // Génere la Question
        echo"Combien font : $question"; // Affiche la Question

        echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

            echo "<input type=\"hidden\" name=\"op\" value=\"result\">";
            echo "<input type=\"hidden\" name=\"aleatoire\" value=\"$aleatoire\">";
            echo "<input type=\"hidden\" name=\"table\" value=\"$table\">";
            echo "<input type=\"number\" name =\"reponse\"required>";
            echo "<input type=\"submit\" class =\"resultat\" value=\"Valider\">";
           
        echo "</form>";

        //deuxieme formulaire pour le selecteur
        echo "<form method=\"GET\" action=\"index.php?\" id=\"formulaire\">";

        echo"<select onchange=\"this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);\">\n"; // Selecteur de tables de multiplications;
        //On boucle sur les 10 table de multiplication
       for ($i = 1; $i < 11; $i++)
       {

       echo "<option value=\"index.php?op=testTable&table=" . $table[$i]." $i \" name=\"select\">$i</option>";
       } 
       //echo "<input type=\"submit\"name=\"ok\" class =\"resultat\" value=\"ok\">";
       echo "</select>";
       echo "</form>";
    }

    function testTable()
    {
        global $table;

        echo" --- testTable ($table) ---<br><br><br>";

        $aleatoire = rand(1, 10);

        $question = "$aleatoire * $table";
        echo"Combien font : $question";

        // Formulaire pour répondre a la question ----> action = result()
        echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

            echo "<input type=\"hidden\" name =\"op\" value=\"result\">";
            echo "<input type=\"hidden\" name =\"aleatoire\" value=\"$aleatoire\">";
            echo "<input type=\"hidden\" name =\"table\" value=\"$table\">";
            echo "<input type=\"number\" name =\"reponse\" required>";
            echo "<input type=\"submit\" value =\"valider\">";
        
           

            echo "</form>";
    }

    function result()
    {
        global $aleatoire, $table, $reponse;

        echo" --- result ---<br>";

        $result = $aleatoire * $table;

        if($reponse == $result) echo"Bravo  $aleatoire * $table font bien $result<br>";
        else echo"Perdu,  $aleatoire * $table font $result et non pas $reponse --> <a href=\"index.php?op=revision&listeTablesacocher%5B%5D=$table\">Vas reviser la table de $table</a><br>";
    }

    function tablemultiplication($table)
    {
        for ($i = 1; $i < 10; $i++) 
        {
            echo "$i * $table = ". $i * $table ."<br>";
        }

        echo "<br><a href=\"index.php?op=testTable&table=" . $table . " \"id=\"test1\">Test</a><br><br><br><br>";
    }

    switch ($op)
    {
        case"index":
        index();
        break;

        case"revision":
        revision();
        break;

        case"testGlobal":
        testGlobal();
        break;

        case"testTable":
        testTable();
        break;

        case"result":
        result();
        break;

        default:
        index();
        break;
    }

    require("footer.php"); 
?>

