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
		<?php require("header.php"); ?>


		<br>
		<br>
		<br>
		<?php

		if (isset($_GET['op'])) $op = $_GET['op']; else $op = ""; // pour switch sur : index, test, result

		if (isset($_GET['projet'])) $projet = $_GET['projet'];
		else $projet = "";

		if (isset($_GET['numbers'])) $checkboxes = $_GET['numbers'];
		else $checkboxes = "";

		if ($checkboxes) $ctrl = sizeof($checkboxes);
		else $ctrl = "";

		// if ($projet === "revision") {

		// 	echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

		// 	for ($i = 0; $i < sizeof($numbers); $i++) {
		// 		var_dump($numbers[$i]);
		// 		echo "<input type='checkbox' name='numbers[]' value='" . $numbers[$i] . "'>" . $numbers[$i] . "<br>";
		// 	}

		// 	echo "<input type=\"submit\" name=\"result\" value=\"Résultat\"class =\"resultat\">";
		// }


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

		if (isset($_GET['randomNumber'])) $randomNumber = $_GET['randomNumber'];
		else $randomNumber = "";

		if (isset($_GET['randomNumber1'])) $randomNumber1 = $_GET['randomNumber1'];
		else $randomNumber1 = "";

		if (isset($_GET['result'])) $resultat = $_GET['result'];
		else $resultat = "";

		if (isset($_GET['myNumber'])) $myNumber = $_GET['myNumber'];
		else $myNumber = "";

		if ($projet === "test") {

			$counter = 3;
			$randomNumber = rand(1, 9);
			$randomNumber1 = rand(1, 9);

			$resultat = $randomNumber * $randomNumber1;

			echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

				echo "<input type=\"hidden\" name=\"randomNumber\" value=\"$randomNumber\">";
				echo "<input type=\"hidden\" name=\"randomNumber1\" value=\"$randomNumber1\">";
				echo "<input type=\"number\" name=\"result\" value=\"$randomNumber\"><br>";

				echo "<input type=\"submit\" class =\"resultat\" value=\"Valider\">";
			
			echo "</form>";

			echo "$randomNumber * $randomNumber1 = ?";

			if ($myNumber === $resultat) {

				echo "bravo!!";
			} elseif ($myNumber !== $resultat) {

				$counter--;

				if ($counter === 0) {

					echo "Allez sur Révision";
				}
			}
		}



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
	if (isset($_GET['numbers'])) $numbers = $_GET['numbers']; else $numbers = "";

	echo" --- revision ----<br>";
	echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";


	echo "<input type=\"hidden\" name =\"op\" value=\"revision\">"; 


	for ($i = 1; $i < 10; $i++) 
	{
		//var_dump($numbers[$i]);
		echo "<input type='checkbox' name='numbers[]' value='" . $i . "'>" . $i . "<br>";
	}

	echo "<input type=\"submit\" value=\"valider\" class =\"resultat\"><br><br><br>"; 

	if($numbers)
	{
		foreach ($numbers as $table) 
		{
			echo "le " . $table . ".<br>";
			tablemultiplication($table);
		}
	}

}

function testGlobal()
{
	echo" --- testGlobal ---<br>";

	$aleatoire1 = rand(1, 10);
	$aleatoire2 = rand(1, 10);

	$question = "$aleatoire2 * $aleatoire2";
	echo"Combien font : $question";
}

function testTable()
{
	if (isset($_GET['table'])) $table = $_GET['table']; else $table = "";
	echo" --- testTable ($table) ---<br><br><br>";

	$aleatoire = rand(1, 10);

	$question = "$aleatoire * $table";
	echo"Combien font : $question";

	// Formulaire pour répondre a la question ----> action = result()
	echo "<form method=\"GET\" action=\"index.php\" id=\"formulaire\">";

		echo "<input type=\"hidden\" name =\"op\" value=\"result\">";
		echo "<input type=\"hidden\" name =\"aleatoire\" value=\"$aleatoire\">";
		echo "<input type=\"hidden\" name =\"table\" value=\"$table\">";
		echo "<input type=\"number\" name =\"reponse\">";
		echo "<input type=\"submit\" value =\"valider\">";	

	echo "</form>";
}

function result()
{
	echo" --- result ---<br>";

	if (isset($_GET['table'])) $table = $_GET['table']; else $table = "";
	if (isset($_GET['aleatoire'])) $aleatoire = $_GET['aleatoire']; else $aleatoire = "";
	if (isset($_GET['reponse'])) $reponse = $_GET['reponse']; else $reponse = "";

	$result = $aleatoire * $table;

	if($reponse == $result) echo"Bravo<br>";
	else echo"Perdu<br>";
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


		?>
		<?php
		require("footer.php"); ?>
		<!--<script src="assets/js/app.js"></script>-->
	</body>

	</html>