<?php
if (session_id() == '') session_start();

$adminfilelink = 'datafiles/admin.json';
if (!file_exists($adminfilelink)) {
    $admindata = fopen($adminfilelink, 'a+');
} else {
    $admindata = file_get_contents($adminfilelink);
}

/*
$admin = [
	'id' => 1,
	'username' => 'Adminas',
    'login' => 'admin@php.lt',
    'password' => md5('admin')
];
file_put_contents( $adminfilelink, json_encode($admin));
*/

$admin = json_decode($admindata, true);

if (isset($_POST['prisijungti']) && !isset($_SESSION['userId'])) {
	
	if( isset($_POST['login']) && filter_var($_POST['login'], FILTER_VALIDATE_EMAIL) ) {
		
		if( $_POST['login'] == $admin['login'] ) {
		
			if( isset($_POST['password']) AND md5($_POST['password']) == $admin['password'] ) {

				$_SESSION['userId'] = $admin['id'];
				$_SESSION['username'] = $admin['username'];
				$_SESSION['login'] = $admin['login'];
				header('Location: ./index.php?psl=sarasas');
			
			}
			else{
				
				header('Location: ./index.php?psl=prisijungti&status=2&message=8');
				
			}
			
		}else{
			
			header('Location: ./index.php?psl=prisijungti&status=2&message=7');
			
		}
	}	
	else {
		
		header('Location: ./index.php?psl=prisijungti&status=2&message=6');
		
	}
	
} else {
	
	session_destroy();
	header("Location: ./index.php?psl=prisijungti");
	
}


