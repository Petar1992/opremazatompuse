<?php

	if(!isset($_SESSION['user_id']) && !isset($_SESSION['logged_in'])){
	  //User not logged in. Redirect them back to the login.php page.
	    header('Location: login.php');
	    exit;
	} 

		function test_input($data) {
	  		$data = trim($data);
	  		$data = stripslashes($data);
	  		$data = strip_tags($data);
	  		$data = htmlspecialchars($data);
	  		return $data;
		}
	
	
	$kategorija = new Kategorija;
	$kategorija->naziv = "";
	

	$sel_proizvod = new Proizvod;
	$sel_proizvod->naziv = "";
	$sel_proizvod->info = "";
	$sel_proizvod->opis = "";
	$sel_proizvod->cena = "";
	$sel_proizvod->akcija = "";
	$sel_proizvod->istaknut = "";
	$sel_proizvod->kategorija = "";
	$sel_proizvod->thumb = "";
	$sel_proizvod->slika = "";
	$sel_proizvod->slikam1 = "";
	$sel_proizvod->slikam2 = "";
	$sel_proizvod->slikam3 = "";
	$sel_proizvod->stanje = "";
	$selected_product = "";

	//Definisanje validnih extenzija
	$validextensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
	
	if(isset($_GET['proizvod'])){
		$selected_product = filter_var($_GET['proizvod'],FILTER_SANITIZE_NUMBER_INT);
		$sel_proizvod = Proizvod::find($selected_product);
	}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['edit_product'])){

		$sel_proizvod = Proizvod::find($selected_product);

		if(empty($_POST['proizvod_naziv'])){
			$nameErr = "Neophodno je uneti ime";
		    echo '<div class="span9">';
		    echo "<p>" . $nameErr . "</p>";
		    echo "</div>";
		} else {
			$sel_proizvod->naziv = test_input(filter_var($_POST['proizvod_naziv'], FILTER_SANITIZE_STRING));
		}
		
		if(empty($_POST['proizvod_opis'])){
			$opisErr = "Neophodno je uneti opis.";
		    echo '<div class="span9">';
		    echo "<p>" . $opisErr . "</p>";
		    echo "</div>";
		} else {
			$sel_proizvod->opis = test_input(filter_var($_POST['proizvod_opis'],FILTER_SANITIZE_STRING));
		}
		

		if(empty($_POST['proizvod_cena'])){
			$cenaErr = "Neophodno je uneti cenu.";
		    echo '<div class="span9">';
		    echo "<p>" . $cenaErr . "</p>";
		    echo "</div>";
		} else {
			$sel_proizvod->cena = test_input(filter_var($_POST['proizvod_cena'],FILTER_SANITIZE_NUMBER_INT));
		}
		

		if(isset($_POST['proizvod_akcija'])){

			$sel_proizvod->akcija = test_input(filter_var($_POST['proizvod_akcija'],FILTER_SANITIZE_NUMBER_INT));
		}

		if(isset($_POST['proizvod_istaknut'])){
			$sel_proizvod->istaknut = test_input(filter_var($_POST['proizvod_istaknut'],FILTER_SANITIZE_NUMBER_INT));
		}

		if(isset($_POST['proizvod_stanje'])){
			$sel_proizvod->stanje = test_input(filter_var($_POST['proizvod_stanje'], FILTER_SANITIZE_NUMBER_INT));
		}

		if(isset($_GET['cat'])){
			$sel_proizvod->kategorija = test_input(filter_var($_GET['cat'],FILTER_SANITIZE_NUMBER_INT));
		}

		if(isset($_FILES['proizvod_thumb'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_thumb"]["name"]);
			$file_extension = end($temporary);

			// Provera velicine fajla i njegove extenzije
			if ((($_FILES["proizvod_thumb"]["type"] == "image/png")
			|| ($_FILES["proizvod_thumb"]["type"] == "image/PNG"))
			&& ($_FILES["proizvod_thumb"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_thumb"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_thumb"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_thumb']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_thumb']['name']);
					$sel_proizvod->thumb = "themes/images/proizvodi/".$_FILES['proizvod_thumb']['name'];
				}
			}
		}

		if(isset($_FILES['proizvod_slika'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slika"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slika"]["type"] == "image/png")
			|| ($_FILES["proizvod_slika"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slika"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slika"]["type"] == "image/JPEG")
			|| ($_FILES["proizvod_slika"]["type"] == "image/jpg")
			|| ($_FILES["proizvod_slika"]["type"] == "image/jpeg"))
			&& ($_FILES["proizvod_slika"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slika"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slika"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slika']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slika']['name']);
					$sel_proizvod->slika = "themes/images/proizvodi/".$_FILES['proizvod_slika']['name'];
				}
			}
		}
		
		if(isset($_FILES['proizvod_slikam1'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slikam1"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slikam1"]["type"] == "image/png")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/jpg")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/jpeg")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/JPEG"))
			&& ($_FILES["proizvod_slikam1"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slikam1"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slikam1"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slikam1']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slikam1']['name']);
					$sel_proizvod->slikam1 = "themes/images/proizvodi/".$_FILES['proizvod_slikam1']['name'];
				}
			}
		}

		if(isset($_FILES['proizvod_slikam2'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slikam2"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slikam2"]["type"] == "image/png")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/jpg")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/jpeg")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/JPEG"))
			&& ($_FILES["proizvod_slikam2"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slikam2"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slikam2"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slikam2']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slikam2']['name']);
					$sel_proizvod->slikam2 = "themes/images/proizvodi/".$_FILES['proizvod_slikam2']['name'];
				}
			}
		}
		
		if(isset($_FILES['proizvod_slikam3'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slikam3"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slikam3"]["type"] == "image/png")
			||	($_FILES["proizvod_slikam3"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slikam3"]["type"] == "image/jpg")
			||	($_FILES["proizvod_slikam3"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slikam3"]["type"] == "image/jpeg"))
				||	($_FILES["proizvod_slikam3"]["type"] == "image/JPEG")
			&& ($_FILES["proizvod_slikam3"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slikam3"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slikam3"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slikam3']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slikam3']['name']);
					$sel_proizvod->slikam3 = "themes/images/proizvodi/".$_FILES['proizvod_slikam3']['name'];
				}
			}
		}
		$sel_proizvod->save();
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['add_product'])){

			$proizvod = new Proizvod;
			$proizvod->naziv = "";
			$proizvod->opis = "";
			$proizvod->cena = "";
			$proizvod->akcija = "";
			$proizvod->istaknut = "";
			$proizvod->kategorija = "";
			$proizvod->thumb = "";
			$proizvod->slika = "";
			$proizvod->slikam1 = "";
			$proizvod->slikam2 = "";
			$proizvod->slikam3 = "";

		$proizvod->naziv = test_input(filter_var($_POST['proizvod_naziv'],FILTER_SANITIZE_STRING));

		$proizvod->opis = test_input(filter_var($_POST['proizvod_opis'],FILTER_SANITIZE_STRING));
		$proizvod->cena = test_input(filter_var($_POST['proizvod_cena'],FILTER_SANITIZE_NUMBER_INT));

		if(isset($_POST['proizvod_akcija'])){
			$proizvod->akcija = test_input(filter_var($_POST['proizvod_akcija'],FILTER_SANITIZE_NUMBER_INT));
		}

		if(isset($_POST['proizvod_istaknut'])){
			$proizvod->istaknut = test_input(filter_var($_POST['proizvod_istaknut'],FILTER_SANITIZE_NUMBER_INT));
		}

		if(isset($_POST['proizvod_stanje'])){
			$proizvod->stanje = test_input(filter_var($_POST['proizvod_stanje'], FILTER_SANITIZE_NUMBER_INT));
		}

		if(isset($_GET['cat'])){
			$proizvod->kategorija = test_input(filter_var($_GET['cat'],FILTER_SANITIZE_NUMBER_INT));
		}
		$proizvod->thumb = "";
		if(isset($_FILES['proizvod_thumb'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_thumb"]["name"]);
			$file_extension = end($temporary);

			// Provera velicine fajla i njegove extenzije
			if ((($_FILES["proizvod_thumb"]["type"] == "image/png")
			|| ($_FILES["proizvod_thumb"]["type"] == "image/PNG"))
			&& ($_FILES["proizvod_thumb"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_thumb"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_thumb"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_thumb']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_thumb']['name']);
					$proizvod->thumb = "themes/images/proizvodi/".$_FILES['proizvod_thumb']['name'];
				}
			}
		} 

		if(isset($_FILES['proizvod_slika'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slika"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slika"]["type"] == "image/png")
			|| ($_FILES["proizvod_slika"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slika"]["type"] == "image/jpg")
			|| ($_FILES["proizvod_slika"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slika"]["type"] == "image/jpeg")
			|| ($_FILES["proizvod_slika"]["type"] == "image/JPEG"))
			&& ($_FILES["proizvod_slika"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slika"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slika"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slika']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slika']['name']);
					$proizvod->slika = "themes/images/proizvodi/".$_FILES['proizvod_slika']['name'];
				}
			}
		}

		if(isset($_FILES['proizvod_slikam1'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slikam1"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slikam1"]["type"] == "image/png")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/jpg")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/jpeg")
			|| ($_FILES["proizvod_slikam1"]["type"] == "image/JPEG"))
			&& ($_FILES["proizvod_slikam1"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slikam1"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slikam1"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slikam1']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slikam1']['name']);
					$proizvod->slikam1 = "themes/images/proizvodi/".$_FILES['proizvod_slikam1']['name'];
				}
			}
		}

		if(isset($_FILES['proizvod_slikam2'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slikam2"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slikam2"]["type"] == "image/png")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/jpg")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/jpeg")
			|| ($_FILES["proizvod_slikam2"]["type"] == "image/JPEG"))
			&& ($_FILES["proizvod_slikam2"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slikam2"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slikam2"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slikam2']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slikam2']['name']);
					$proizvod->slikam2 = "themes/images/proizvodi/".$_FILES['proizvod_slikam2']['name'];
				}
			}
		}

		if(isset($_FILES['proizvod_slikam3'])){
			//Definisanje promenljive koja ce sadrzati extenziju poslatog fajla.
			$temporary = explode(".", $_FILES["proizvod_slikam3"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["proizvod_slikam3"]["type"] == "image/png")
			|| ($_FILES["proizvod_slikam3"]["type"] == "image/PNG")
			|| ($_FILES["proizvod_slikam3"]["type"] == "image/jpg")
			|| ($_FILES["proizvod_slikam3"]["type"] == "image/JPG")
			|| ($_FILES["proizvod_slikam3"]["type"] == "image/jpeg")
			|| ($_FILES["proizvod_slikam3"]["type"] == "image/JPEG"))
			&& ($_FILES["proizvod_slikam3"]["size"] < 5242880)// 5mb files can be uploaded
			&& in_array($file_extension, $validextensions)){
				// 
				if ($_FILES["proizvod_slikam3"]["error"] > 0) {
					echo "Return Code: " . $_FILES["proizvod_slikam3"]["error"] . "<br/><br/>";
				} else {
					move_uploaded_file($_FILES['proizvod_slikam3']['tmp_name'], "../themes/images/proizvodi/".$_FILES['proizvod_slikam3']['name']);
					$proizvod->slikam3 = "themes/images/proizvodi/".$_FILES['proizvod_slikam3']['name'];
				}
			}
		}
		$proizvod->save();
	}
}


