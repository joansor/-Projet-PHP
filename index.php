
<?php 

    require("header.php");

    if (isset($_GET['op'])) $op = $_GET['op']; else $op = ""; // pour switch sur : index, test, result

    if (isset($_GET['listeTablesaCocher[]'])) $listeTablesaCocher = $_GET['listeTablesaCocher[]']; else $listeTablesaCocher = [];
    if ($listeTablesaCocher) $ctrl = ($listeTablesaCocher); else $ctrl = "";

    //if (isset($_GET['ok'])) $ok = $_GET['ok']; else $ok = "";
    if (isset($_GET['nb[]'])) $nb = $_GET['nb']; else $nb = "";
    if (isset($_GET['select'])) $i = $_GET['select']; else $i = "";

    if (isset($_GET['aleatoire'])) $aleatoire = $_GET['aleatoire']; else $aleatoire = "";
    if (isset($_GET['table'])) $table = $_GET['table']; else $table = "";
    if (isset($_GET['reponse'])) $reponse = $_GET['reponse']; else $reponse = "";
    echo "<main>";

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
        global $listeTablesaCocher, $resultat, $ctrl;
        
        
        echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

            echo "<input type=\"hidden\" name =\"op\" value=\"revision\">"; 

            for ($i = 1; $i < 10; $i++) 
            {
                
                if (in_array($i, $listeTablesaCocher)) $checked = "checked"; else $checked = "";
                //var_dump($i,$listeTablesaCocher);
                
                echo "<input type='checkbox' name='listeTablesaCocher[]' value=" . $i . " $checked><p>Table de " . $i . "<br></p>";
                
            }

            echo "<input type=\"submit\" value=\"valider\" class =\"resultat\"><br><br><br>"; 

        echo"</form>";
        
        if($listeTablesaCocher)
        {
            foreach ($listeTablesaCocher as $table) 
            {
                echo "<p>le " . $table . ".<br></p>";
                tablemultiplication($table);
            }
        }
        
        if ($ctrl == 0 && $resultat) 
        {
          
            echo "<p>Merci de sélectionner une table de multiplication !!</p>";
            
        } 
        else if ($resultat) 
        {
            
            echo "<p>Vous avez choisi :<br></p>";
            
            foreach ($listeTablesaCocher as $valeur) 
            {
                
                echo "<p>le " . $valeur . ".<br></p>";
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

        echo"<p>Combien font : $question</p>"; // Affiche la Question

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
       for ($j = 1; $j < 11; $j++)
       {

       echo "<option value=\"index.php?op=testTable&table=" . $table[$j]." $j \" name=\"select\">$j</option>";
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
        echo"<p>Combien font : $question</p>";

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

        if($reponse == $result) echo"<p>Bravo  $aleatoire * $table font bien $result<br></p>";
        else echo"<p>Perdu,  $aleatoire * $table font $result et non pas $reponse --> <a href=\"index.php?op=revision&listeTablesaCocher%5B%5D=$table\">Vas reviser la table de $table</a><br></p>";
    }

    function tablemultiplication($table)
    {
        for ($i = 1; $i < 10; $i++) 
        {
            echo "<p id=\"text\">$i * $table = ". $i * $table ."<br></p>";
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
    echo "</main>";
    require("footer.php"); 
?>

