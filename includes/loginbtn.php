<?php
$username = '';
$textToUser = null;
$link_to_log = '/index.php?psl=prisijungti';
$buttonTitle = "Prisijungti";
if( isset($_SESSION['userId']) ){
	$username = $_SESSION['username'];
	$userlogin = $_SESSION['login'];
	$textToUser = "Prisijungęs vartotojas - $username ($userlogin)";
	$link_to_log = './includes/logout.php';
	$buttonTitle = "Atsijungti";
}
?>

<ul class="navbar-nav justify-content-end">
  <li class="nav-item">
     <a class="nav-link disabled" style="color:rgba(255,255,255,.55);"><?php echo $textToUser; ?></a>
  </li>
  <li class="nav-item">
	<form class="d-flex" action="<?php echo $link_to_log; ?>">
		<button class="btn btn-outline-success" type="submit"><?php echo $buttonTitle; ?></button>
	</form>
  </li>
</ul>





