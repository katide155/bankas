<?php
session_start(); 
define('BASE_DIR', __DIR__);
include 'includes/functions.php';

if(!isset ($_GET['psl'])){
	$page = "";
}
else{
	$page = $_GET['psl'];
}
  
$datafilelink = 'datafiles/db.json';
if (!file_exists($datafilelink)) {
    $data = fopen($datafilelink, 'a+'); 
} else {
    $data = file_get_contents($datafilelink);
}


?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bankas</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
	<body>
		
			<?php 

				$aktyvi = "active";
				$neakt = '';

//print_r($_SESSION);
				
				if (isset($_SESSION['userId'])) {
					?>
					<div class="container">
					<?php
					//echo "a";
					include "includes/Header.php";
					switch($page) {
						case 'sarasas':
							include "sarasas.php";
						break;
						case 'sukurti':
							include "sukurti.php";
						break;
						case 'pridetilesu':
							include "pridetilesu.php";
						break;
						case 'nuskaiciuoti':
							include "nuskaiciuoti.php";
						break;
						case 'redaguoti':
							include "redaguoti.php";
						break;

					}
					?>
					</div>
					<?php 
				} else {
					//echo "b";
					include "prisijungti.php";
				}
			?>
		
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="js/custom.js"></script>
    </body>
</html>