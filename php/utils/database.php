<?php
if (strtok($_SERVER["REQUEST_URI"], '?') == '/php/utils/database.php') {
    header("location: ./error403.php");
} else { 
	class database
	{
		private static $dbName = 'sanjunipero';
		private static $dbHost = 'db';
		private static $dbUsername = 'root';
		private static $dbUserPassword = 'password';
		/*private static $dbName = 'gdentone';
		private static $dbHost = '127.0.0.1:3306';
		private static $dbUsername = 'gdentone';
		private static $dbUserPassword = 'xach9Ahnohx7aePu';*/
		private static $cont = null;
		private function __construct()
		{
			die('Init function is not allowed');
		}
		public static function connect()
		{
			if (null == self::$cont) {
				try {
					self::$cont = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
				} catch (PDOException $e) {
					die($e->getMessage());
				}
			}
			return self::$cont;
		}
		public static function disconnect()
		{
			self::$cont = null;
		}
	}
}
