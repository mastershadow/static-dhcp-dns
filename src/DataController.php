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


	public static function generate() {
		$db = Flight::db();
		$sth = $db->prepare("SELECT * FROM host ORDER BY domain,hostname");
		$sth->execute();
		$hosts = $sth->fetchAll(PDO::FETCH_ASSOC);
		if (!empty($hosts)) {
			$basedir = null;
			if (substr(OUTDIR, 0, 1) == DIRECTORY_SEPARATOR) {
				$basedir = OUTDIR;
			} else {
				$basedir = realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.OUTDIR);
			}

			$dhcpPath = $basedir . DIRECTORY_SEPARATOR . 'dhcp-static.conf';
			$dnsPath = $basedir . DIRECTORY_SEPARATOR . 'dns-hosts.conf';
			$dhcpFile = fopen($dhcpPath, "w") or die("Unable to open file ". $dhcpPath);
			$dnsFile = fopen($dnsPath, "w") or die("Unable to open file ". $dnsPath);

			foreach ($hosts as $h) {
				// dns
				fwrite($dnsFile, 'local-data: "'.$h['hostname'].'.'.$h['domain'].' A '.$h['ipv4'].'"'.PHP_EOL);
				if ($h['ptr'] == 1) {
					fwrite($dnsFile, 'local-data-ptr: "'.$h['ipv4'].' '.$h['hostname'].'.'.$h['domain'].'"'.PHP_EOL);
				}

				// dhcp
				if ($h['dhcp'] == 1) {
					$hostEntry = 'host '.$h['hostname'].' {'.PHP_EOL;
					$hostEntry .= '    hardware ethernet '.$h['hwaddr'].';'.PHP_EOL;
					$hostEntry .= '    fixed-address '.$h['ipv4'].';'.PHP_EOL;
					$hostEntry .= '    option host-name "'.$h['hostname'].'";'.PHP_EOL;
					$hostEntry .= '}'.PHP_EOL.PHP_EOL;
					fwrite($dhcpFile, $hostEntry);
				}
			}

			fclose($dhcpFile);
			fclose($dnsFile);
			
			Flight::redirect('/');
		}
	}
}