?>

	
	<h3>Proizvodi</h3>

	<form method="post" action="" enctype="multipart/form-data">

		<p>Izaberite proizvod</p>
		<select style="width: 455px;" onchange="if(this.value < 0) return; window.location='?page=proizvodi&proizvod='+this.value">
			<option value="-1">Izaberite proizvod</option>
			<?php
			$proizvodi = Proizvod::all();
			foreach ($proizvodi as $p) {
			?>
			<option <?php echo ($sel_proizvod->id == $p->id)?"selected":""; ?> value="<?=$p->id?>"><?=$p->naziv?></option>
			<?php
			}
			?>
		</select>

		<p>Kategorija proizvoda</p>
		<select onchange="if(this.value < 0) return; window.location='?page=proizvodi&proizvod=<?=$sel_proizvod->id?>&cat='+this.value">
			<option value="-1">Izaberite kategoriju</option>
			<?php
			$kategorija = Kategorija::all();
			foreach ($kategorija as $k) {

				if(isset($_GET['cat'])){
					$cat = $_GET['cat'];
					?>
					<option value="<?=$k->id?>"<?= ($k->id == $cat ?"selected":"");?>><?=$k->naziv?></option>
					<?php
				} else {
				?>
				<option value="<?=$k->id?>"<?= ($k->id == $sel_proizvod->kategorija ?"selected":"");?>><?=$k->naziv?></option>
				<?php
				}
			}
			?>
		</select>

		<p>Naziv proizvoda</p>
		<input type="text" style="width: 440px;" name="proizvod_naziv" value="<?=$sel_proizvod->naziv?>">


		<p>Opis proizvoda</p>
		<textarea name="proizvod_opis" style="width: 440px; height: 150px; resize: none;"><?=$sel_proizvod->opis?></textarea>

		<p>Cena proizvoda</p>
		<input type="number" name="proizvod_cena" value="<?=$sel_proizvod->cena?>">

		<p>Da li je proizvod na akciji? </p>
		<input type="radio" name="proizvod_akcija" value="1" <?= ($sel_proizvod->akcija == 1)?"checked":""; ?>> Da<br>
		<?php
		?>
		<input type="radio" name="proizvod_akcija" value="0" <?= ($sel_proizvod->akcija == 0)?"checked":""; ?>> Ne<br><br>

		<p>Da li proizvod treba da bude istaknut?</p>
		<input type="radio" name="proizvod_istaknut" value="1" <?= ($sel_proizvod->istaknut == 1)?"checked":""; ?>>Da<br>
		<input type="radio" name="proizvod_istaknut" value="0" <?= ($sel_proizvod->istaknut == 0)?"checked":""; ?>>Ne<br><br>
		<p>Raspoloživost proizvoda:</p>
		<input type="radio" name="proizvod_stanje" value="1" <?= ($sel_proizvod->stanje == 1)?"checked":""; ?>> Na stanju!<br>
		<input type="radio" name="proizvod_stanje" value="0" <?= ($sel_proizvod->stanje == 0)?"checked":""; ?>> Nema na stanju!<br><br>

		<p>Thumb slika - Ova slika mora imati belu pozadinu i 149x149 dimenzije. Format slike mora biti .png</p>
		<img src="../<?php echo $sel_proizvod->thumb; ?>" alt="">
		<input type="file" name="proizvod_thumb">

		<p>Velika slika - Prva slika proizvoda.</p>
		<img src="../<?php echo $sel_proizvod->slika; ?>" alt="" width=150 height=150>
		<input type="file" name="proizvod_slika">

		<p>Mala slika - druga slika proizvoda.</p>
		<img src="../<?php echo $sel_proizvod->slikam1; ?>" alt="" width=150 height=150>
		<input type="file" name="proizvod_slikam1">

		<p>Mala slika - treca slika proizvoda.</p>
		<img src="../<?php echo $sel_proizvod->slikam2; ?>" alt="" width=150 height=150>
		<input type="file" name="proizvod_slikam2">

		<p>Mala slika - cetvrta slika proizvoda.</p>
		<img src="../<?php echo $sel_proizvod->slikam3; ?>" alt="" width=150 height=150>
		<input type="file" name="proizvod_slikam3">
		<br><br>

		<button type="submit" name="add_product">Dodaj</button>
		<button type="submit" name="edit_product">Izmeni</button>

	</form>