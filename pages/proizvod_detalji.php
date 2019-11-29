<?php

	
	$proizvodi = new Proizvod;
	$brojProizvoda = count(Proizvod::all());

	
	if(!isset($_GET['proizvod']) || $_GET['proizvod'] <= 0 || $_GET['proizvod'] > $brojProizvoda+2 ){
		$proizvodId = 1;
	} else {
		$proizvodId = $_GET['proizvod'];
	}

	
	$proizvod = Proizvod::find($proizvodId);
	

?>
	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="index.php">Početna</a> <span class="divider">/</span></li>
    <li><a href="?page=sviproizvodi">Proizvodi</a> <span class="divider">/</span></li>
    <li class="active">Detalji o proizvodu</li>
    </ul>	
	<div class="row">	  
			<div id="gallery" class="span3">
            <a href="<?=$proizvod->slika?>" title="<?=$proizvod->naziv?>">
				<img src="<?=$proizvod->slika?>"  style="width:100%" alt="<?=$proizvod->naziv?>"/>
            </a>
			<div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                  	<?php

                   if(!empty($proizvod->slikam1)){

                   	?>
                   <a href="<?=$proizvod->slikam1?>"> <img style="width:29%" src="<?=$proizvod->slikam1?>" alt=""/></a>
                   
                   <?php
               		}

                   if(!empty($proizvod->slikam2)){

                   	?>
                   	<a href="<?=$proizvod->slikam2?>"> <img style="width:29%" src="<?=$proizvod->slikam2?>" alt=""/></a>
                   	<?php

                   }

                   if(!empty($proizvod->slikam3)){
                   	?>
					<a href="<?=$proizvod->slikam2?>" > <img style="width:29%" src="<?=$proizvod->slikam2?>" alt=""/></a>
                   	<?php

                   }

                   ?>

                  </div>
                  <!-- <div class="item">
                   <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                  </div> -->
                </div>
              </div>
			  
			</div>
			<div class="span6">
				<h3><?php echo $proizvod->naziv ?></h3>
				
				<hr class="soft"/>

				<form class="form-horizontal qtyFrm" action="?page=korpa" method="post">
				  <div class="control-group">

					<label class="control-label"><span>Cena: <?php echo $proizvod->cena ?>&euro;</span></label>

					<div class="controls">
					<input type="hidden" name="pid" value="<?php echo $proizvod->id ?>" >
					
					<span>Količina: </span><input type="number" name="kolicina" class="span2"  value="1" oninvalid="setCustomValidity('Nepravilan format kolicine.')" />
					  <button type="submit" class="btn btn-large btn-primary pull-right">Dodaj u korpu </button>
					</div>
				  </div>
				</form>
			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Opis proizvoda</a></li>
              
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Opis proizvoda:</h4>
				<p><?php echo $proizvod->opis ?></p>
              </div>
		<div class="tab-pane fade" id="profile">
		<div id="myTab" class="pull-right">
		 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
		 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
		</div>
		<br class="clr"/>
		<hr class="soft"/>

		<br class="clr">
		</div>
		</div>
          </div>

	</div>
</div>
<!-- MainBody End ============================= -->
</body>
</html>