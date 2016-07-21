<?php
require_once 'BaseController.php';

class InitController extends BaseController {

	public static function index() {
		self::auth();

		$db = Flight::db();
		$sth = $db->prepare("SELECT * FROM host ORDER BY domain, hostname");
		$sth->execute();
		$hosts = $sth->fetchAll(PDO::FETCH_ASSOC);
		Flight::render('init.php', array('hosts' => $hosts));
	}

	public static function logout() {
		AuthMiddleware::logout();
		Flight::redirect('/');
	}
}