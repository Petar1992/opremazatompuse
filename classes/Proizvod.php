<?php

	class Proizvod extends ActiveRecord {
		public $naziv;
		public $opis;
		public $info;
		public $cena;
		public $slika_v;
		public $kategorija;
		public $istaknut;
		public $akcija;
		public $najnoviji;
		
		
		public static $table = "proizvodi";
		public static $key = "id";

	}