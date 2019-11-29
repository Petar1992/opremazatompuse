<?php
	
	if(!isset($_SESSION['user_id']) && !isset($_SESSION['logged_in'])){
	  //User not logged in. Redirect them back to the login.php page.
	    header('Location: login.php');
	    exit;
	} else {

		$kategorija = new Kategorija;
		$kategorija->naziv = "";
		$kategorija->opis = "";
		$kategorija->info ="";
		$selected_kategorija = "";
		
		if(isset($_GET['cat'])){
			$selected_kategorija = $_GET['cat'];
			$kategorija = Kategorija::find($selected_kategorija);
		}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['btn_addnew'])){

			$kategorija = new Kategorija;
			$kategorija->naziv = $_POST['cat_naziv'];
			$kategorija->opis = $_POST['cat_opis'];
			$kategorija->info = $_POST['cat_info'];
			$kategorija->save();
		}
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['btn_edit'])){
			$kategorija = new Kategorija;
			$kategorija = Kategorija::find($selected_kategorija);
			
			$kategorija->naziv = $_POST['cat_naziv'];
			$kategorija->opis = $_POST['cat_opis'];
			$kategorija->info = $_POST['cat_info'];
			$kategorija->save();
		}
	}
}

	$_SERVER['PHP_SELF'] = '?page=kategorije&cat=' . $selected_kategorija;
?>
<h3>Kategorije</h3>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<p>Izaberite kategoriju</p>

	<select onchange="if(this.value<0) return; window.location='?page=kategorije&cat='+this.value">
		<option value="-1">Izaberite kategoriju</option>
		<?php
		$kategorije = Kategorija::all();
		foreach ($kategorije as $k) {
		?>
		<option <?php echo ($kategorija->id == $k->id)?"selected":""; ?> value="<?=$k->id?>"><?=$k->naziv?></option>
		<?php } ?>
	</select>


	<p>Naziv kategorije: </p>
	<input type="text" name="cat_naziv" value="<?=$kategorija->naziv?>">

	<p>Opis kategorije</p>
	<textarea name="cat_opis" style="width: 440px; height: 150px; resize: none;"  ><?=$kategorija->opis?></textarea>

	<p>Naziv koji stoji na stranici kada se odredjena kategorija otvori - (Obavezno staviti prvo slovo malo)</p>
	<input type="text" name="cat_info" value="<?=$kategorija->info?>"><br>

	<button type="submit" name="btn_addnew">Dodaj</button>
	<button type="submit" name="btn_edit">Izmeni</button>
</form>