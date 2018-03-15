<?php
class PDOFactory 
{
	protected static $instance;

	public static function getMysqlConnexion($db_name) 
	{
		if (!(self::$instance instanceof PDO)) {
			if (is_string($db_name)) {
				global $host_db;
				global $login_db;
				global $password_db;
				try {
				   $db = new PDO('mysql:host='.$host_db.';dbname='.$db_name, $login_db, $password_db);
				} catch (Exception $e) {
				   die("<p>Une erreur est survenu! <br/>Veuillez nous communiquer cette erreur.<br/>Merci ");
				}
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance = $db;
				return $db;
			} else {
				throw new Exception('invalid db_name'); die();
			}
		} else {
			return self::$instance;
		}
	}
}