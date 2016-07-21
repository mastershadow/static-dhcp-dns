<?php
require_once 'AuthMiddleware.php';

class BaseController {

	public static function auth() {
		AuthMiddleware::verify();
	}
	
}