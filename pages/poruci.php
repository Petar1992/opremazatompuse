<?php

	$_SERVER['PHP_SELF'] = '?page=porudzbina';

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = strip_tags($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}


	// UPDATE KORPE
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if(isset($_POST['btn_order'])){

			$broj = count($_POST['productId']);

			for($i = 0; $i <= $broj-1; $i++){

				$productId = filter_var($_POST['productId'][$i],FILTER_SANITIZE_NUMBER_INT);
				$prodQty = filter_var($_POST['prod-qty'][$i],FILTER_SANITIZE_NUMBER_INT);

				if(isset($_SESSION['card'][$_POST['productId'][$i]])){
					$_SESSION['card'][$_POST['productId'][$i]]=$_POST['prod-qty'][$i];
				}

				if($_SESSION['card'][$_POST['productId'][$i]] <= 0){
					unset($_SESSION['card'][$_POST['productId'][$i]]);
				}
			}
		}
	}

	$order = new Order;
	$order->ime = $order->email = $order->mobilni = $order->adresa = "";
	$nameErr = $emailErr = $mobilniErr = $porukaErr = $adresaErr = "";
	

	// FORMA ZA PORUCIVANJE
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST['btnSubmit'])){
		
		if(empty($_POST["ime"])) {

		    $nameErr = "Neophodno je uneti ime";
		    echo '<div class="span9">';
		    echo "<p>" . $nameErr . "</p>";
		    echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
		    echo "</div>";
		    return false;
		} else {
		    $order->ime = test_input($_POST["ime"]);
		    $order->ime = filter_var($order->ime, FILTER_SANITIZE_STRING);
		    //Proverava da li ime sadrzi samo slova i prazan prostor.
		   if (!preg_match("/^[a-zA-Z ]*$/",$order->ime)) {
		     $nameErr = "U polju za ime su dozvoljena samo slova i prazan prostor.";
		     echo '<div class="span9">';
		     echo "<p>" . $nameErr . "</p>";
		     echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
		     echo "</div>";
		     return false;
		   }
		}

		if(empty($_POST["email"])) {
		    $emailErr = "Neophodno je uneti email adresu.";
		    echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
		    return false;
		} else {
			$order->email = test_input($_POST["email"]);
			$order->email = filter_var($order->email,FILTER_SANITIZE_EMAIL);
			if (!filter_var($order->email, FILTER_VALIDATE_EMAIL)) {
	  			$emailErr = "Neispravan format email adrese.";
	  			echo '<div class="span9">';
	  			echo "<p>" . $emailErr ."</p>";
	  			echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
	  			echo "</div>";
	  			return false;
			}
		}

		if(empty($_POST["mobile"])) {
		    $mobilniErr = "Neophodno je uneti broj telefona.";
		    echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
		    return false;
		} else {
			$order->mobilni = test_input($_POST['mobile']);
			
			if(!filter_var($order->mobilni, FILTER_SANITIZE_NUMBER_INT)){
				$mobilniErr = "Neispravan format telefona.";
				echo '<div class="span9">';
				echo "<p>" . $mobilniErr ."</p>";
				echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
				echo "</div>";
				return;
			}
		}
		if(empty($_POST['adresa'])){
			$adresaErr = "Neophodno je uneti adresu.";
			echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
			return false;
		} else {
			$order->adresa = test_input($_POST['adresa']);
			if (!filter_var($order->adresa, FILTER_SANITIZE_STRING)) {
	  			$adresaErr = "Neispravan format adrese.";
	  			echo '<div class="span9">';
	  			echo "<p>" . $adresaErr ."</p>";
	  			echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
				echo "</div>";
	  			return false;
			}
		}

  		if(empty($_POST["msg"])) {
    		$order->poruka = "";
  		} else {
    		$order->poruka = test_input($_POST["msg"]);
    		if(!filter_var($order->poruka, FILTER_SANITIZE_STRING)){
    			$porukaErr = "Neispravan format poruke";
    			echo '<div class="span9">';
	  			echo "<p>" . $porukaErr ."</p>";
	  			echo "<p><a href='?page=porudzbina'>Vratite se nazad.</p>";
				echo "</div>";
    			return false;
    		}
  		}

		if(!isset($_SESSION['card']) || empty($_SESSION['card'])){
			echo '<div class="span9">';
			echo "Vašа korpa je prazna";
			echo "</div>";
		} else {

			$poruceniIds = array_keys($_SESSION['card']);
			$poruceniVal = array_values($_SESSION['card']);
			$poruceniVal = array_reverse($poruceniVal);
			$poruceniIds_string = implode(",",$poruceniIds);
			$poruceniProizvodi = Proizvod::find_by_sql('select * from proizvodi where id in (' . $poruceniIds_string . ')');

			$order->proizvodi = json_encode($_SESSION['card']);
			$order->save();
			$_SESSION['card'] = array();
		}

		// Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
		$to = 'opremazatompuse@gmail.com'; 
		
		$email_subject = "Opremazatompuse: {$order->ime}";
		$email_body = "Dobili ste poruku sa vašeg sajta.\n\n"."Detalji poruke:\n\nIme: $order->ime\nEmail: $order->email\nTelefon: $order->mobilni\nAdresa: $order->adresa\n\nPoruka:\n$order->poruka\n\nPoručeni proizvodi: \n\n";

		$brojProizvoda = count($poruceniProizvodi);
		$pocetak = 0;
		$uslov = 1;
		for($j = 0; $j <= $brojProizvoda-1; $j++) {
				$proizvod = $poruceniProizvodi[$j];
				$email_body .= "Naziv: " . $proizvod->naziv . "\n";
				$email_body .= "Cena: " . $proizvod->cena . "\n";
				for($i = $pocetak; $i <= $uslov-1; $i++){
					$email_body .= "Količina: " . $poruceniVal[$i] . "\n\n";
				}
		$pocetak +=1;
		$uslov +=1;
		};

		$headers = "From: {$order->email} \n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Poruka poslata sa email adrese: $order->email";

		mail($to,$email_subject,$email_body,$headers);
			echo '<div class="span9">';
			echo "Vašа porudžbina je uspešno poslata!";
			echo "</div>";
	}
}
	

	$proizvodiId = array_keys($_SESSION['card']);
