<?php

	if(!isset($_SESSION['card'])){
			$_SESSION['card'] = array();
	}

	if(isset($_POST['pid']) && isset($_POST['kolicina'])){
		
		if(isset($_SESSION['card'][$_POST['pid']])){
			$_SESSION['card'][$_POST['pid']]+=filter_var($_POST['kolicina'],FILTER_SANITIZE_NUMBER_INT);
		} else {
			$_SESSION['card'][$_POST['pid']]=filter_var($_POST['kolicina'],FILTER_SANITIZE_NUMBER_INT);
		}

		if($_SESSION['card'][$_POST['pid']] <= 0){
			unset($_SESSION['card'][$_POST['pid']]);
		}
	}
	
	if(isset($_POST['btn_submit'])){

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

	$_SERVER['PHP_SELF'] = '?page=korpa';
?>
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Početna</a> <span class="divider">/</span></li>
		<li class="active">Sadržaj korpe</li>
    </ul>
<?php
if(empty($_SESSION['card'])){
	echo "Vaša korpa je prazna.";
	return;
}

$proizvodiId = array_keys($_SESSION['card']);
$proizvodiId_string = implode(",",$proizvodiId);
/*$proizvodi = Proizvod::getAll("where id in ({$proizvodiId_string})");*/

$proizvodi = Proizvod::find_by_sql('select * from proizvodi where id in (' . $proizvodiId_string . ')');



?>
	<h3>  Sadržaj korpe ( <small><?php echo count($proizvodi);?></small> )<a href="?page=sviproizvodi" class="btn btn-large pull-right">Nastavi kupovinu</a></h3>
		
	<hr class="soft"/>
	    
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="cart">	
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
				  <td>
					<div class="input-append">
						<input class="span1" type="number" name="prod-qty[]" style="max-width:34px" value="<?php echo $_SESSION['card'][$proizvod->id]?>" id="appendedInputButtons" size="16" >
						<!-- <button  id="decrese"  class="btn" type="button"><i class="icon-minus"></i></button>
						<button  id="increse" onclick="increse()" class="btn" type="button"><i class="icon-plus"></i></button>
						<button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button>			 -->	
					</div>
				  </td>
                  <td><?=$pojedinacnaCena?> &euro;</td>
                </tr>
				<?php

				$ukupnaCena += $pojedinacnaCena;
				}

				?>
				 <tr>
                  <td colspan="4" style="text-align:right"><strong>Ukupna cena:</strong></td>
                  <td><strong> <?=$ukupnaCena?> &euro;</strong></td>
                </tr>
				</tbody>
            </table>
            

            <button type="submit" class="btn btn-large pull-right" name="btn_order" onclick="OrderPage()" >Poruči <i class="icon-shopping-cart""></i></i></button>
            <button type="submit" class="btn btn-large pull-right" name="btn_submit" onclick="RefreshCart()">Osveži korpu<i class="fa fa-refresh"></i></i></button>
            
        </form>

		
	
			</div>


			


</body>
</html>

<script type="text/javascript">
	
	function RefreshCart() {
		document.cart.action = "?page=korpa";
		document.cart.submit();
		return true;
	}

	function OrderPage(){
		document.cart.action = "?page=porudzbina";
		document.cart.submit();
		return true;
	}

</script>