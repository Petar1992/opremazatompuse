<?php



    class Navigacija {

		public function show(){

			$page = array (

                    "index.php" => "Početna",
                    /*"?page=dostava" => "Dostava",*/
                    "?page=korpa" => "Korpa",
                    "?page=kontakt" => "Kontakt"   
        	);

            foreach ($page as $k => $v) {
                echo "<li class=''><a href='{$k}'>{$v}</a></li>";
            }
        }


        public function showAdminNavigation(){
            $page = [

                "index.php" => "Početna",
                "?page=kategorije" => "Kategorije",
                "?page=proizvodi" => "Proizvodi",
                "?page=logout" => "Logout"
            ];

            foreach ($page as $k => $v) {
                echo "<li class=''><a href='{$k}'>{$v}</a></li>";
            }
        }
    }