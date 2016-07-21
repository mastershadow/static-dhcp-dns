<?php
require '../vendor/autoload.php';

require_once __DIR__.'/config.php';
require_once __DIR__.'/src/InitController.php';
require_once __DIR__.'/src/DataController.php';

class Bootstrap {

	public static function boot() {

		Flight::set('flight.views.path', __DIR__.'/views');

		Flight::register('db', 'PDO', array(DB_DSN, DB_USER, DB_PASS),
			function($db) {
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		);

		Flight::route('/',  array('InitController', 'index'));
		Flight::route('/logout',  array('InitController', 'logout'));
		Flight::route('/data/form(/@id)',  array('DataController', 'form'));
		Flight::route('POST /data/save',  array('DataController', 'save'));
		Flight::route('/data/delete/@id',  array('DataController', 'delete'));
		Flight::start();
	}
}