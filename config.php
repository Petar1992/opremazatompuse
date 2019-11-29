<?php

	// Definisane konstante
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "opremazatompuse");
	define("SECURE", FALSE);
	require_once 'library/php-activerecord/ActiveRecord.php';

 		ActiveRecord\Config::initialize(function($cfg) {
     		$cfg->set_model_directory('models');
    		$cfg->set_connections(array(
         'development' => 'mysql://'. DB_USER .':' . DB_PASS . '@'. DB_HOST .'/'. DB_NAME . '?charset=utf8'));
    	});

	// Automatsko ucitavanje klasa
	spl_autoload_register(function($className) {
    	require_once "classes/" . $className . ".php";
	});


	