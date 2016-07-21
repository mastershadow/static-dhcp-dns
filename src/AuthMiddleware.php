<?php
class AuthMiddleware {

	static function verify() {
		session_start();
  		$headers = apache_request_headers();
 		$request = Flight::request();

 		if (empty($_SESSION['uid'])) {
	    	$username = @$_SERVER['PHP_AUTH_USER'];
	 		$pass = @$_SERVER['PHP_AUTH_PW'];
	    	if (empty($username) || empty($pass)) {
				header('WWW-Authenticate: Basic realm="Static DHCP DNS"');
	 			Flight::halt(401, 'Unauthenticated.');
	 		} else {
	  			$db = Flight::db();

	  			$sth = $db->prepare("SELECT id FROM user WHERE username = :username AND password = :password");
	  			$sth->execute(array('username' => $username, 'password' => md5($pass)));
	  			$user = $sth->fetch(PDO::FETCH_ASSOC);
	  			if (!empty($user)) {
	  				$_SESSION['uid'] = $user['id'];
	  			} else {
	 				Flight::halt(401, 'Unauthenticated.');
	  			}
	 		}
 		}
	}

	static function logout() {
		session_start();
		unset($_SESSION['uid']);
	}
}