$proizvodiId_string = implode(",",$proizvodiId);
/*$proizvodi = Proizvod::getAll("where id in ({$proizvodiId_string})");*/

$proizvodi = Proizvod::find_by_sql('select * from proizvodi where id in (' . $proizvodiId_string . ')');
	
?>

	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Početna</a> <span class="divider">/</span></li>
		<li class="active">Porudžbina</li>
    </ul>
    <h3>Prikaz korpe <a href="?page=korpa" class="btn btn-large pull-right">Nazad u korpu</a></h3>

    <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Proizvod</th>
                  <th>Naziv</th>
				  <th>Cena</th>
                  <th>Količina</th>
                  
                  <th>Ukupno</th>
				</tr>
              </thead>
              <tbody>
              	<?php 
              	$ukupnaCena = 0;
				foreach($proizvodi as $proizvod){
					$pojedinacnaCena = $proizvod->cena * $_SESSION['card'][$proizvod->id];
				?>
                <tr>
                  <td><img src="<?=$proizvod->thumb?>" width=50></td>
                  <td>
                  	<input type="hidden" name="productId[]" value="<?=$proizvod->id?>">
                  	<a href="?page=detalji&proizvod=<?=$proizvod->id?>"><?=$proizvod->naziv?></a></td>
                  <td class="text-center"><?=$proizvod->cena?> &euro;</td>
				  <td><?php echo $_SESSION['card'][$proizvod->id]?></td>
				  </td>
                  <td><?=$pojedinacnaCena?> &euro;</td>
                </tr>
				<?php

				$ukupnaCena += $pojedinacnaCena;
				}

				?>
				 <tr>
                  <td colspan="4" style="text-align:right"><strong>Ukupna cena:</strong></td>
                  <td> <strong> <?=$ukupnaCena?> &euro;</strong></td>
                </tr>
				</tbody>
            </table>
	<h3> Poručite</h3>	
	<div class="well">

	<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<h4>Vaše informacije</h4>
		<div class="control-group">

		<div class="control-group">
			<label class="control-label" for="inputFname1">Ime i prezime <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="inputFname1" name="ime" placeholder="Ime i prezime" required value="<?php echo isset($order->ime)?$order->ime:""?>">
			</div>
		 </div>
		<div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input type="text" id="input_email" name="email" placeholder="Email adresa" required value="<?php echo isset($order->email)?$order->email:""?>">
		</div>
	  </div>	  
		<div class="control-group">
			<label class="control-label" for="mobile">Mobilni telefon <sup>*</sup></label>
			<div class="controls">
			  <input type="text"  name="mobile" id="mobile" placeholder="Broj mobilnog telefona"/ required value="<?php echo isset($order->mobilni)?$order->mobilni:""?>"> 
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="address">Adresa<sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="address"  name="adresa" placeholder="Adresa isporuke" required value="<?php echo isset($order->adresa)?$order->adresa:""?>"/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="textarea">Napomena: </label>
			<div class="controls">
              <textarea rows="3" style="resize: none; height:250px;" id="textarea" placeholder="Vaša poruka" name="msg" class="input-xlarge"><?php echo isset($order->poruka)?$order->poruka:""?></textarea>
          	</div>
          	<p><sup>* </sup>Obavezna polja</p>
          </div>
		<div class="control-group">
			<div class="controls">
				<input class="btn btn-large btn-success" type="submit" name="btnSubmit" value="Poruči" />
			</div>
		</div>		
	</form>
</div>
</div>
</body>
</html>