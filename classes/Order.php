<?php


	class Order extends ActiveRecord {

		public $ime;
		public $email;
		public $mobilni;
		public $adresa;
		public $proizvodi;
		public $poruka;

		public static $table = "orders";
		public static $key = "id";
	}