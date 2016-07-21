<?php
require_once 'BaseController.php';

class DataController extends BaseController {

	public static function form($id = null) {
		self::auth();
		$host = null;
		if ($id != null) {
			$db = Flight::db();
			$sth = $db->prepare("SELECT * FROM host WHERE id = :id");
			$sth->execute(array('id' => $id));
			$host = $sth->fetch(PDO::FETCH_ASSOC);
		}
		Flight::render('form.php', array('host' => $host));
	}

	public static function save() {
		$data = Flight::request()->data;
		$db = Flight::db();
		$params = [];
		$sth = null;

		if (!empty($data->id)) {
			$params['id'] = $data->id;
			$sth = $db->prepare("UPDATE host SET hostname = :hostname,  domain = :domain,  ipv4 = :ipv4,  ptr = :ptr,  dhcp = :dhcp,  hwaddr = :hwaddr WHERE id = :id");
		} else {
			$sth = $db->prepare("INSERT INTO host (hostname, domain, ipv4, ptr, dhcp, hwaddr) VALUES (:hostname, :domain, :ipv4, :ptr, :dhcp, :hwaddr)");
		}
		$params['hostname'] = $data->hostname;
		$params['domain'] = $data->domain;
		$params['ipv4'] = $data->ipv4;
		$params['ptr'] = $data->ptr;
		$params['dhcp'] = $data->dhcp;
		$params['hwaddr'] = $data->hwaddr;

		if ($sth->execute($params)) {
			Flight::redirect('/');
		}
	}


	public static function delete($id) {
		$db = Flight::db();
		$sth = $db->prepare("DELETE FROM host WHERE id = :id");
		if ($sth->execute(array('id' => $id))) {
			Flight::redirect('/');
		}
	}
}