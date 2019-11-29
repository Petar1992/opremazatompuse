<?php

	class Kategorija extends ActiveRecord {
		public $naziv;
		public $opis;
		public $info;
		
		
		public static $table = "kategorije";
		public static $key = "id";
		
	}