<?php

	$_SERVER['PHP_SELF'] = '?page=kontakt';

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = strip_tags($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}
	$name = $email_address = $phone = $message = "";
	$nameErr = $emailErr = $phoneErr = $messageErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST['btn_submit'])){
			if(empty($_POST["ime"])) {
				$nameErr = "Neophodno je uneti ime";
				echo '<div class="span9">';
		   		echo "<p>" . $nameErr . "</p>";
		   		echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
		    	echo "</div>";
   	} else {
   		$name = test_input($_POST["ime"]);
   		$name = filter_var($name, FILTER_SANITIZE_STRING);
   		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		     $nameErr = "U polju za ime dozvoljena su samo slova i prazan prostor.";
		     echo '<div class="span9">';
		     echo "<p>" . $nameErr . "</p>";
		     echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
		     echo "</div>";
		     return false;
		}
   	}

   	if(empty($_POST["email"])) {
		    $emailErr = "Neophodno je uneti email adresu.";
		    	echo '<div class="span9">';
		   		echo "<p>" . $emailErr . "</p>";
		   		echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
		    	echo "</div>";
		    	return false;
		} else {
			$email_address = test_input($_POST["email"]);
			$email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
			if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
	  			$emailErr = "Neispravan format email adrese.";
	  			echo '<div class="span9">';
	  			echo "<p>" . $emailErr ."</p>";
	  			echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
	  			echo "</div>";
	  			 return;
			}
		}

		/*if(empty($_POST["mobilni"])) {
		    $mobilniErr = "Neophodno je uneti broj telefona.";
		    echo '<div class="span9">';
		   	echo "<p>" . $mobilniErr . "</p>";
		   	echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
		    echo "</div>";
		    return false;
		} else {
			$phone = test_input($_POST['mobilni']);
			$phone = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
			if(!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)){
				$mobilniErr = "Neispravan format telefona.";
				echo '<div class="span9">';
				echo "<p>" . $mobilniErr ."</p>";
				echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
				echo "</div>";
				return false;
			}
		}*/

		if(empty($_POST["msg"])) {
    		$porukaErr = "Neophodno je uneti sadrzaj poruke.";
		    echo '<div class="span9">';
		   	echo "<p>" . $porukaErr . "</p>";
		   	echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
		    echo "</div>";
		    return false;
  		} else {
    		$message = test_input($_POST["msg"]);
    		

    		if(!filter_var($message, FILTER_SANITIZE_STRING)){
    			$porukaErr = "Neispravan format poruke.";
    			echo '<div class="span9">';
	  			echo "<p>" . $porukaErr ."</p>";
	  			echo "<p><a href='?page=kontakt'>Vratite se nazad.</p>";
				echo "</div>";
    			return false;
    		}
  		}
			
		// Create the email and send the message
		$to = 'opremazatompuse@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.

		$email_subject = "Opremazatompuse: $name";
		$email_body = "Dobili ste poruku sa kontakt forme vašeg sajta.\n\n"."Detalji poruke:\n\nIme: $name\n\nEmail: $email_address\n\nPoruka:\n$message";
		$headers = "From: $email_address \n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Poruka poslata sa email adrese: $email_address";

		mail($to,$email_subject,$email_body,$headers);
			echo '<div class="span9">';
			echo "Vašа poruka je uspešno poslata!";
			echo "</div>";
		}
	}

?>
	<div class="row">
	
		<div class="span3">
		<h4>Kontakt Informacije</h4>

			Mobilni: 123-456-6780<img src="themes/images/viber.png" width="50"><img src="themes/images/whatsapp.png" width="30"><br/>
			opremazatompuse.com
		</p>		
		</div>
		<div class="span3">
		<h4>Pošaljite nam email</h4>
		<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>
          <div class="control-group">
           
              <input type="text" placeholder="Ime i prezime" name="ime" class="input-xlarge" required value="<?php echo isset($name)?$name:""?>"/>
           
          </div>
		   <div class="control-group">
           
              <input type="text" placeholder="Email adresa" name="email" class="input-xlarge" required value="<?php echo isset($email_address)?$email_address:""?>"/>
           
          </div>
		  <!--  <div class="control-group">
           
              <input type="text" placeholder="Broj mobilnog telefona" name="mobilni" class="input-xlarge" value="<?php echo isset($phone)?$phone:""?>"/>
          
          </div> -->
          <div class="control-group">
              <textarea rows="3" style="resize: none; height:250px" height=250 id="textarea" placeholder="Vaša poruka" name="msg" class="input-xlarge" required><?php echo isset($message)?$message:""?></textarea>
          </div>

            <button class="btn btn-large" type="submit" name="btn_submit">Pošaljite poruku</button>

        </fieldset>
      </form>
      
		</div>
	</div>


<!-- MainBody End ============================= -->


</body>
</html>