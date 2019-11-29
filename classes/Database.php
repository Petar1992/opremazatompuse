<?php


	class Database {


		private static $conn = null;

		public static function getInstance(){

			if(!isset(self::$conn)){
				try{

					self::$conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASS);

				}

				catch(PDOException $e){
					$err = $e->getMessage();
					
					echo $err;
					die();
				}
			}

		return self::$conn;
		
		}
	}